<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class ShoppingCart
 * @package App\Entity
 *
 * @ORM\Table(name="shopping_carts")
 * @ORM\Entity(repositoryClass="App\Repository\ShoppingCartRepository")
 */
class ShoppingCart
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
     * @ORM\Column(name="products_json", type="string", length=255)
     */
    private $products;

    public function __construct()
    {
        $this->setProducts("{}");
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
    public function getProducts(): string
    {
        return $this->products;
    }

    /**
     * @param string $products
     */
    public function setProducts(string $products): void
    {
        $this->products = $products;
    }

}