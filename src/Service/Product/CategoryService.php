<?php

namespace App\Service\Product;

use App\BindingModel\Product\CreateCategoryBindingModel;
use App\Entity\Category;

interface CategoryService
{
    /**
     * @param CreateCategoryBindingModel $bindingModel
     * @return Category
     */
    public function createCategory(CreateCategoryBindingModel $bindingModel): Category;

    /**
     * @param int $id
     * @return Category|null
     */
    public function findById(int $id): ?Category;

    /**
     * @return Category[]
     */
    public function findMain(): array;

    /**
     * @return Category[]
     */
    public function findAll(): array;
}