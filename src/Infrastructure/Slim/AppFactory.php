<?php

namespace EneraTechTest\Infrastructure\Slim;

use Slim\App;
use Slim\Middleware\ContentLengthMiddleware;
use Slim\Middleware\OutputBufferingMiddleware;
use Slim\Psr7\Factory\StreamFactory;

use DI\Bridge\Slim\Bridge;

use EneraTechTest\Infrastructure\Middlewares\JsonBodyParserMiddleware;
use EneraTechTest\Infrastructure\DI\DependencyInjection;

class AppFactory
{
    private static function setMiddlewares($app): void
    {
        $app->add(
            new OutputBufferingMiddleware(
                new StreamFactory(),
                OutputBufferingMiddleware::APPEND
            )
        );

        $app->add(function ($request, $handler) {
            $response = $handler->handle($request);

            return $response
                ->withHeader('Access-Control-Allow-Origin', '*')
                ->withHeader('Access-Control-Allow-Credentials', 'true')
                ->withHeader('Access-Control-Allow-Headers', '*')
                ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
        });

        $app->addRoutingMiddleware();
        $app->add(new JsonBodyParserMiddleware());
        $app->add(new ContentLengthMiddleware());
    }

    public static function app(): App
    {
        $di = new DependencyInjection();

        $app = Bridge::create($di->getContainer());

        self::setMiddlewares($app);

        Routes::addAPIRoutes($app);

        return $app;
    }
}
