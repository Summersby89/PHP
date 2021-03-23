<?php

namespace App\Base\Routes;

use App\Base\Routes\AbstractClass\Route;

class PostRoute extends Route
{
    protected function getMethod() : string
    {
        return 'POST';
    }
}
