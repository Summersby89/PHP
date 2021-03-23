<?php

namespace App\Base\Routes;

use App\Base\Routes\AbstractClass\Route;

class GetRoute extends Route
{
    protected function getMethod() : string
    {
        return 'GET';
    }
}