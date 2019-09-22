<?php

namespace App\Service\Product;

use App\BindingModel\Product\CreateCategoryBindingModel;
use App\Constant\Config;
use App\Entity\Category;
use App\Repository\CategoryRepository;
use App\Service\Lang\LangDbService;
use App\Service\Lang\PhraseService;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;

class CategoryServiceImpl implements CategoryService
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManger;

    /**
     * @var CategoryRepository|ObjectRepository
     */
    private $repository;

    /**
     * @var LangDbService
     */
    private $languageService;

    /**
     * @var PhraseService
     */
    private $phraseService;

    public function __construct(EntityManagerInterface $entityManager, LangDbService $langDbService, PhraseService $phraseService)
    {
        $this->entityManger = $entityManager;
        $this->repository = $this->entityManger->getRepository(Category::class);
        $this->languageService = $langDbService;
        $this->phraseService = $phraseService;
    }

    public function createCategory(CreateCategoryBindingModel $bindingModel): Category
    {
        $category = new Category();

        $category->setParentCategory($bindingModel->getParentCategory());

        $category->addTitle($this->phraseService->create($bindingModel->getBgTitle(), $this->languageService->findLangByLocale(Config::COOKIE_BG_LANG)));
        $category->addTitle($this->phraseService->create($bindingModel->getEnTitle(), $this->languageService->findLangByLocale(Config::COOKIE_EN_LANG)));

        $this->entityManger->persist($category);
        $this->entityManger->flush();

        return $category;
    }

    public function findById(int $id): ?Category
    {
        return $this->repository->find($id);
    }

    public function findMain(): array
    {
        return $this->repository->findByParent(null);
    }

    public function findAll(): array
    {
        return $this->repository->findAll();
    }
}