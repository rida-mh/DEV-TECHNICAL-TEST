<?php

namespace EneraTechTest\Core\Entities;

class Book extends BaseEntity
{
    public function __construct(
        private int $id,
        private string $title,
    ) {
    }
}
