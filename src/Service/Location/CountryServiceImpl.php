<?php

namespace App\Service\Location;


use App\Entity\Country;
use App\Util\YamlFile;
use Doctrine\ORM\EntityManagerInterface;

class CountryServiceImpl implements CountryService
{

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var \App\Repository\CountryRepository|\Doctrine\Common\Persistence\ObjectRepository
     */
    private $repository;

    /**
     * @var YamlFile
     */
    private $locationsFile;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->entityManager->getRepository(Country::class);
        $this->locationsFile = YamlFile::getLocationsFile();
    }

    public function init()
    {
        if ($this->repository->count([]) > 0) {
            return;
        }

        foreach ($this->locationsFile->get("countries") as $id => $name) {
            $country = new Country();
            $country->setCountryName($name);
            $country->setId($id);

            $this->entityManager->persist($country);
        }

        $this->entityManager->flush();
    }

    public function findByName(string $countryName): ?Country
    {
        return $this->repository->findOneBy(array('countryName' => $countryName));
    }
}