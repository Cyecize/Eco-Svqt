<?php

namespace App\Service;


use App\Entity\Country;

interface CountryService
{
    public function init();

    /**
     * @param string $countryName
     * @return Country|null
     */
    public function findByName(string $countryName): ?Country;
}