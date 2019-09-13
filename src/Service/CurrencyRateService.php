<?php

namespace App\Service;

use App\Constant\PreDefinedCurrency;

interface CurrencyRateService
{
    /**
     * @return void
     */
    public function updateCurrencyRates();

    /**
     * Set the currency multiplier for a given currency.
     * @param PreDefinedCurrency $currency
     * @return void
     */
    public function setCurrencyRate(PreDefinedCurrency $currency);
}