<?php

namespace App\Service\File;

use App\Constant\LogLocations;
use App\Exception\IllegalArgumentException;
use App\Service\Log\LogService;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileServiceImpl implements FileService
{

    /**
     * @var LogService
     */
    private $logService;

    public function __construct(LogService $logService)
    {
        $this->logService = $logService;
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
                $this->removeFile($file);
            }
        }

        rmdir($dirPath);
        $logMsg = sprintf("Removed directory %s", $dirPath);
        $this->logService->log(LogLocations::FILE_SERVICE, $logMsg);

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

            $logMsg = sprintf("Removed file %s.", $filePath);
            $this->logService->log(LogLocations::FILE_SERVICE, $logMsg);

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

        $logMsg = sprintf("Saved file %s to dir %s.", $fileName, $saveDir);
        $this->logService->log(LogLocations::FILE_SERVICE, $logMsg);

        return $fileName;
    }
}