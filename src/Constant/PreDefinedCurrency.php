<?php

namespace App\Constant;

/**
 * Class LocalCurrencies
 * @package App\Constant
 *
 * These exchange rates are not the final ones. The rates are corrected before showing to the view.
 */
class PreDefinedCurrency
{

    private static $ALL = null;

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
        return new PreDefinedCurrency("United States Dollar", "USD", 1.7);
    }

    /**
     * Creates Instance of EURO Currency.
     * @return PreDefinedCurrency
     */
    public static function EUR(): PreDefinedCurrency
    {
        return new PreDefinedCurrency("Euro", "EUR", 1.9);
    }

    /**
     * @return PreDefinedCurrency[]
     */
    public static final function ALL(): array
    {
        if (self::$ALL == null) {
            self::$ALL = [self::BGN(), self::USD(), self::EUR()];
        }

        return self::$ALL;
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

    public function setMultiplier(float $multiplier)
    {
        $this->multiplier = $multiplier;
    }
}