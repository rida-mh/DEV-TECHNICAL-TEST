<?php

namespace EneraTechTest\Infrastructure\DataAccess;

use EneraTechTest\Core\Entities\BaseEntity;

interface DBContext
{
    public function flush(): void;

    public function persist(BaseEntity $entity): void;

    public function listAll(string $entityName): array;

    public function findByID(string $entityName, string $id): ?BaseEntity;
}
