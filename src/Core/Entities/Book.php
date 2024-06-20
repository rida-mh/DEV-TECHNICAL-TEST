<?php

namespace EneraTechTest\Core\Entities;

use EneraTechTest\Core\ValueObjects\Iso8601String;
use EneraTechTest\Core\ValueObjects\IsbnChecker;

class Book extends BaseEntity
{
    private string $releaseDate;
    private string $isbn;

    public function __construct(
        private string $title,
        IsbnChecker $isbn,
        Iso8601String $releaseDate,
    ) {
        $this->releaseDate = $releaseDate;
        $this->isbn = $isbn;
    }

    public function getReleaseDate(): Iso8601String
    {
        return new Iso8601String($this->releaseDate);
    }

    public function updateTitle(string $newTitle): void
    {
        $this->title = $newTitle;
    }

    public function getIsbn(): string
    {
        return $this->isbn;
    }
}
