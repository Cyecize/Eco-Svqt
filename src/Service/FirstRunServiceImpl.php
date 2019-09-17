<?php

namespace App\Service;

class FirstRunServiceImpl implements FirstRunService
{

    /**
     * @var LangDbService
     */
    private $langService;

    /**
     * @var CurrencyService
     */
    private $currencyService;

    private $countryService;

    private $townService;

    public function __construct(LangDbService $langService, CurrencyService $currencyService, CountryService $countryService, TownService $townService)
    {
        $this->langService = $langService;
        $this->currencyService = $currencyService;
        $this->countryService = $countryService;
        $this->townService = $townService;
    }

    /**
     * Creates initial db content like roles, main category, languages
     */
    public function initDb(): void
    {
        $this->langService->initLanguages();
        $this->currencyService->init();
        $this->countryService->init();
        $this->townService->init();
    }
}