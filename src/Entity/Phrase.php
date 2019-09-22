<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Phrase
 * @package App\Entity
 *
 * @ORM\Table(name="phrases")
 * @ORM\Entity(repositoryClass="App\Repository\PhraseRepository")
 */
class Phrase
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
     * @ORM\Column(name="phrase", type="string", length=255)
     */
    private $phrase;

    /**
     * @var Language
     * @ORM\ManyToOne(targetEntity="App\Entity\Language")
     * @ORM\JoinColumn(name="language_id", referencedColumnName="id")
     */
    private $language;

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
    public function getPhrase(): string
    {
        return $this->phrase;
    }

    /**
     * @param string $phrase
     */
    public function setPhrase(string $phrase): void
    {
        $this->phrase = $phrase;
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
}