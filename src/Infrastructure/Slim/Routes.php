<?php

namespace EneraTechTest\Infrastructure\Slim;

use EneraTechTest\Adapters\API\GetBooks\Controller as APIGetBooksController;
use EneraTechTest\Adapters\API\PostBook\Controller as APIPostBookController;

class Routes
{
    public static function addAPIRoutes($app): void
    {
        $app->get('/api/books', APIGetBooksController::class);
        $app->get('/api/books/{bookID}', APIGetBooksController::class);
        $app->post('/api/books', APIPostBookController::class);
    }
}
