<?php

namespace App\DataTransformer;

use App\Constant\PreDefinedCurrency;
use App\Entity\Currency;
use App\Service\Currency\CurrencyService;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class CurrencyToStringTransformer implements DataTransformerInterface
{
    /**
     * @var CurrencyService
     */
    private $currencyService;

    public function __construct(CurrencyService $currencyService)
    {
        $this->currencyService = $currencyService;
    }

    /**
     * @param Currency $currency
     * @return int|null
     */
    public function transform($currency)
    {
        if ($currency != null) {
            return $currency->getSign();
        }

        return null;
    }

    /**
     * @param string $currencySign
     * @return Currency|null
     */
    public function reverseTransform($currencySign)
    {
        if ($currencySign == null) throw new TransformationFailedException();

        foreach (PreDefinedCurrency::ALL() as $localCurrency) {
            if ($localCurrency->getSign() == $currencySign) {
                return $this->currencyService->get($localCurrency);
            }
        }

        throw new TransformationFailedException();
    }
}