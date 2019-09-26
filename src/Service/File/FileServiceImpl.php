<?php

namespace App\Service\File;

use App\Exception\IllegalArgumentException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileServiceImpl implements FileService
{

    public function __construct()
    {

    }

    /**
     * @param string $dirPath
     * @return bool - true if the dir existed and was removed
     * @throws IllegalArgumentException
     */
    public function removeDir(string $dirPath): bool
    {
        if (strpos($dirPath, '../') != false) {
            throw new IllegalArgumentException("Hacker!");
        }

        if (!is_dir($dirPath)) {
            if (file_exists($dirPath) !== false) {
                unlink($dirPath);
                return true;
            }

            return false;
        }

        if ($dirPath[strlen($dirPath) - 1] != '/') {
            $dirPath .= '/';
        }

        $files = glob($dirPath . '*', GLOB_MARK);

        foreach ($files as $file) {
            if (is_dir($file)) {
                $this->removeDir($file);
            } else {
                unlink($file);
            }
        }

        rmdir($dirPath);
        return true;
    }

    /**
     * @param string $filePath
     * @return bool - true if the file existed and was removed.
     */
    public function removeFile(string $filePath): bool
    {
        if (file_exists($filePath)) {
            unlink($filePath);
            return true;
        }

        return false;
    }

    /**
     * @param UploadedFile $uploadedFile
     * @param string $saveDir
     * @return string - the name of the saved file
     */
    public function saveFile(UploadedFile $uploadedFile, string $saveDir): string
    {
        $fileName = md5($uploadedFile->getFilename()) . time() . "." . $uploadedFile->guessExtension();
        $uploadedFile->move($saveDir, $fileName);

        return $fileName;
    }
}