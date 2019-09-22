<?php

namespace App\Service\Lang;

use App\Entity\Language;
use App\Entity\Phrase;
use App\Util\Page;
use App\Util\Pageable;

interface PhraseService
{
    /**
     * @param string $text
     * @param Language $language
     * @return Phrase
     */
    public function create(string $text, Language $language): Phrase;

    /**
     * @param int $id
     * @return Phrase|null
     */
    public function findById(int $id): ?Phrase;

    /**
     * @param string $text
     * @param Language $language
     * @return Phrase[]
     */
    public function search(string $text, Language $language): array;

    /**
     * @param Language $language
     * @param Pageable $pageable
     * @return Page<Phrase>
     */
    public function findAll(Language $language, Pageable $pageable): Page;
}