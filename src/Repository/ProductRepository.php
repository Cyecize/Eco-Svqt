<?php

namespace App\Repository;

use App\Util\Page;
use App\Util\Pageable;

class ProductRepository extends BaseRepository
{
    public function search(string $text, Pageable $pageable): Page
    {
        $qb = $this->createQueryBuilder('p');
        $qb = $qb->join('p.titles', 'pt');
        $qb = $qb->join('p.descriptions', 'pd');

        $qb = $this->forgeSearchQueryBuilder($qb, $text, ['pt.phrase', 'pd.phrase']);

        $qb = $qb->distinct(true);

        return parent::findByPage($pageable, $qb);
    }
}