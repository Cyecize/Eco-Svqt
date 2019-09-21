<?php

namespace App\EventListener;

use App\Entity\User;
use App\Service\Currency\LocalCurrency;
use App\Service\Lang\LocalLanguage;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class LoginListener
{
    /**
     * @var LocalLanguage
     */
    private $localLanguage;

    /**
     * @var LocalCurrency
     */
    private $localCurrency;

    /**
     * @var User
     */
    private $user;

    public function __construct(LocalLanguage $localLanguage, LocalCurrency $localCurrency, TokenStorageInterface $tokenStorage)
    {
        $this->localLanguage = $localLanguage;
        $this->localCurrency = $localCurrency;
        $this->user = $tokenStorage->getToken()->getUser();
    }

    public function onLogin()
    {
        $this->localLanguage->setLang($this->user->getLanguage()->getLocaleName());
        $this->localCurrency->setCurrency($this->user->getCurrency()->getSign());
    }
}