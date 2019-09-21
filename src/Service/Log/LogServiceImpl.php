<?php


namespace App\Service\Log;


use App\Entity\Log;
use App\Repository\LogRepository;
use App\Util\Page;
use App\Util\Pageable;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;

class LogServiceImpl implements LogService
{

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var LogRepository|ObjectRepository
     */
    private $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->entityManager->getRepository(Log::class);
    }

    public function log(string $location, string $message): void
    {
        $log = new Log();

        $log->setLocation($location);
        $log->setMessage($message);

        $this->entityManager->persist($log);
        $this->entityManager->flush();
    }

    public function findAll(Pageable $pageable): Page
    {
        return $this->repository->findAllPage($pageable);
    }
}