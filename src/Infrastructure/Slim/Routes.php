<?php

namespace EneraTechTest\Infrastructure\Slim;

use EneraTechTest\Adapters\API\GetBooks\Controller as APIGetBooksController;
use EneraTechTest\Adapters\API\PatchBook\Controller as APIPatchController;
use EneraTechTest\Adapters\API\PostBook\Controller as Controller;

class Routes
{
    public static function addAPIRoutes($app): void
    {
        $app->get('/api/books', APIGetBooksController::class);
        $app->post('/api/books', Controller::class);
        $app->get('/api/books/{bookID}', APIGetBooksController::class);
    }
}
