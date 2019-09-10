<?php

namespace App\Lang;


use App\Constant\Config;

class LanguagePackEN implements LanguagePack
{

    private const WEBSITE_NAME = "Eco World";

    private const FOLLOW_US = "Follow us";

    private const MY_ACCOUNT = "My account";

    private const QUICK_ORDER = "Quick order";

    private const SEARCH_PRODUCTS_HERE = "Search products here";

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