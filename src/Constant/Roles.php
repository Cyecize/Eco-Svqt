<?php

namespace App\Constant;

class Roles
{
    public const USER = "ROLE_USER";

    public const ADMIN = "ROLE_ADMIN";

    public const ALL = [self::USER, self::ADMIN];
}