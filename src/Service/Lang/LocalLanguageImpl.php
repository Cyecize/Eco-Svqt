<?php

namespace App\Service\Lang;


use App\Constant\Config;
use App\Entity\Language;
use App\Lang\LanguagePack;
use App\Lang\LanguagePackBG;
use App\Lang\LanguagePackEN;

class LocalLanguageImpl implements LocalLanguage
{
    private const COOKIE_EXPIRE = 7200; //2HR

    /**
     * @var LanguagePack
     */
    private $languagePack;

    /**
     * @var string
     */
    private $currentLang;

    /**
     * @var LangDbService
     */
    private $languageDbService;

    public function __construct(LangDbService $languageDb)
    {
        $this->languageDbService = $languageDb;
        $this->initLang();
        if (isset($_GET[Config::COOKIE_LANG_NAME]))
            $this->setLang($_GET[Config::COOKIE_LANG_NAME]);
    }

    public function findCurrentLangs(): array
    {
        return $this->languageDbService->findRange(array(Config::COOKIE_NEUTRAL_LANG, $this->currentLang));
    }

    public function getLocalLang(): string
    {
        return strtolower($this->currentLang);
    }

    public function findLanguageByName(string $langName): ?Language
    {
        return $this->languageDbService->findLangByLocale($langName);
    }

    public function forName(string $funcName): string
    {
        if (method_exists($this->languagePack, $funcName))
            return $this->languagePack->{$funcName}();
        return $funcName;
    }

    public function setLang(string $langType): void
    {
        switch (strtolower($langType)) {
            case Config::COOKIE_EN_LANG:
                $this->languagePack = new LanguagePackEN();
                break;
            case Config::COOKIE_BG_LANG:
                $this->languagePack = new LanguagePackBG();
                break;
            default:
                $this->languagePack = new LanguagePackBG();
                $langType = Config::COOKIE_BG_LANG;
                break;
        }

        $this->setCookie($langType);
        $this->currentLang = $langType;
    }

    private function initLang(): void
    {
        if (!isset($_COOKIE[Config::COOKIE_LANG_NAME])) {
            $this->languagePack = new LanguagePackBG();
            $this->currentLang = Config::COOKIE_BG_LANG;
            $this->setCookie($this->currentLang);
            return;
        }

        $this->setLang($_COOKIE[Config::COOKIE_LANG_NAME]);
    }

    private function setCookie($lang)
    {
        setcookie(Config::COOKIE_LANG_NAME, $lang, time() + self::COOKIE_EXPIRE, '/');
    }

    public function dictionary(): LanguagePack
    {
        return $this->languagePack;
    }
}