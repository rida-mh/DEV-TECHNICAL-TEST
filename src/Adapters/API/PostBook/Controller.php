<?php

namespace EneraTechTest\Adapters\API\PostBook;

use DateTime;

use EneraTechTest\Adapters\API\APIController;
use EneraTechTest\Adapters\API\APIPresenter;

use EneraTechTest\Core\Entities\Book;
use EneraTechTest\Core\ValueObjects\Iso8601String;

use EneraTechTest\Infrastructure\DataAccess\DBContext;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Controller extends APIController
{
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        DBContext $dbContext,
    ) {

        $book = new Book("Le problème à trois corps", new Iso8601String(new DateTime()));

        $dbContext->persist($book);
        $dbContext->flush();

        $presenter = new APIPresenter(201, [
            "book" => $book
        ]);

        return $this->render($response, $presenter);
    }
}
