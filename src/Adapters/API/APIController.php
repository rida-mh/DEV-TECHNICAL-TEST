<?php

namespace EneraTechTest\Adapters\API;

use Psr\Http\Message\ResponseInterface;

abstract class APIController
{
    protected function render(
        ResponseInterface $response,
        APIPresenter $presenter,
    ): ResponseInterface {

        $response = $response->withStatus($presenter->responseCode);

        if ($presenter->viewModel) {
            $response->getBody()->write(json_encode($presenter->viewModel));
        }

        return $response->withHeader('Content-Type', 'application/json');
    }
}
