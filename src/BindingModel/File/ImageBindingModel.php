<?php

namespace App\BindingModel\File;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageBindingModel
{
    /**
     * @var UploadedFile|null
     */
    private $uploadedFile;

    /**
     * @var string|null
     */
    private $description;

    /**
     * @var integer|null
     */
    private $order;

    public function __construct()
    {

    }

    /**
     * @return UploadedFile|null
     */
    public function getUploadedFile(): ?UploadedFile
    {
        return $this->uploadedFile;
    }

    /**
     * @param UploadedFile|null $uploadedFile
     */
    public function setUploadedFile(?UploadedFile $uploadedFile): void
    {
        $this->uploadedFile = $uploadedFile;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return int|null
     */
    public function getOrder(): ?int
    {
        return $this->order;
    }

    /**
     * @param int|null $order
     */
    public function setOrder(?int $order): void
    {
        $this->order = $order;
    }
}