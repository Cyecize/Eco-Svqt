<?php

namespace App\Service;

use App\Constant\Config;
use App\Constant\PreDefinedCurrency;

class LocalCurrencyImpl implements LocalCurrency
{
    private const COOKIE_EXPIRE = 7200; //2HR

    /**
     * @var PreDefinedCurrency
     */
    private $currentCurrency;

    /**
     * @var CurrencyRateService
     */
    private $currencyRateService;

    /**
     * @var PreDefinedCurrency[]
     */
    private $allCurrencies;

    public function __construct(CurrencyRateService $currencyRateService)
    {
        $this->currencyRateService = $currencyRateService;
        $this->initCurrency();
    }

    public function setCurrency(string $currencyType)
    {
        $currencyType = strtoupper($currencyType);

        foreach ($this->allCurrencies as $currentCurrency) {
            if ($currentCurrency->getSign() === $currencyType) {

                if ($this->currentCurrency == null || $this->currentCurrency->getSign() !== $currentCurrency->getSign()) {
                    $this->currencyRateService->setCurrencyRate($currentCurrency);
                    $this->currentCurrency = $currentCurrency;
                    $this->setCookie($currentCurrency->getSign());
                }
            }
        }
    }

    public function getLocalCurrency(): PreDefinedCurrency
    {
        return $this->currentCurrency;
    }

    private function initCurrency()
    {
        $this->allCurrencies = PreDefinedCurrency::ALL();

        if (isset($_COOKIE[Config::COOKIE_CURRENCY_NAME])) {
            $this->setCurrency($_COOKIE[Config::COOKIE_CURRENCY_NAME]);
            return;
        }

        $this->setCurrency(PreDefinedCurrency::BGN()->getSign());
    }

    /**
     * @param $currencySign
     */
    private function setCookie($currencySign)
    {
        setcookie(Config::COOKIE_CURRENCY_NAME, $currencySign, time() + self::COOKIE_EXPIRE, '/');
    }
}