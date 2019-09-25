<?php

namespace App\Util;

use ReflectionException;

class TwigUtils
{

    /**
     * @param object $object
     * @param string $propertyName
     * @return object|null
     * @throws ReflectionException
     */
    public function getProperty(object $object, string $propertyName)
    {
        $reflection = new \ReflectionObject($object);

        $prop = $reflection->getProperty($propertyName);
        $prop->setAccessible(true);

        return $prop->getValue($object);
    }
}