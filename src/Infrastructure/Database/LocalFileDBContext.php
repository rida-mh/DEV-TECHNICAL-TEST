<?php

namespace EneraTechTest\Infrastructure\Database;

use ReflectionClass;

use EneraTechTest\Core\Entities\BaseEntity;
use EneraTechTest\Infrastructure\DataAccess\DBContext;

class LocalFileDBContext implements DBContext
{
    private string $storagePath = __DIR__ . '/Data';
    private array $data = [];

    public function __construct()
    {
        $this->loadData();
    }

    private function loadData(): void
    {
        $this->data = [];

        foreach (glob($this->storagePath . '/*.json') as $file) {

            $fileName = basename($file, '.json');
            $fullClassName = str_replace('_', '\\', $fileName);

            $jsonData = file_get_contents($file);
            $entitiesArray = json_decode($jsonData, true);

            $entities = [];
            foreach ($entitiesArray as $entityData) {
                $entities[] = $this->jsonDeserialize($entityData, $fullClassName);
            }

            $this->data[$fullClassName] = $entities;
        }
    }

    public function flush(): void
    {
        foreach ($this->data as $fullClassName => $entities) {

            $fileName = str_replace('\\', '_', $fullClassName) . '.json';
            $filePath = $this->storagePath . '/' . $fileName;

            $jsonData = json_encode($entities);
            file_put_contents($filePath, $jsonData);
        }
    }

    private function jsonDeserialize(array $data, string $className): object
    {
        $reflector = new ReflectionClass($className);

        $object = $reflector->newInstanceWithoutConstructor();

        foreach ($data as $key => $value) {
            if ($reflector->hasProperty($key)) {
                $property = $reflector->getProperty($key);
                $property->setAccessible(true);
                $property->setValue($object, $value);
            }
        }

        return $object;
    }

    public function persist(BaseEntity $entity): void
    {
        $fullClassName = get_class($entity);

        if (!isset($this->data[$fullClassName])) {
            $this->data[$fullClassName] = [];
        }

        $reflectionClass = new ReflectionClass($entity);

        if ($reflectionClass->hasProperty('id')) {
            $idProperty = $reflectionClass->getProperty('id');
            $idProperty->setAccessible(true);

            if (!$idProperty->getValue($entity)) {
                $idProperty->setValue($entity, uniqid());
            }
        }

        $this->data[$fullClassName][] = $entity;
    }

    public function listAll(string $entityClassName): array
    {

        if (!isset($this->data[$entityClassName])) {
            return [];
        }

        return $this->data[$entityClassName];
    }
}
