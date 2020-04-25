<?php


namespace Coolkop\Rest\Service;


use ReflectionClass;
use ReflectionException;
use ReflectionProperty;

trait SerializableResponseTrait
{
    /**
     * @return void
     * @throws ReflectionException
     */
    public function jsonSerialize()
    {
        $reflect = new ReflectionClass($this);

        return array_reduce(
            $reflect->getProperties(),
            function (array $map, ReflectionProperty $property): array {
                $property->setAccessible(true);
                $map[$property->getName()] = $property->getValue($this);

                return $map;
            },
            []
        );
    }
}
