<?php

namespace App\Repository;

use App\Entity\Language;
use App\Entity\Phrase;
use App\Util\Page;
use App\Util\Pageable;

class PhraseRepository extends BaseRepository
{
    /**
     * @param string $text
     * @param Language $language
     * @return Phrase[]
     */
    public function search(string $text, Language $language): array
    {
        $qb = $this->createQueryBuilder('p');

        $qb = $this->forgeSearchQueryBuilder($qb, $text, ['phrase'], 'p');
        $qb = $qb->andWhere($qb->expr()->eq('p.language', ':language'));

        $qb->setParameter('language', $language);

        return $qb->getQuery()->getArrayResult();
    }

    /**
     * @param Language $language
     * @param Pageable $pageable
     * @return Page
     */
    public function findByLanguage(Language $language, Pageable $pageable): Page
    {
        $qb = $this->createQueryBuilder('p');

        $qb = $qb->where($qb->expr()->eq('p.language', ':language'));
        $qb->setParameter('language', $language);

        return $this->findByPage($pageable, $qb);
    }
}