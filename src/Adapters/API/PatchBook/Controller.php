<?php

namespace EneraTechTest\Adapters\API\PatchBook;

use EneraTechTest\Adapters\API\APIController;
use EneraTechTest\Adapters\API\APIPresenter;
use EneraTechTest\Core\Entities\Book;
use EneraTechTest\Infrastructure\DataAccess\DBContext;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Controller extends APIController
{
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        DBContext $dBContext,
        $bookID,
    ) {
        $book = $dBContext->findByID(Book::class, $bookID);

        $book->updateTitle("TEST");

        $dBContext->flush();

        $presenter = new APIPresenter(200, ["book" => $book]);

        return $this->render($response, $presenter);
    }
}
