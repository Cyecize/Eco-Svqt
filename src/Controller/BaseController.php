<?php

namespace App\Controller;

use App\Constant\Roles;
use App\Exception\InternalRestException;
use App\Lang\LanguagePack;
use App\Service\Lang\LocalLanguage;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

abstract class BaseController extends Controller
{
    private const VALIDATION_ERRORS = 'validationErrors';

    private const INVALID_TOKEN = "Invalid token";

    /**
     * @var LocalLanguage
     */
    protected $language;

    /**
     * @var LanguagePack
     */
    protected $dictionary;

    /**
     * Keeps track of current form errors.
     * @var array
     */
    private $validationErrors;

    public function __construct(LocalLanguage $language)
    {
        $this->language = $language;
        $this->dictionary = $language->dictionary();
        $this->validationErrors = [];
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface
     */
    protected function getFlashBag()
    {
        return $this->container->get('session')->getFlashBag();
    }

    /**
     * @param $bindingModel
     */
    protected function addFlashModel($bindingModel): void
    {
        $this->addFlash('model', $bindingModel);
    }

    /**
     * return binding model
     */
    protected function getFlashModel()
    {
        $arr = $this->getFlashBag()->get('model', []);

        if (count($arr) > 0) {
            return $arr[0];
        }

        return null;
    }

    /**
     * Checks if user is logged in.
     * @return bool
     */
    protected function isUserLogged(): bool
    {
        return $this->get('security.authorization_checker')->isGranted(Roles::USER);
    }

    /**
     * Checks if user is logged in and has the admin role.
     * @return bool
     */
    protected function isAdminLogged(): bool
    {
        return $this->get('security.authorization_checker')->isGranted(Roles::ADMIN, 'ROLES');
    }

    /**
     * @return int - user Id.
     */
    protected function getUserId(): int
    {
        return $this->getUser()->getId();
    }

    /**
     * @param $bindingModel
     * @return \Symfony\Component\Validator\ConstraintViolationListInterface
     */
    protected function validate($bindingModel)
    {
        $validationErrors = $this->get('validator')->validate($bindingModel);

        foreach ($validationErrors as $validationError) {
            $this->addError($validationError->getPropertyPath(), $validationError->getMessage());
        }

        return $validationErrors;
    }

    /**
     * Add FieldError to form.
     * @param string $fieldName
     * @param string $message
     */
    protected function addError(string $fieldName, string $message): void
    {
        if (!key_exists($fieldName, $this->validationErrors)) {
            $this->validationErrors[$fieldName] = [];
        }

        $this->validationErrors[$fieldName][] = $message;
    }

    /**
     * @param Request $request
     * @throws InternalRestException
     */
    protected function validateToken(Request $request)
    {
        $token = $request->get('token');

        if (!$this->isCsrfTokenValid('token', $token)) {
            throw new InternalRestException(self::INVALID_TOKEN);
        }
    }

    protected function redirectToRoute($route, array $parameters = [], $status = 302)
    {
        $this->addFlash(self::VALIDATION_ERRORS, $this->validationErrors);
        return parent::redirectToRoute($route, $parameters, $status);
    }

    protected function render($view, array $parameters = [], Response $response = null)
    {
        $parameters[self::VALIDATION_ERRORS] = $this->getFlashBag()->get(self::VALIDATION_ERRORS, [[]])[0];
        return parent::render($view, $parameters, $response);
    }
}