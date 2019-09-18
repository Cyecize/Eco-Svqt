<?php

namespace App\Service\Currency;


use App\Constant\PreDefinedCurrency;
use App\Util\YamlFile;

class CurrencyRateServiceImpl implements CurrencyRateService
{

    /**
     * @var YamlFile
     */
    private $currenciesFile;

    public function __construct()
    {
        $this->loadCurrencyFile();
    }

    /**
     * @return void
     */
    public function updateCurrencyRates()
    {
        // TODO: Implement updateCurrencyRates() method.
    }

    /**
     * Set the currency multiplier for a given currency.
     * @param PreDefinedCurrency $currency
     * @return void
     */
    public function setCurrencyRate(PreDefinedCurrency $currency)
    {
        $currency->setMultiplier($this->currenciesFile->get($currency->getSign()));
    }

    private function loadCurrencyFile()
    {
        $this->currenciesFile = YamlFile::getCurrenciesFile();
    }
}