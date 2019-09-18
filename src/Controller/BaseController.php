<?php

namespace App\Controller;

use App\Constant\Roles;
use App\Exception\InternalRestException;
use App\Lang\LanguagePack;
use App\Service\Lang\LocalLanguage;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

abstract class BaseController extends Controller
{
    private const INVALID_TOKEN = "Invalid token";

    /**
     * @var LocalLanguage
     */
    protected $language;

    /**
     * @var LanguagePack
     */
    protected $dictionary;

    public function __construct(LocalLanguage $language)
    {
        $this->language = $language;
        $this->dictionary = $language->dictionary();
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
        return $this->get('validator')->validate($bindingModel);
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
}