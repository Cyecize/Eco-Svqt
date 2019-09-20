<?php

namespace App\Controller\Security;

use App\BindingModel\User\UserRegisterBindingModel;
use App\Constant\Config;
use App\Constant\PreDefinedCurrency;
use App\Constant\Roles;
use App\Controller\BaseController;
use App\Form\UserRegisterType;
use App\Service\FirstRunService;
use App\Service\Lang\LocalLanguage;
use App\Service\User\UserService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends BaseController
{
    //TODO: private const LOGGER_LOCATION = "Security Controller";

    private $userService;

    public function __construct(LocalLanguage $language, UserService $userService)
    {
        parent::__construct($language);
        $this->userService = $userService;
    }

    /**
     * @Route("/login", name="security_login" )
     * @Security("is_anonymous()", message="You are already logged in")
     * @param AuthenticationUtils $authUtils
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function loginAction(AuthenticationUtils $authUtils, Request $request)
    {
        $lastUsername = null;

        // last username entered by the user
        $lastUsername = $authUtils->getLastUsername();

        if ($lastUsername != null) {
            $existingUser = $this->userService->findByEmail($lastUsername);

            if ($existingUser == null) {
                $lastUsername = null;
                $this->addError('email', $this->dictionary->emailDoesNotExist());
            } else {
                $this->addError('password', $this->dictionary->invalidPassword());
            }
        }

        $queryName = $request->get('u');
        if ($queryName != null) $lastUsername = $queryName;

        return $this->render("security/login.html.twig", [
            "last_username" => $lastUsername,
        ]);
    }

    /**
     * @Route("/register/post", name="security_register_post" )
     * @Security("is_anonymous()", message="You are already logged in")
     * @param Request $request
     * @param FirstRunService $firstRunService
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \App\Exception\InternalRestException
     */
    public function registerAction(Request $request, FirstRunService $firstRunService /*LogService $logService*/) //TODO: add log service
    {
        $this->validateToken($request);

        $bindingModel = new UserRegisterBindingModel();
        $form = $this->createForm(UserRegisterType::class, $bindingModel);
        $form->handleRequest($request);

        $this->addFlashModel($bindingModel);

        if (!$form->isSubmitted() || count($this->validate($bindingModel)) > 0) {
            return $this->redirectToRoute('security_register');
        }

        $userInDb = $this->userService->findByEmail($bindingModel->getEmail());

        if ($userInDb != null) {
            $this->addError('email', $this->dictionary->emailTaken());
            return $this->redirectToRoute('security_register');
        }

        if ($this->userService->count() < 1) {
            $firstRunService->initDb();
        }

        $user = $this->userService->createUser($bindingModel, Roles::USER);

        //TODO: $logService->log(self::LOGGER_LOCATION, sprintf("User with username %s was created", $user->getUsername()));

        return $this->redirectToRoute("security_login", ['u' => $user->getUsername()]);
    }

    /**
     * @Route(path="/register", name="security_register", methods={"GET"})
     * @Security("is_anonymous()", message="You are already logged in")
     * @return \Symfony\Component\HttpFoundation\Response
     * @ParamConverter()
     */
    public function registerGetAction()
    {
        $model = $this->getFlashModel();

        if ($model == null) {
            $model = new UserRegisterBindingModel();
        }

        return $this->render('security/register.html.twig', [
            "model" => $model,
            "langs" => [Config::COOKIE_BG_LANG, Config::COOKIE_EN_LANG],
            "currencies" => PreDefinedCurrency::ALL(),
        ]);
    }

    /**
     * This is the route the user can use to logout.
     * But, this will never be executed. Symfony will intercept this first
     * and handle the logout automatically. See logout in app/config/security.yml
     * @Route("/logout/", name="security_logout")
     * @throws \Exception
     */
    public function logoutAction()
    {
        throw new \Exception('This should never be reached!');
    }
}