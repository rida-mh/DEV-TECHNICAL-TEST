<?php

namespace EneraTechTest\Adapters\API\PostBook;

use EneraTechTest\Adapters\API\APIController;
use EneraTechTest\Core\UseCases\AddNewBook\AddNewBook;
use EneraTechTest\Core\UseCases\AddNewBook\AddNewBookInputPort;
use EneraTechTest\Core\ValueObjects\IsbnChecker;
use EneraTechTest\Core\ValueObjects\Iso8601String;
use EneraTechTest\Infrastructure\Database\LocalFileDBContext;

use Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Controller extends APIController
{
    private LocalFileDBContext $dbContext;

    public function __construct(LocalFileDBContext $dbContext)
    {
        $this->dbContext = $dbContext;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        AddNewBook $useCase,
    ) {
        $presenter = new Presenter();

        try {
            $input = $this->tryGetUseCaseInput($request->getParsedBody()["book"] ?? []);
        } catch (\Throwable $th) {

            return $this->renderBadRequest($response, ["error" => ["message" => $th->getMessage()]]);
        }

        $useCase->execute($input, $presenter);

        return $this->render($response, $presenter);
    }

    private function tryGetUseCaseInput(array $book): AddNewBookInputPort
    {
        if (!$title = $book["title"] ?? null) {
            throw new Exception("`title` is mandatory");
        }

        $releaseDate = new Iso8601String($book["releaseDate"] ?? '');
        $isbn = new IsbnChecker($book["isbn"] ?? '', $this->dbContext);

        return new AddNewBookInputPort([
            "title" => $title,
            "isbn" => $isbn,
            "releaseDate" => $releaseDate,
        ]);
    }
}
