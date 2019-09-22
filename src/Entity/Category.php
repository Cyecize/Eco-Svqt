<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Category
 * @package App\Entity
 *
 * @ORM\Table(name="categories")
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @var int
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Phrase[]
     * @ORM\ManyToMany(targetEntity="App\Entity\Phrase")
     * @ORM\JoinTable(name="categories_phrases",
     *     joinColumns={@ORM\JoinColumn(name="category_id", referencedColumnName="id", onDelete="CASCADE")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="phrase_id", referencedColumnName="id", onDelete="CASCADE")})
     */
    private $titles;

    /**
     * @var Category|null
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="subCategories")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", nullable=true)
     */
    private $parentCategory;

    /**
     * @var Category[]
     * @ORM\OneToMany(targetEntity="App\Entity\Category", mappedBy="parentCategory")
     */
    private $subCategories;

    public function __construct()
    {
        $this->setTitles(new ArrayCollection());
        $this->setSubCategories(new ArrayCollection());
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
     * @return Category[]
     */
    public function getSubCategories()
    {
        return $this->subCategories;
    }

    /**
     * @param ArrayCollection $subCategories
     */
    public function setSubCategories($subCategories): void
    {
        $this->subCategories = $subCategories;
    }

    public function addTitle(Phrase $phrase) {
        $this->titles->add($phrase);
    }
}