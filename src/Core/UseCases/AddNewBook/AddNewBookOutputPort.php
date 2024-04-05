<?php

namespace EneraTechTest\Core\UseCases\AddNewBook;

use EneraTechTest\Core\Entities\Book;
use Throwable;

interface AddNewBookOutputPort
{
    public function bookAdded(Book $book): void;

    public function error(Throwable $throwable): void;
}
