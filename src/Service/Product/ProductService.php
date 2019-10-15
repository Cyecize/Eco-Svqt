<?php

namespace App\Service\Product;

use App\BindingModel\Product\CreateProductBindingModel;
use App\Entity\Product;
use App\Util\Page;
use App\Util\Pageable;

interface ProductService
{
    /**
     * @param CreateProductBindingModel $bindingModel
     * @return Product
     */
    public function createProduct(CreateProductBindingModel $bindingModel): Product;

    /**
     * @param string $searchString
     * @param Pageable $pageable
     * @return Page
     */
    public function searchProduct(string $searchString, Pageable $pageable): Page;

}