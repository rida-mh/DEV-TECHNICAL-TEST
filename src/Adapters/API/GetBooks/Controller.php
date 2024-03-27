<?php

namespace EneraTechTest\Adapters\API\GetBooks;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

use EneraTechTest\Adapters\API\APIController;
use EneraTechTest\Adapters\API\APIPresenter;
use EneraTechTest\Core\Entities\Book;
use EneraTechTest\Infrastructure\Database\LocalFileDBContext;

class Controller extends APIController
{
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        LocalFileDBContext $dbContext,
    ) {
        $presenter = new APIPresenter(200, $dbContext->get(Book::class));

        return $this->render($response, $presenter);
    }
}
