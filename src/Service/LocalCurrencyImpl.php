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

    public function __construct()
    {
        $this->initCurrency();
    }

    public function setCurrency(string $currencyType)
    {
        $newCurrency = null;

        switch (strtoupper($currencyType)) {
            case PreDefinedCurrency::BGN()->getSign():
                $newCurrency = PreDefinedCurrency::BGN();
                break;
            case PreDefinedCurrency::EUR()->getSign():
                $newCurrency = PreDefinedCurrency::EUR();
                break;
            case PreDefinedCurrency::USD()->getSign():
                $newCurrency = PreDefinedCurrency::USD();
                break;
            default:
                $newCurrency = PreDefinedCurrency::BGN();
                break;
        }

        if ($this->currentCurrency == null || $this->currentCurrency->getSign() !== $newCurrency->getSign()) {
            $this->currentCurrency = $newCurrency;
            $this->setCookie($newCurrency->getSign());
        }
    }

    public function getLocalCurrency(): PreDefinedCurrency
    {
        return $this->currentCurrency;
    }

    private function initCurrency()
    {
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