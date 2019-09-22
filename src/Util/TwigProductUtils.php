<?php

namespace App\Util;

use App\Entity\Category;
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
        foreach ($category->getTitles() as $title) {
            if ($title->getLanguage()->getLocaleName() == $this->localLanguage->getLocalLang()) {
                return $title->getPhrase();
            }
        }

        return "";
    }
}