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
}