<?php

namespace EneraTechTest\Adapters\API\GetBooks;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

use EneraTechTest\Adapters\API\APIController;
use EneraTechTest\Adapters\API\APIPresenter;
use EneraTechTest\Core\Entities\Book;

use EneraTechTest\Infrastructure\DataAccess\DBContext;

class Controller extends APIController
{
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        DBContext $dbContext,
        $bookID = null,
    ) {
        $presenter = null;

        if (!is_null($bookID)) {
            $presenter = new APIPresenter(200, ["book" => $dbContext->findByID(Book::class, $bookID)]);
        } else {
            $presenter = new APIPresenter(200, $dbContext->listAll(Book::class));
        }

        return $this->render($response, $presenter);
    }
}
