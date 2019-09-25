<?php

namespace App\BindingModel\Product;

use App\Entity\Category;
use Symfony\Component\Validator\Constraints as Assert;

class CreateProductBindingModel
{
    /**
     * @var string|null
     * @Assert\NotNull(message="fieldCannotBeNull")
     * @Assert\Length(min="1", max="50", maxMessage="textTooLong", minMessage="textTooShort")
     */
    private $barcode;

    /**
     * @var string|null
     * @Assert\NotNull(message="fieldCannotBeNull")
     * @Assert\NotBlank(message="fieldCannotBeNull")
     * @Assert\Length(max="255", maxMessage="textTooLong")
     */
    private $bgTitle;

    /**
     * @var string|null
     * @Assert\NotNull(message="fieldCannotBeNull")
     * @Assert\NotBlank(message="fieldCannotBeNull")
     * @Assert\Length(max="255", maxMessage="textTooLong")
     */
    private $enTitle;

    /**
     * @var double|null
     * @Assert\NotNull(message="fieldCannotBeNull")
     */
    private $price;

    /**
     * @var double|null
     * @Assert\NotNull(message="fieldCannotBeNull")
     */
    private $importPrice;

    /**
     * @var string|null
     * @Assert\NotNull(message="fieldCannotBeNull")
     * @Assert\NotBlank(message="fieldCannotBeNull")
     * @Assert\Length(max="255", maxMessage="textTooLong")
     */
    private $bgDescription;

    /**
     * @var string|null
     * @Assert\NotNull(message="fieldCannotBeNull")
     * @Assert\NotBlank(message="fieldCannotBeNull")
     * @Assert\Length(max="255", maxMessage="textTooLong")
     */
    private $enDescription;

    /**
     * @var int|null
     * @Assert\NotNull(message="fieldCannotBeNull")
     */
    private $quantity;

    /**
     * @var bool|null
     * @Assert\NotNull(message="fieldCannotBeNull")
     */
    private $enabled;

    /**
     * @var Category|null
     * @Assert\NotNull(message="fieldCannotBeNull")
     */
    private $category;

    public function __construct()
    {
        $this->setEnabled(true);
    }

    /**
     * @return string|null
     */
    public function getBarcode(): ?string
    {
        return $this->barcode;
    }

    /**
     * @param string|null $barcode
     */
    public function setBarcode(?string $barcode): void
    {
        $this->barcode = $barcode;
    }

    /**
     * @return string|null
     */
    public function getBgTitle(): ?string
    {
        return $this->bgTitle;
    }

    /**
     * @param string|null $bgTitle
     */
    public function setBgTitle(?string $bgTitle): void
    {
        $this->bgTitle = $bgTitle;
    }

    /**
     * @return string|null
     */
    public function getEnTitle(): ?string
    {
        return $this->enTitle;
    }

    /**
     * @param string|null $enTitle
     */
    public function setEnTitle(?string $enTitle): void
    {
        $this->enTitle = $enTitle;
    }

    /**
     * @return float|null
     */
    public function getPrice(): ?float
    {
        return $this->price;
    }

    /**
     * @param float|null $price
     */
    public function setPrice(?float $price): void
    {
        $this->price = $price;
    }

    /**
     * @return float|null
     */
    public function getImportPrice(): ?float
    {
        return $this->importPrice;
    }

    /**
     * @param float|null $importPrice
     */
    public function setImportPrice(?float $importPrice): void
    {
        $this->importPrice = $importPrice;
    }

    /**
     * @return string|null
     */
    public function getBgDescription(): ?string
    {
        return $this->bgDescription;
    }

    /**
     * @param string|null $bgDescription
     */
    public function setBgDescription(?string $bgDescription): void
    {
        $this->bgDescription = $bgDescription;
    }

    /**
     * @return string|null
     */
    public function getEnDescription(): ?string
    {
        return $this->enDescription;
    }

    /**
     * @param string|null $enDescription
     */
    public function setEnDescription(?string $enDescription): void
    {
        $this->enDescription = $enDescription;
    }

    /**
     * @return int|null
     */
    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    /**
     * @param int|null $quantity
     */
    public function setQuantity(?int $quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * @return bool
     */
    public function isEnabled(): ?bool
    {
        return $this->enabled;
    }

    /**
     * @param bool $enabled
     */
    public function setEnabled(?bool $enabled): void
    {
        $this->enabled = $enabled;
    }

    /**
     * @return Category|null
     */
    public function getCategory(): ?Category
    {
        return $this->category;
    }

    /**
     * @param Category|null $category
     */
    public function setCategory(?Category $category): void
    {
        $this->category = $category;
    }
}