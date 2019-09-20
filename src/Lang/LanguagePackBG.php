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

    private const INVALID_PASSWORD = "Грешна парола!";

    private const EMAIL_NOT_FOUND = "Е-Mail адресът не е намерен.";

    private const EMAIL_TAKEN = "Е-Mail адресът е зает.";

    private const PASSWORDS_DO_NOT_MATCH = "Паролите не съвпадат.";

    private const INVALID_PASSWORD_LENGTH = "Невалидна дължина на паролата.";

    private const INVALID_VALUE = "Невалидна стойност.";

    private const FIELD_CANNOT_BE_NULL = "Полето не може да бъде празно.";

    private const EMAIL_ADDRESS = "Email адрес";

    private const PASSWORD = "Парола";

    private const CONFIRM_PASSWORD = "Потвърдете паролата";

    private const CURRENCY = "Валута";

    private const LANGUAGE = "Език";

    private const LOGOUT = "Изход";


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