<?php


namespace App\Repository;


use App\Util\Page;
use App\Util\Pageable;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

abstract class BaseRepository extends EntityRepository
{
    /**
     * @param Pageable $pageable
     * @return Page
     */
    public function findAllPage(Pageable $pageable): Page
    {
        return new Page($this->createQueryBuilder('e')->orderBy('e.id', 'DESC'), $pageable);
    }

    /**
     * @param Pageable $pageable
     * @param QueryBuilder $queryBuilder
     * @return Page
     */
    public function findByPage(Pageable $pageable, QueryBuilder $queryBuilder): Page
    {
        return new Page($queryBuilder, $pageable);
    }

    /**
     * @param QueryBuilder $qb
     * @param string $searchText
     * @param array $fieldsToInclude
     * @param string $alias
     * @return QueryBuilder
     */
    protected function forgeSearchQueryBuilder(QueryBuilder $qb, string $searchText, array $fieldsToInclude, string $alias = 'e'): QueryBuilder
    {
        $searchText = preg_replace('/\s+/', '%', $searchText);

        if (count($fieldsToInclude) < 1) {
            return $qb;
        }

        $qb = $qb->where($qb->expr()->like("$alias." . $fieldsToInclude[0], ':pattern'));

        if (count($fieldsToInclude) > 1) {
            for ($i = 1; $i, count($fieldsToInclude); $i++) {
                $qb = $qb->orWhere($qb->expr()->like("$alias." . $fieldsToInclude[$i], ':pattern'));
            }
        }

        $qb->setParameter('pattern', "%$searchText%");

        return $qb;
    }
}