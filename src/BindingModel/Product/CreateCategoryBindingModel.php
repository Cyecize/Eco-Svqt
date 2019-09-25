<?php

namespace App\BindingModel\Product;

use App\Entity\Category;
use Symfony\Component\Validator\Constraints as Assert;

class CreateCategoryBindingModel
{
    /**
     * @var Category|null
     */
    private $parentCategory;

    /**
     * @var string
     * @Assert\NotNull(message="fieldCannotBeNull")
     * @Assert\NotBlank(message="fieldCannotBeNull")
     * @Assert\Length(max="255", maxMessage="textTooLong")
     */
    private $bgTitle;

    /**
     * @var string
     * @Assert\NotNull(message="fieldCannotBeNull")
     * @Assert\NotBlank(message="fieldCannotBeNull")
     * @Assert\Length(max="255", maxMessage="textTooLong")
     */
    private $enTitle;

    public function __construct()
    {

    }

    /**
     * @return Category|null
     */
    public function getParentCategory(): ?Category
    {
        return $this->parentCategory;
    }

    /**
     * @param Category|null $parentCategory
     */
    public function setParentCategory(?Category $parentCategory): void
    {
        $this->parentCategory = $parentCategory;
    }

    /**
     * @return string
     */
    public function getBgTitle()
    {
        return $this->bgTitle;
    }

    /**
     * @param string $bgTitle
     */
    public function setBgTitle(string $bgTitle): void
    {
        $this->bgTitle = $bgTitle;
    }

    /**
     * @return string
     */
    public function getEnTitle()
    {
        return $this->enTitle;
    }

    /**
     * @param string $enTitle
     */
    public function setEnTitle(string $enTitle): void
    {
        $this->enTitle = $enTitle;
    }
}