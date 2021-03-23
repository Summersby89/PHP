<?php

namespace App\Base\Routes\Interfaces;

use App\Application;

interface RouteInterface
{
    public function currentURI();

    public function match(): bool;

    public function run(Application $app);

}
