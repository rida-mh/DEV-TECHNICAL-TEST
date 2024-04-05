<?php

namespace EneraTechTest\Adapters\API\PostBook;

use EneraTechTest\Adapters\API\APIPresenter;
use EneraTechTest\Core\Entities\Book;
use EneraTechTest\Core\UseCases\AddNewBook\AddNewBookOutputPort;
use Throwable;

class Presenter extends APIPresenter implements AddNewBookOutputPort
{
    public function bookAdded(Book $book): void
    {
        $this->responseCode = 201;
        $this->viewModel = ["book" => $book];
    }

    public function error(Throwable $throwable): void
    {
        $this->responseCode = 500;
        $this->viewModel = ["error" => [
            "message" => $throwable->getMessage()
        ]];
    }
}
