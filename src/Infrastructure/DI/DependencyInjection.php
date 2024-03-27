<?php

namespace EneraTechTest\Infrastructure\DI;

use DI\Container;
use DI\ContainerBuilder;

class DependencyInjection
{
    private Container $container;

    public function __construct(array $definitionsPaths = [])
    {
        $containerBuilder = new ContainerBuilder();
        $this->container = $this->addDefinitions($containerBuilder, $definitionsPaths)->build();
    }

    public function getContainer(): Container
    {
        return $this->container;
    }

    private function addDefinitions(ContainerBuilder $containerBuilder, array $definitionsPaths): ContainerBuilder
    {
        foreach ($definitionsPaths as $definitionPath) {
            $containerBuilder->addDefinitions($definitionPath);
        }

        return $containerBuilder;
    }
}
