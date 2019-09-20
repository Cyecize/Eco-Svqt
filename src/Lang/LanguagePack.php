<?php

namespace App\Lang;


interface LanguagePack
{
    function getLocalLang(): string;

    function websiteName(): string;

    function home(): string;

    function products(): string;

    function contacts(): string;

    function login(): string;

    function register(): string;

    function followUs(): string;

    function myAccount(): string;

    function quickOrder(): string;

    function searchProductsHere(): string;

    function invalidPassword(): string;

    function emailDoesNotExist(): string;

    function fieldCannotBeNull(): string;

    function invalidValue(): string;

    function invalidPasswordLength(): string;

    function passwordsDoNotMatch(): string;

    function emailTaken(): string;

    function emailAddress(): string;

    function password(): string;

    function confirmPassword(): string;

    function currency(): string;

    function language(): string;

    function logout(): string;
}