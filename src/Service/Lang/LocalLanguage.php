<?php

namespace App\Service\Lang;


use App\Entity\Language;
use App\Lang\LanguagePack;

interface LocalLanguage
{
    /**
     * @param string $langType
     */
    public function setLang(string $langType): void;

    /**
     * @return string
     */
    public function getLocalLang(): string;

    /**
     * @param string $funcName
     * @return string
     */
    public function forName(string $funcName): string;

    /**
     * @param string $langName
     * @return Language|null
     */
    public function findLanguageByName(string $langName): ?Language;

    /**
     * @return LanguagePack
     */
    public function dictionary(): LanguagePack;

    /**
     * @return Language[]
     */
    public function findCurrentLangs(): array;
}