<?php

namespace App\Lang;


use App\Constant\Config;

class LanguagePackEN implements LanguagePack
{

    private const WEBSITE_NAME = "Eco World";

    function getLocalLang(): string
    {
        return Config::COOKIE_EN_LANG;
    }

    public function websiteName(): string
    {
        return self::WEBSITE_NAME;
    }

    function home(): string
    {
        return "home";
    }

    function products(): string
    {
        return "products";
    }

    function contacts(): string
    {
        return "contacts";
    }

    function login(): string
    {
        return "login";
    }

    function register(): string
    {
        return "register";
    }
}