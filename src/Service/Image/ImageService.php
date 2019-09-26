<?php

namespace App\Service\Image;

use App\BindingModel\File\ImageBindingModel;
use App\Entity\Image;

interface ImageService
{
    /**
     * @param Image $image
     */
    public function removeImage(Image $image): void;

    /**
     * @param ImageBindingModel $bindingModel
     * @return Image
     */
    public function saveImage(ImageBindingModel $bindingModel): Image;

    /**
     * @param int $id
     * @return Image|null
     */
    public function findById(int $id): ?Image;

    /**
     * @return Image[]
     */
    public function findAll(): array;
}