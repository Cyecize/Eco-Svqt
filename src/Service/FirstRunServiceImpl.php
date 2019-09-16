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

    public function __construct(LangDbService $langService, CurrencyService $currencyService)
    {
        $this->langService = $langService;
        $this->currencyService = $currencyService;
    }

    /**
     * Creates initial db content like roles, main category, languages
     */
    public function initDb(): void
    {
        $this->langService->initLanguages();
        $this->currencyService->init();
    }
}