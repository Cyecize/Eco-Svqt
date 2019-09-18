<?php

namespace App\Service\Currency;


use App\Constant\PreDefinedCurrency;
use App\Entity\Currency;

interface CurrencyService
{

    public function init(): void;

    /**
     * Finds the equivalent currency entry in the DB.
     *
     * @param PreDefinedCurrency $preDefinedCurrency
     * @return Currency
     */
    public function get(PreDefinedCurrency $preDefinedCurrency): Currency;
}