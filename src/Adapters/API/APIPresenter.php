<?php

namespace EneraTechTest\Adapters\API;

class APIPresenter
{
    public function __construct(
        public int $responseCode,
        public array $viewModel = [],
    ) {
    }
}
