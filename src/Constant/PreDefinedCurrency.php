<?php

namespace App\Constant;

/**
 * Class LocalCurrencies
 * @package App\Constant
 *
 * Pre-defined exchange rates as of 13 Sep 2019!
 *
 * TODO: move the pre-defined exchange rates into a config file and then update them every day with cron job.
 */
class PreDefinedCurrency
{
    /**
     * @var string
     */
    private $currencyName;

    /**
     * @var string
     */
    private $sign;

    /**
     * @var double
     */
    private $multiplier;

    private function __construct($currencyName, $sign, $multiplier)
    {
        $this->currencyName = $currencyName;
        $this->sign = $sign;
        $this->multiplier = $multiplier;
    }

    /**
     * Creates instance of Bulgarian Lev Currency.
     * @return PreDefinedCurrency
     */
    public static function BGN(): PreDefinedCurrency
    {
        return new PreDefinedCurrency("Bulgarian Lev", "BGN", 1);
    }

    /**
     * Creates Instance of USD Currency.
     * @return PreDefinedCurrency
     */
    public static function USD(): PreDefinedCurrency
    {
        return new PreDefinedCurrency("United States Dollar", "USD", 1.76418182);
    }

    /**
     * Creates Instance of EURO Currency.
     * @return PreDefinedCurrency
     */
    public static function EUR(): PreDefinedCurrency
    {
        return new PreDefinedCurrency("Euro", "EUR", 1.95618848);
    }

    /**
     * @return string
     */
    public function getCurrencyName(): string
    {
        return $this->currencyName;
    }

    /**
     * @return string
     */
    public function getSign(): string
    {
        return $this->sign;
    }

    /**
     * @return float
     */
    public function getMultiplier(): float
    {
        return $this->multiplier;
    }
}