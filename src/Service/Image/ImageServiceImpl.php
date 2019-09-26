<?php

namespace App\Service\Image;

use App\BindingModel\File\ImageBindingModel;
use App\Entity\Image;
use App\Repository\ImageRepository;
use App\Service\File\FileService;
use App\Util\ModelMapper;
use Doctrine\Common\Persistence\ObjectRepository as ObjectRepositoryAlias;
use Doctrine\ORM\EntityManagerInterface;

class ImageServiceImpl implements ImageService
{
    private const IMAGE_STORAGE_DIR = "storage" . DIRECTORY_SEPARATOR . "images" . DIRECTORY_SEPARATOR;

    /**
     * @var EntityManagerInterface
     */
    private $entityManger;

    /**
     * @var ImageRepository|ObjectRepositoryAlias
     */
    private $repository;

    /**
     * @var FileService
     */
    private $fileService;

    /**
     * @var ModelMapper
     */
    private $modelMapper;

    public function __construct(EntityManagerInterface $entityManager, FileService $fileService, ModelMapper $modelMapper)
    {
        $this->entityManger = $entityManager;
        $this->repository = $this->entityManger->getRepository(Image::class);
        $this->fileService = $fileService;
        $this->modelMapper = $modelMapper;
    }

    public function removeImage(Image $image): void
    {
        if ($this->fileService->removeFile(self::IMAGE_STORAGE_DIR . $image->getImageName())) {
            $this->entityManger->remove($image);
            $this->entityManger->flush();
        }
    }

    public function saveImage(ImageBindingModel $bindingModel): Image
    {
        $image = $this->modelMapper->map($bindingModel, Image::class);
        $image->setImageName($this->fileService->saveFile($bindingModel->getUploadedFile(), self::IMAGE_STORAGE_DIR));

        $this->entityManger->persist($image);
        $this->entityManger->flush();

        return $image;
    }

    public function findById(int $id): ?Image
    {
        return $this->repository->find($id);
    }

    public function findAll(): array
    {
        return $this->repository->findAll();
    }
}