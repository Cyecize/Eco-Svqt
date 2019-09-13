<?php

namespace App\Service;


use App\Constant\PreDefinedCurrency;

interface LocalCurrency
{

    /**
     * Set the local currency type to cookie.
     * @param string $currencyType
     * @return mixed
     */
    public function setCurrency(string $currencyType);

    /**
     * Get the local currency from cookie.
     * @return PreDefinedCurrency
     */
    public function getLocalCurrency(): PreDefinedCurrency;
}