<?php

namespace EneraTechTest\Adapters\API\PostBook;

use EneraTechTest\Adapters\API\APIController;
use EneraTechTest\Adapters\API\APIPresenter;
use EneraTechTest\Core\Entities\Book;
use EneraTechTest\Infrastructure\Database\LocalFileDBContext;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Controller extends APIController
{
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        LocalFileDBContext $dbContext,
    ) {

        $book = new Book("Le problème à trois corps");

        $dbContext->persist($book);
        $dbContext->flush();

        $presenter = new APIPresenter(201, [
            "book" => $book
        ]);

        return $this->render($response, $presenter);
    }
}
