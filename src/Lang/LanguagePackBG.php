<?php

namespace App\Lang;


use App\Constant\Config;

class LanguagePackBG implements LanguagePack
{

    private const HOME = "Начало";

    private const PRODUCTS = "Продукти";

    private const CONTACTS = "Контакти";

    private const LOGIN = "Вход";

    private const REGISTER = "Регистрация";

    private const WEBSITE_NAME = "Еко Свят";

    function getLocalLang(): string
    {
        return Config::COOKIE_BG_LANG;
    }

    public function websiteName(): string
    {
        return self::WEBSITE_NAME;
    }

    function home(): string
    {
        return self::HOME;
    }

    function products(): string
    {
        return self::PRODUCTS;
    }

    function contacts(): string
    {
        return self::CONTACTS;
    }

    function login(): string
    {
        return self::LOGIN;
    }

    function register(): string
    {
        return self::REGISTER;
    }
}