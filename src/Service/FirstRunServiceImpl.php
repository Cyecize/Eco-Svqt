<?php

namespace App\Service;

class FirstRunServiceImpl implements FirstRunService
{

    /**
     * @var LangDbService
     */
    private $langService;

    public function __construct(LangDbService $langService)
    {
        $this->langService = $langService;
    }

    /**
     * Creates initial db content like roles, main category, languages
     */
    public function initDb(): void
    {
        $this->langService->initLanguages();
    }
}