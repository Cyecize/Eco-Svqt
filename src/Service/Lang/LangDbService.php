<?php

namespace App\Service\Lang;


use App\Entity\Language;

interface LangDbService
{
    /**
     * Creates initial languages
     */
    public function initLanguages(): void;

    /**
     * @param int $id
     * @return Language|null
     */
    public function findLangById(int $id): ?Language;

    /**
     * @param string $locale
     * @return Language|null
     */
    public function findLangByLocale(string $locale): ?Language;

    /**
     * @return Language[]
     */
    public function findAll(): array;

    /**
     * @param array $langs
     * @return Language[]
     */
    public function findRange(array $langs): array;
}