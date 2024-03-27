<?php

namespace EneraTechTest\Infrastructure\DI;

use DI\Container;
use DI\ContainerBuilder;

class DependencyInjection
{
    private Container $container;

    public function __construct()
    {
        $containerBuilder = new ContainerBuilder();
        $this->container = $this->addDefinitions($containerBuilder)->build();
    }

    public function getContainer(): Container
    {
        return $this->container;
    }

    private function addDefinitions(ContainerBuilder $containerBuilder): ContainerBuilder
    {
        $containerBuilder->addDefinitions(__DIR__ . '/DependencyDefinitions.php');

        return $containerBuilder;
    }
}
