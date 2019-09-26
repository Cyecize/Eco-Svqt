<?php

namespace App\Service\File;

use Symfony\Component\HttpFoundation\File\UploadedFile;

interface FileService
{
    /**
     * @param string $dirPath
     * @return bool - true if the dir existed and was removed
     */
    public function removeDir(string $dirPath): bool;

    /**
     * @param string $filePath
     * @return bool - true if the file existed and was removed.
     */
    public function removeFile(string $filePath): bool;

    /**
     * @param UploadedFile $uploadedFile
     * @param string $saveDir
     * @return string - the name of the saved file
     */
    public function saveFile(UploadedFile $uploadedFile, string $saveDir): string;
}