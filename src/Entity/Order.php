<?php

namespace App\Entity;

use App\Constant\OrderStatus;
use App\Util\DateUtils;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Order
 * @package App\Entity
 *
 * @ORM\Table(name="orders")
 * @ORM\Entity(repositoryClass="App\Repository\OrderRepository")
 */
class Order
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

    /**
     * @var double
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * @var string
     * @ORM\Column(name="status", type="string", length=50)
     */
    private $status; //TODO: replace with enum type.

    /**
     * @var \DateTime
     * @ORM\Column(name="date_ordered", type="datetime")
     */
    private $dateOrdered;

    /**
     * @var Currency
     * @ORM\ManyToOne(targetEntity="App\Entity\Currency")
     * @ORM\JoinColumn(name="currency_id", referencedColumnName="id")
     */
    private $currency;

    /**
     * @var Address
     * @ORM\ManyToOne(targetEntity="App\Entity\Address")
     * @ORM\JoinColumn(name="address_id", referencedColumnName="id")
     */
    private $address;

    public function __construct()
    {
        $this->setStatus(OrderStatus::AWAITING);
        $this->setDateOrdered(DateUtils::getCurrentDateTime());
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
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return \DateTime
     */
    public function getDateOrdered(): \DateTime
    {
        return $this->dateOrdered;
    }

    /**
     * @param \DateTime $dateOrdered
     */
    public function setDateOrdered(\DateTime $dateOrdered): void
    {
        $this->dateOrdered = $dateOrdered;
    }

    /**
     * @return Currency
     */
    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    /**
     * @param Currency $currency
     */
    public function setCurrency(Currency $currency): void
    {
        $this->currency = $currency;
    }

    /**
     * @return Address
     */
    public function getAddress(): Address
    {
        return $this->address;
    }

    /**
     * @param Address $address
     */
    public function setAddress(Address $address): void
    {
        $this->address = $address;
    }
}