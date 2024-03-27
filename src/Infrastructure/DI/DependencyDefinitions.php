<?php

use EneraTechTest\Infrastructure\DataAccess\DBContext;
use EneraTechTest\Infrastructure\Database\LocalFileDBContext;

return [

    DBContext::class => DI\get(LocalFileDBContext::class),

];
