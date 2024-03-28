<?php

namespace EneraTechTest\Core\Entities;

use EneraTechTest\Core\ValueObjects\Iso8601String;

class Book extends BaseEntity
{
    private string $releaseDate;

    public function __construct(
        private string $title,
        Iso8601String $releaseDate,
    ) {
        $this->releaseDate = $releaseDate;
    }

    public function getReleaseDate(): Iso8601String
    {
        return new Iso8601String($this->releaseDate);
    }
}
