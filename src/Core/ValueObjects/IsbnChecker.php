<?php

namespace EneraTechTest\Core\ValueObjects;

use Exception;
use EneraTechTest\Infrastructure\Database\LocalFileDBContext;

class IsbnChecker implements \JsonSerializable, \Stringable
{
    private string $isbn;
    private LocalFileDBContext $dbContext;

    public function __construct(string $isbn, LocalFileDBContext $dbContext)
    {
        $this->dbContext = $dbContext;

        if (!$this->isValidISBN($isbn)) {
            throw new Exception("Invalid ISBN format: '{$isbn}'");
        }
        if ($this->dbContext->isbnExists($isbn)) {
            throw new Exception("ISBN already exists: '{$isbn}'");
        }
        $this->isbn = $isbn;
    }

    private function isValidISBN($isbn)
    {
        $isbn = str_replace(['-', ' '], '', $isbn);
        if (!preg_match('/^\d{13}$/', $isbn)) {
            return false;
        }
        $checksum = 0;
        for ($i = 0; $i < 12; $i++) {
            $checksum += (intval($isbn[$i]) * (($i % 2 === 0) ? 1 : 3));
        }
        $checksum = (10 - ($checksum % 10)) % 10;

        return intval($isbn[12]) === $checksum;
    }

    public function __toString(): string
    {
        return $this->isbn;
    }

    public function jsonSerialize(): mixed
    {
        return $this->__toString();
    }
}
