<?php


namespace App\Service\Log;


use App\Util\Page;
use App\Util\Pageable;

interface LogService
{
    /**
     * @param string $location
     * @param string $message
     */
    public function log(string $location, string $message): void;

    /**
     * @param Pageable $pageable
     * @return Page
     */
    public function findAll(Pageable $pageable): Page;
}