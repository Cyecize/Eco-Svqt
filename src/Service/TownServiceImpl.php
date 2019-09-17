<?php

namespace App\Service;

use App\Entity\Town;
use App\Util\YamlFile;
use Doctrine\ORM\EntityManagerInterface;

class TownServiceImpl implements TownService
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var \App\Repository\TownRepository|\Doctrine\Common\Persistence\ObjectRepository
     */
    private $repository;

    /**
     * @var YamlFile
     */
    private $locationsFile;

    /**
     * @var CountryService
     */
    private $countryService;

    public function __construct(EntityManagerInterface $entityManager, CountryService $countryService)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->entityManager->getRepository(Town::class);
        $this->locationsFile = YamlFile::getLocationsFile();
        $this->countryService = $countryService;
    }

    public function init()
    {
        if ($this->repository->count([]) > 0) {
            return;
        }

        foreach ($this->locationsFile->get("towns") as $countryName => $towns) {
            foreach ($towns as $town) {
                $townEntity = new Town();
                $townEntity->setId($town["id"]);
                $townEntity->setCountry($this->countryService->findByName($countryName));
                $townEntity->setPostCode($town["postCode"]);
                $townEntity->setTownName($town["townName"]);

                $this->entityManager->persist($townEntity);
            }

            $this->entityManager->flush();
        }
    }
}