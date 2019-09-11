<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Currency
 * @package App\Entity
 *
 * @ORM\Table(name="currencies")
 * @ORM\Entity(repositoryClass="App\Repository\CurrencyRepository")
 */
class Currency
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
     * @ORM\Column(name="currency_name", type="string", length=50)
     */
    private $currencyName;

    /**
     * @var string
     * @ORM\Column(name="sign", type="string", length=10)
     */
    private $sign;

    /**
     * @var double
     * @ORM\Column(name="multiplier", type="float")
     */
    private $multiplier;

    public function __construct()
    {

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
    public function getCurrencyName(): string
    {
        return $this->currencyName;
    }

    /**
     * @param string $currencyName
     */
    public function setCurrencyName(string $currencyName): void
    {
        $this->currencyName = $currencyName;
    }

    /**
     * @return string
     */
    public function getSign(): string
    {
        return $this->sign;
    }

    /**
     * @param string $sign
     */
    public function setSign(string $sign): void
    {
        $this->sign = $sign;
    }

    /**
     * @return float
     */
    public function getMultiplier(): float
    {
        return $this->multiplier;
    }

    /**
     * @param float $multiplier
     */
    public function setMultiplier(float $multiplier): void
    {
        $this->multiplier = $multiplier;
    }
}