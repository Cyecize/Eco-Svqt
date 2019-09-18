<?php

namespace App\Exception;

class InternalRestException extends \Exception implements RestException
{
    public function __construct(string $message = "", int $code = 500)
    {
        parent::__construct($message, $code, null);
    }
}