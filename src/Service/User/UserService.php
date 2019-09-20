<?php

namespace App\Service\User;

use App\BindingModel\User\UserRegisterBindingModel;
use App\Entity\User;

interface UserService
{
    /**
     * @param UserRegisterBindingModel $bindingModel
     * @param string $roleType
     * @return User
     */
    public function createUser(UserRegisterBindingModel $bindingModel, string $roleType): User;

    /**
     * @return int
     */
    public function count(): int;

    /**
     * @param string $email
     * @return User|null
     */
    public function findByEmail(string $email): ?User;

    /**
     * @return array
     */
    public function findAll(): array;
}