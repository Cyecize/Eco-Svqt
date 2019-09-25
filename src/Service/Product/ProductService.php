<?php

namespace App\Service\Product;

use App\BindingModel\Product\CreateProductBindingModel;
use App\Entity\Product;

interface ProductService
{
    /**
     * @param CreateProductBindingModel $bindingModel
     * @return Product
     */
    public function createProduct(CreateProductBindingModel $bindingModel): Product;

}