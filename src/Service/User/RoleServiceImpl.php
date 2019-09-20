<?php

namespace App\Service\User;

use App\Constant\Roles;
use App\Entity\Role;
use App\Exception\IllegalArgumentException;
use App\Repository\RoleRepository;
use Doctrine\ORM\EntityManagerInterface;

class RoleServiceImpl implements RoleService
{
    private const ROLE_NAME_TAKEN = "Role with that name already exists!";

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var RoleRepository|\Doctrine\Common\Persistence\ObjectRepository
     */
    private $roleRepo;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->roleRepo = $entityManager->getRepository(Role::class);
    }

    function init(): void
    {
        try {
            foreach (Roles::ALL as $roleName) {
                if ($this->findByRoleName($roleName) == null) {
                    $this->createRole($roleName);
                }
            }
        } catch (IllegalArgumentException $e) {
        }
    }

    function createRole(string $roleName): ?Role
    {
        if ($this->findByRoleName($roleName) != null) {
            throw new IllegalArgumentException(self::ROLE_NAME_TAKEN);
        }

        $role = new Role($roleName);

        $this->entityManager->persist($role);
        $this->entityManager->flush();

        return $role;
    }

    function findById(int $id): ?Role
    {
        return $this->roleRepo->find($id);
    }

    function findByRoleName(string $roleName): ?Role
    {
        return $this->roleRepo->findOneBy(array('role' => $roleName));
    }

    function findAll(): array
    {
        return $this->roleRepo->findAll();
    }
}