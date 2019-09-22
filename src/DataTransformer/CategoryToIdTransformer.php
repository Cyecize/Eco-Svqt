<?php

namespace App\DataTransformer;

use App\Service\Product\CategoryService;
use Symfony\Component\Form\DataTransformerInterface;

class CategoryToIdTransformer implements DataTransformerInterface
{
    /**
     * @var CategoryService
     */
    private $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function transform($value)
    {
        if ($value != null) {
            return $value->getId();
        }

        return null;
    }

    public function reverseTransform($id)
    {
        if ($id == null || !is_numeric($id)) {
            return null;
        }

        $id = intval($id);

        return $this->categoryService->findById($id);
    }
}