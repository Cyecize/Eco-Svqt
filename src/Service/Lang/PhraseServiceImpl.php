<?php

namespace App\Service\Lang;

use App\Entity\Language;
use App\Entity\Phrase;
use App\Util\Page;
use App\Util\Pageable;
use Doctrine\ORM\EntityManagerInterface;

class PhraseServiceImpl implements PhraseService
{
    private $entityManager;

    private $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->entityManager->getRepository(Phrase::class);
    }

    public function create(string $text, Language $language): Phrase
    {
        $phrase = new Phrase();

        $phrase->setPhrase($text);
        $phrase->setLanguage($language);

        $this->entityManager->persist($phrase);
        $this->entityManager->flush();

        return $phrase;
    }

    public function findById(int $id): ?Phrase
    {
        return $this->repository->find($id);
    }

    public function search(string $text, Language $language): array
    {
        return $this->repository->search($text, $language);
    }

    public function findAll(Language $language, Pageable $pageable): Page
    {
        return $this->repository->findByLanguage($language, $pageable);
    }
}