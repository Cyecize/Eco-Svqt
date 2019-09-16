<?php

namespace App\Service;

use App\Constant\PreDefinedCurrency;
use App\Entity\Currency;
use App\Repository\CurrencyRepository;
use App\Util\ModelMapper;
use Doctrine\ORM\EntityManagerInterface;

class CurrencyServiceImpl implements CurrencyService
{

    /**
     * @var CurrencyRepository|\Doctrine\Common\Persistence\ObjectRepository
     */
    private $repository;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var ModelMapper
     */
    private $modelMapper;

    public function __construct(EntityManagerInterface $entityManager, ModelMapper $modelMapper)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->entityManager->getRepository(Currency::class);
        $this->modelMapper = $modelMapper;
    }

    public function init(): void
    {
        if ($this->repository->count([]) < 1) {
            foreach (PreDefinedCurrency::ALL() as $localCurrency) {
                $currency = $this->modelMapper->map($localCurrency, Currency::class);
                $this->entityManager->persist($currency);
            }

            $this->entityManager->flush();
        }
    }

    /**
     * Finds the equivalent currency entry in the DB.
     *
     * @param PreDefinedCurrency $preDefinedCurrency
     * @return Currency
     */
    public function get(PreDefinedCurrency $preDefinedCurrency): Currency
    {
        return $this->repository->findOneBy(array('sign' => $preDefinedCurrency->getSign()));
    }
}