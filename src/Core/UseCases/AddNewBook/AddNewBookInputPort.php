<?php

namespace EneraTechTest\Core\UseCases\AddNewBook;

class AddNewBookInputPort
{
    public function  __construct(
        public array $bookInformations = [],
    ) {
    }
}
