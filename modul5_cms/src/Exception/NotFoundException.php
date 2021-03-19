<?php

namespace App\Exception;

use App\Interfaces\Renderable;
use App\View\View;
use Throwable;

class NotFoundException extends HttpException implements Renderable
{
    public function __construct($message = "")
    {
        parent::__construct($message, 404, null);
    }

    public function render()
    {
        $view = new View('exception', ['exception' => $this]);
        $view->render();
    }
}
