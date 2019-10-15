<?php

namespace App\Util;

use App\Entity\Category;
use App\Entity\Phrase;
use App\Entity\Product;
use App\Service\Lang\LocalLanguage;

class TwigProductUtils
{
    /**
     * @var LocalLanguage
     */
    private $localLanguage;

    public function __construct(LocalLanguage $localLanguage)
    {
        $this->localLanguage = $localLanguage;
    }

    public function categoryTitle(Category $category): string
    {
        return $this->getPhraseForCurrentLocale($category->getTitles());
    }

    public function productTitle(Product $product): string
    {
        return $this->getPhraseForCurrentLocale($product->getTitles());
    }

    public function productDescription(Product $product): string
    {
        return $this->getPhraseForCurrentLocale($product->getDescriptions());
    }

    /**
     * @param Phrase[] $phrases
     * @return string
     */
    private function getPhraseForCurrentLocale($phrases): string
    {
        foreach ($phrases as $phrase) {
            if ($phrase->getLanguage()->getLocaleName() == $this->localLanguage->getLocalLang()) {
                return $phrase->getPhrase();
            }
        }

        return "";
    }
}