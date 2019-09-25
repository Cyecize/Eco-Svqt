<?php

namespace App\Service\Product;

use App\BindingModel\Product\CreateProductBindingModel;
use App\Constant\Config;
use App\Entity\Product;
use App\Repository\ProductRepository;
use App\Service\Lang\LangDbService;
use App\Service\Lang\PhraseService;
use App\Util\ModelMapper;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;

class ProductServiceImpl implements ProductService
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var ProductRepository|ObjectRepository
     */
    private $repository;

    /**
     * @var ModelMapper
     */
    private $modelMapper;

    /**
     * @var PhraseService
     */
    private $phraseService;

    /**
     * @var LangDbService
     */
    private $languageService;

    public function __construct(EntityManagerInterface $entityManager, ModelMapper $modelMapper, PhraseService $phraseService, LangDbService $langDbService)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->entityManager->getRepository(Product::class);
        $this->modelMapper = $modelMapper;
        $this->phraseService = $phraseService;
        $this->languageService = $langDbService;
    }

    public function createProduct(CreateProductBindingModel $bindingModel): Product
    {
        $product = $this->modelMapper->map($bindingModel, Product::class);

        $product->addTitle($this->phraseService->create($bindingModel->getBgTitle(), $this->languageService->findLangByLocale(Config::COOKIE_BG_LANG)));
        $product->addTitle($this->phraseService->create($bindingModel->getEnTitle(), $this->languageService->findLangByLocale(Config::COOKIE_EN_LANG)));

        $product->addDescription($this->phraseService->create($bindingModel->getBgDescription(), $this->languageService->findLangByLocale(Config::COOKIE_BG_LANG)));
        $product->addDescription($this->phraseService->create($bindingModel->getEnDescription(), $this->languageService->findLangByLocale(Config::COOKIE_EN_LANG)));

        $this->entityManager->persist($product);
        $this->entityManager->flush();

        return $product;
    }
}