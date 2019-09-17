<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Town
 * @package App\Entity
 *
 * @ORM\Table(name="towns")
 * @ORM\Entity(repositoryClass="App\Repository\TownRepository")
 */
class Town
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
     * @ORM\Column(name="town_name", type="string", length=50)
     */
    private $townName;

    /**
     * @var string
     * @ORM\Column(name="post_code", type="string", length=10, unique=true)
     */
    private $postCode;

    /**
     * @var Country
     * @ORM\ManyToOne(targetEntity="App\Entity\Country", inversedBy="towns")
     * @ORM\JoinColumn(name="country_id", referencedColumnName="id")
     */
    private $country;

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
    public function getTownName(): string
    {
        return $this->townName;
    }

    /**
     * @param string $townName
     */
    public function setTownName(string $townName): void
    {
        $this->townName = $townName;
    }

    /**
     * @return string
     */
    public function getPostCode(): string
    {
        return $this->postCode;
    }

    /**
     * @param string $postCode
     */
    public function setPostCode(string $postCode): void
    {
        $this->postCode = $postCode;
    }

    /**
     * @return Country
     */
    public function getCountry(): Country
    {
        return $this->country;
    }

    /**
     * @param Country $country
     */
    public function setCountry(Country $country): void
    {
        $this->country = $country;
    }

}