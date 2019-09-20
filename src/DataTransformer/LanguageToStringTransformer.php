<?php

namespace App\DataTransformer;

use App\Entity\Language;
use App\Service\Lang\LangDbService;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class LanguageToStringTransformer implements DataTransformerInterface
{
    /**
     * @var LangDbService
     */
    private $languageService;

    public function __construct(LangDbService $languageService)
    {
        $this->languageService = $languageService;
    }

    /**
     * @param Language $language
     * @return int|null
     */
    public function transform($language)
    {
        if ($language != null) {
            return $language->getLocaleName();
        }

        return null;
    }

    /**
     * @param string $localeName
     * @return Language|null
     */
    public function reverseTransform($localeName)
    {
        if ($localeName == null) throw new TransformationFailedException();
        $language = $this->languageService->findLangByLocale($localeName);

        if ($language == null) throw new TransformationFailedException();

        return $language;
    }
}