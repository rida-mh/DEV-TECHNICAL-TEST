<?php

namespace EneraTechTest\Adapters\Web;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class IndexController
{
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
    ) {
        $filePath = dirname(__DIR__, 3) . '/public/books.html';
        $html = file_get_contents($filePath);

        if ($html === false) {
            $response->getBody()->write('File not found');
            return $response->withStatus(404);
        }

        $response->getBody()->write($html);
        return $response;
    }
}
