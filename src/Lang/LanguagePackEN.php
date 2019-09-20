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

    private const INVALID_PASSWORD = "Грешна парола!";

    private const EMAIL_NOT_FOUND = "Е-Mail адресът не е намерен.";

    private const EMAIL_TAKEN = "Е-Mail address is taken.";

    private const PASSWORDS_DO_NOT_MATCH = "Passwords do not match.";

    private const INVALID_PASSWORD_LENGTH = "Invalid password length.";

    private const INVALID_VALUE = "Invalid value.";

    private const FIELD_CANNOT_BE_NULL = "Field cannot be empty.";

    private const EMAIL_ADDRESS = "Email address";

    private const PASSWORD = "Password";

    private const CONFIRM_PASSWORD = "Confirm Password";

    private const CURRENCY = "Currency";

    private const LANGUAGE = "Language";

    private const LOGOUT = "Logout";


    public function logout(): string
    {
        return self::LOGOUT;
    }

    function emailAddress(): string
    {
        return self::EMAIL_ADDRESS;
    }

    function password(): string
    {
        return self::PASSWORD;
    }

    function confirmPassword(): string
    {
        return self::CONFIRM_PASSWORD;
    }

    function currency(): string
    {
        return self::CURRENCY;
    }

    function language(): string
    {
        return self::LANGUAGE;
    }

    function fieldCannotBeNull(): string
    {
        return self::FIELD_CANNOT_BE_NULL;
    }

    function invalidValue(): string
    {
        return self::INVALID_VALUE;
    }

    function invalidPasswordLength(): string
    {
        return self::INVALID_PASSWORD_LENGTH;
    }

    function passwordsDoNotMatch(): string
    {
        return self::PASSWORDS_DO_NOT_MATCH;
    }

    public function emailTaken(): string
    {
        return self::EMAIL_TAKEN;
    }

    function invalidPassword(): string
    {
        return self::INVALID_PASSWORD;
    }

    function emailDoesNotExist(): string
    {
        return self::EMAIL_NOT_FOUND;
    }

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