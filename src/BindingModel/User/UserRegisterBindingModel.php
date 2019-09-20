<?php

namespace App\BindingModel\User;

use App\Entity\Currency;
use App\Entity\Language;
use Symfony\Component\Validator\Constraints as Assert;

class UserRegisterBindingModel
{
    /**
     * @Assert\NotNull(message="fieldCannotBeNull")
     * @Assert\Email(message="invalidValue")
     */
    private $email;

    /**
     * @Assert\NotBlank(message="fieldCannotBeNull")
     * @Assert\Length(min="6", max="255", minMessage="invalidPasswordLength")
     */
    private $password;

    /**
     * @Assert\EqualTo(propertyPath="password", message="passwordsDoNotMatch")
     */
    private $confPassword;

    /**
     * @Assert\NotNull(message="fieldCannotBeNull")
     * @var Language|null
     */
    private $language;

    /**
     * @Assert\NotNull(message="fieldCannotBeNull")
     * @var Currency|null
     */
    private $currency;

    public function __construct()
    {

    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getConfPassword()
    {
        return $this->confPassword;
    }

    /**
     * @param mixed $confPassword
     */
    public function setConfPassword($confPassword): void
    {
        $this->confPassword = $confPassword;
    }

    /**
     * @return Language|null
     */
    public function getLanguage(): ?Language
    {
        return $this->language;
    }

    /**
     * @param Language|null $language
     */
    public function setLanguage(?Language $language): void
    {
        $this->language = $language;
    }

    /**
     * @return Currency|null
     */
    public function getCurrency(): ?Currency
    {
        return $this->currency;
    }

    /**
     * @param Currency|null $currency
     */
    public function setCurrency(?Currency $currency): void
    {
        $this->currency = $currency;
    }
}