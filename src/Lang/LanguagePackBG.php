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

    private const FOLLOW_US = "Последвайте ни";

    private const MY_ACCOUNT = "Моят профил";

    private const QUICK_ORDER = "Бърза поръчка";

    private const SEARCH_PRODUCTS_HERE = "Търсете продукти тук";

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

    function followUs(): string
    {
        return self::FOLLOW_US;
    }

    function myAccount(): string
    {
        return self::MY_ACCOUNT;
    }

    function quickOrder(): string
    {
        return self::QUICK_ORDER;
    }

    function searchProductsHere(): string
    {
        return self::SEARCH_PRODUCTS_HERE;
    }
}