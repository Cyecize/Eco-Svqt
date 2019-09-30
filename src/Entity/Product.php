<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Product
 * @package App\Entity
 *
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 * @ORM\Table(name="products")
 */
class Product
{
    /**
     * @var int
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="barcode", unique=true, length=50, type="string")
     */
    private $barcode;

    /**
     * @var Phrase[]
     * @ORM\ManyToMany(targetEntity="App\Entity\Phrase")
     * @ORM\JoinTable(name="product_titles_phrases",
     *     joinColumns={@ORM\JoinColumn(name="product_id", referencedColumnName="id", onDelete="CASCADE")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="phrase_id", referencedColumnName="id", onDelete="CASCADE")})
     */
    private $titles;

    /**
     * @var double
     * @ORM\Column(name="price", type="float", nullable=false)
     */
    private $price;

    /**
     * @var double
     * @ORM\Column(name="import_price", type="float", nullable=false)
     */
    private $importPrice;

    /**
     * @var Phrase[]
     * @ORM\ManyToMany(targetEntity="App\Entity\Phrase")
     * @ORM\JoinTable(name="product_descriptions_phrases",
     *     joinColumns={@ORM\JoinColumn(name="product_id", referencedColumnName="id", onDelete="CASCADE")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="phrase_id", referencedColumnName="id", onDelete="CASCADE")})
     */
    private $descriptions;

    /**
     * @var int
     * @ORM\Column( name="quantity", type="integer", nullable=false)
     */
    private $quantity;

    /**
     * @var bool
     * @ORM\Column(name="enabled", type="boolean", nullable=false)
     */
    private $enabled;

    /**
     * @var Category
     * @ORM\ManyToOne(targetEntity="App\Entity\Category")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;

    /**
     * @var Image[]
     * @ORM\ManyToMany(targetEntity="App\Entity\Image")
     * @ORM\JoinTable(name="products_images",
     *      joinColumns={@ORM\JoinColumn(name="product_id", referencedColumnName="id", onDelete="CASCADE")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="image_id", referencedColumnName="id", onDelete="CASCADE")})
     */
    private $images;

    public function __construct()
    {
        $this->setEnabled(true);
        $this->setTitles(new ArrayCollection());
        $this->setDescriptions(new ArrayCollection());
        $this->setImages(new ArrayCollection());
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getBarcode(): string
    {
        return $this->barcode;
    }

    /**
     * @param string $barcode
     */
    public function setBarcode(string $barcode): void
    {
        $this->barcode = $barcode;
    }

    /**
     * @return Phrase[]
     */
    public function getTitles()
    {
        return $this->titles;
    }

    /**
     * @param ArrayCollection $titles
     */
    public function setTitles($titles): void
    {
        $this->titles = $titles;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    /**
     * @return float
     */
    public function getImportPrice(): float
    {
        return $this->importPrice;
    }

    /**
     * @param float $importPrice
     */
    public function setImportPrice(float $importPrice): void
    {
        $this->importPrice = $importPrice;
    }

    /**
     * @return Phrase[]
     */
    public function getDescriptions()
    {
        return $this->descriptions;
    }

    /**
     * @param ArrayCollection $descriptions
     */
    public function setDescriptions($descriptions): void
    {
        $this->descriptions = $descriptions;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * @param bool $enabled
     */
    public function setEnabled(bool $enabled): void
    {
        $this->enabled = $enabled;
    }

    /**
     * @return Category
     */
    public function getCategory(): Category
    {
        return $this->category;
    }

    /**
     * @param Category $category
     */
    public function setCategory(Category $category): void
    {
        $this->category = $category;
    }

    /**
     * @return Image[]
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param ArrayCollection $images
     */
    public function setImages($images): void
    {
        $this->images = $images;
    }

    public function addTitle(Phrase $phrase)
    {
        $this->titles->add($phrase);
    }

    public function addDescription(Phrase $phrase)
    {
        $this->descriptions->add($phrase);
    }

    public function addImage(Image $image)
    {
        $this->images->add($image);
    }
}