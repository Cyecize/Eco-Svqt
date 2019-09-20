<?php

namespace App\Service;

use App\Service\Currency\CurrencyService;
use App\Service\Lang\LangDbService;
use App\Service\Location\CountryService;
use App\Service\Location\TownService;
use App\Service\User\RoleService;

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

    /**
     * @var CountryService
     */
    private $countryService;

    /**
     * @var TownService
     */
    private $townService;

    /**
     * @var RoleService
     */
    private $roleService;

    public function __construct(LangDbService $langService, CurrencyService $currencyService, CountryService $countryService, TownService $townService, RoleService $roleService)
    {
        $this->langService = $langService;
        $this->currencyService = $currencyService;
        $this->countryService = $countryService;
        $this->townService = $townService;
        $this->roleService = $roleService;
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
        $this->roleService->init();
    }
}