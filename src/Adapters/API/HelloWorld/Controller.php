<?php

namespace EneraTechTest\Adapters\API\HelloWorld;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

use EneraTechTest\Adapters\API\APIController;
use EneraTechTest\Adapters\API\APIPresenter;

class Controller extends APIController
{
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
    ) {
        $presenter = new APIPresenter(200, [
            "message" => "Hello World!"
        ]);

        return $this->render($response, $presenter);
    }
}
