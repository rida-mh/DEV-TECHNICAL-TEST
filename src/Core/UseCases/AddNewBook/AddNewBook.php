<?php

namespace EneraTechTest\Core\UseCases\AddNewBook;

use EneraTechTest\Core\Entities\Book;
use EneraTechTest\Infrastructure\DataAccess\DBContext;

class AddNewBook
{
    public function __construct(
        private DBContext $dBContext,
    ) {
    }

    public function execute(AddNewBookInputPort $input, AddNewBookOutputPort $output): void
    {
        $book = new Book(
            $input->bookInformations["title"],
            $input->bookInformations["releaseDate"]
        );

        try {

            $this->dBContext->persist($book);
            $this->dBContext->flush();
        } catch (\Throwable $th) {

            $output->error($th);
            return;
        }

        $output->bookAdded($book);
    }
}
