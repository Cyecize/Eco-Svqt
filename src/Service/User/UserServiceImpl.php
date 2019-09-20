<?php

namespace App\Service\User;

use App\BindingModel\User\UserRegisterBindingModel;
use App\Constant\Roles;
use App\Entity\User;
use App\Util\ModelMapper;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserServiceImpl implements UserService
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var \App\Repository\UserRepository|\Doctrine\Common\Persistence\ObjectRepository
     */
    private $repository;

    /**
     * @var
     */
    private $modelMapper;

    /**
     * @var RoleService
     */
    private $roleService;

    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    public function __construct(EntityManagerInterface $entityManager, ModelMapper $modelMapper, RoleService $roleService, UserPasswordEncoderInterface $encoder)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->entityManager->getRepository(User::class);
        $this->modelMapper = $modelMapper;
        $this->roleService = $roleService;
        $this->encoder = $encoder;
    }

    public function createUser(UserRegisterBindingModel $bindingModel, string $roleType): User
    {
        $user = $this->modelMapper->map($bindingModel, User::class);
        $roles = null;

        if ($this->count() < 1) {
            $roleType = Roles::GOD; //If this is the first user, make him GOD.
        }

        switch ($roleType) {
            case Roles::GOD:
                $roles = $this->getRoleAndDependingRoles(Roles::ALL);
                break;
            case Roles::ADMIN:
                $roles = $this->getRoleAndDependingRoles([Roles::ADMIN, Roles::USER]);
                break;
            default:
                $roles = $this->getRoleAndDependingRoles([Roles::USER]);
                break;
        }

        foreach ($roles as $role) {
            $user->addRole($role);
        }

        $user->setPassword($this->encoder->encodePassword($user, $user->getPassword()));

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $user;
    }

    public function count(): int
    {
        return $this->repository->count([]);
    }

    public function findByEmail(string $email): ?User
    {
        return $this->repository->findOneByEmail($email);
    }

    public function findAll(): array
    {
        return $this->repository->findAll();
    }

    private function getRoleAndDependingRoles(array $roleNames): array
    {
        $roles = [];

        foreach ($roleNames as $roleName) {
            $roles[] = $this->roleService->findByRoleName($roleName);
        }

        return $roles;
    }
}