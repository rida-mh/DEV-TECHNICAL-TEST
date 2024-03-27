<?php

namespace EneraTechTest\Core\Entities;

use JsonSerializable;
use ReflectionObject;
use ReflectionProperty;

abstract class BaseEntity implements JsonSerializable
{
    protected ?string $id = null;

    public function getID(): string
    {
        return $this->id;
    }

    public function jsonSerialize(): mixed
    {
        $reflection = new ReflectionObject($this);
        $properties = $reflection->getProperties(
            ReflectionProperty::IS_PUBLIC | ReflectionProperty::IS_PROTECTED | ReflectionProperty::IS_PRIVATE
        );

        $data = [];
        foreach ($properties as $property) {
            $property->setAccessible(true);
            $data[$property->getName()] = $property->getValue($this);
        }

        return $data;
    }
}
