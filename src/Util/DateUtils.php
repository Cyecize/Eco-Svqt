<?php

namespace App\Util;


class DateUtils
{
    public static function getCurrentDateTime() : \DateTime {
        return new \DateTime('now', new \DateTimeZone('Europe/Sofia'));
    }
}