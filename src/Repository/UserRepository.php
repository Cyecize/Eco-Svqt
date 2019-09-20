<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\ORM\NonUniqueResultException;

class UserRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * @param string $email
     * @return User|null
     */
    function findOneByEmail(string $email): ?User
    {
        $qb = $this->createQueryBuilder('u');

        try {
            return $qb
                ->where('u.email = :email')
                ->setParameter('email', $email)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            throw new \RuntimeException($e);
        }
    }
}