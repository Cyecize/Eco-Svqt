<?php

namespace App\Entity;

use App\Util\DateUtils;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class User
 * @package App\Entity
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
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
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     */
    private $email;

    /**
     * @var string
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var \DateTime
     * @ORM\Column(name="date_registered", type="datetime")
     */
    private $dateRegistered;

    /**
     * @var ShoppingCart
     * @ORM\OneToOne(targetEntity="App\Entity\ShoppingCart")
     * @ORM\JoinColumn(name="shopping_cart_id", referencedColumnName="id")
     */
    private $shoppingCart;

    /**
     * @var Language
     * @ORM\ManyToOne(targetEntity="App\Entity\Language")
     * @ORM\JoinColumn(name="language_id", referencedColumnName="id")
     */
    private $language;

    /**
     * @var Currency
     * @ORM\ManyToOne(targetEntity="App\Entity\Currency")
     * @ORM\JoinColumn(name="currency_id", referencedColumnName="id")
     */
    private $currency;

    /**
     * @var Address[]
     * @ORM\OneToMany(targetEntity="App\Entity\Address", mappedBy="user")
     */
    private $addresses;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Role")
     * @ORM\JoinTable(name="users_roles", joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="CASCADE")},
     * inverseJoinColumns={@ORM\JoinColumn(name="role_id", referencedColumnName="id", onDelete="CASCADE")})
     * @var ArrayCollection
     */
    private $roles;

    public function __construct()
    {
        $this->setRoles(new ArrayCollection());
        $this->setAddresses(new ArrayCollection());
        $this->setDateRegistered(DateUtils::getCurrentDateTime());
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
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return \DateTime
     */
    public function getDateRegistered(): \DateTime
    {
        return $this->dateRegistered;
    }

    /**
     * @param \DateTime $dateRegistered
     */
    public function setDateRegistered(\DateTime $dateRegistered): void
    {
        $this->dateRegistered = $dateRegistered;
    }

    /**
     * @return Role[]
     */
    public function getRoles()
    {
        //toArray because Symfony needs array and not ArrayCollection.
        return $this->roles->toArray();
    }

    /**
     * @param $roles
     */
    public function setRoles($roles): void
    {
        $this->roles = $roles;
    }

    /**
     * @return Language
     */
    public function getLanguage(): Language
    {
        return $this->language;
    }

    /**
     * @param Language $language
     */
    public function setLanguage(Language $language): void
    {
        $this->language = $language;
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
     * @return Address[]
     */
    public function getAddresses()
    {
        return $this->addresses;
    }

    /**
     * @param $addresses
     */
    public function setAddresses($addresses): void
    {
        $this->addresses = $addresses;
    }

    /**
     * @return ShoppingCart
     */
    public function getShoppingCart(): ShoppingCart
    {
        return $this->shoppingCart;
    }

    /**
     * @param ShoppingCart $shoppingCart
     */
    public function setShoppingCart(ShoppingCart $shoppingCart): void
    {
        $this->shoppingCart = $shoppingCart;
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {

    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        return $this->getEmail();
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {

    }
}