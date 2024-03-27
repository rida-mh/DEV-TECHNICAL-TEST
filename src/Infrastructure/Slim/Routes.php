<?php

namespace EneraTechTest\Infrastructure\Slim;

use EneraTechTest\Adapters\API\HelloWorld\Controller as APIHelloWorldController;

class Routes
{
    public static function addAPIRoutes($app): void
    {
        $app->get('/api/hello-world', APIHelloWorldController::class);
    }
}
