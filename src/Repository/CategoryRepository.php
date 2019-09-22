<?php

namespace App\Repository;

use App\Entity\Category;
use Doctrine\ORM\EntityRepository;

class CategoryRepository extends EntityRepository
{
    /**
     * @param Category|null $parent
     * @return Category[]
     */
    public function findByParent(?Category $parent): array
    {
        $qb = $this->createQueryBuilder('c');

        return $qb->
        where($qb->expr()->eq('c.parentCategory', ':parent'))
            ->setParameter('parent', $parent)
            ->getQuery()
            ->getArrayResult();
    }
}