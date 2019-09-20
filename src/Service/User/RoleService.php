<?php

namespace App\Service\User;

use App\Entity\Role;
use App\Exception\IllegalArgumentException;

interface RoleService
{
    public function init(): void;

    /**
     * @param string $roleName
     * @return Role
     * @throws IllegalArgumentException
     */
    public function createRole(string $roleName): ?Role;

    /**
     * @param int $id
     * @return Role
     */
    public function findById(int $id): ?Role;

    /**
     * @param string $roleName
     * @return Role
     */
    public function findByRoleName(string $roleName): ?Role;

    /**
     * @return Role[]
     */
    public function findAll(): array;
}