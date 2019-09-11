<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Country
 * @package App\Entity
 *
 * @ORM\Table(name="countries")
 * @ORM\Entity(repositoryClass="App\Repository\CountryRepository")
 */
class Country
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
     * @ORM\Column(name="country_name", type="string", unique=true, length=50)
     */
    private $countryName;

    /**
     * @var Town[]
     * @ORM\OneToMany(targetEntity="App\Entity\Town", mappedBy="country")
     */
    private $towns;

    public function __construct()
    {
        $this->towns = new ArrayCollection();
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
    public function getCountryName(): string
    {
        return $this->countryName;
    }

    /**
     * @param string $countryName
     */
    public function setCountryName(string $countryName): void
    {
        $this->countryName = $countryName;
    }

    /**
     * @return Town[]
     */
    public function getTowns(): ArrayCollection
    {
        return $this->towns;
    }

    /**
     * @param Town[] $towns
     */
    public function setTowns($towns): void
    {
        $this->towns = $towns;
    }
}