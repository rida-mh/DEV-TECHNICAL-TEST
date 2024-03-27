<?php

namespace EneraTechTest\Infrastructure\Slim;

use EneraTechTest\Adapters\API\GetBooks\Controller as APIGetBooksController;
use EneraTechTest\Adapters\API\HelloWorld\Controller as APIHelloWorldController;
use EneraTechTest\Adapters\API\PostBook\Controller as APIPostBookController;

class Routes
{
    public static function addAPIRoutes($app): void
    {
        $app->get('/api/hello-world', APIHelloWorldController::class);

        $app->get('/api/books', APIGetBooksController::class);
        $app->post('/api/books', APIPostBookController::class);
    }
}
