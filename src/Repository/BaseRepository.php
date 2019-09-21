<?php


namespace App\Repository;


use App\Util\Page;
use App\Util\Pageable;
use Doctrine\ORM\EntityRepository;

abstract class BaseRepository extends EntityRepository
{
    public function findAllPage(Pageable $pageable): Page
    {
        return new Page($this->createQueryBuilder('e')->orderBy('e.id', 'DESC'), $pageable);
    }
}