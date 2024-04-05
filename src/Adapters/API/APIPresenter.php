<?php

namespace EneraTechTest\Adapters\API;

class APIPresenter
{
    public function __construct(
        public int $responseCode = 200,
        public array $viewModel = [],
    ) {
    }
}
