<?php

namespace App\Service;


interface FirstRunService
{
    /**
     * Creates initial db content like roles, main category, languages
     */
    public function initDb(): void;
}