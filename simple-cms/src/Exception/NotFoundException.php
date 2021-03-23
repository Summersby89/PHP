<?php

namespace App\Exception;


use App\Base\BaseView\View;
use App\Interfaces\Renderable;

class NotFoundException extends HttpException implements Renderable
{
    public function render()
    {
        $message  = $this->getMessage();

        $errorView = new View('errors.404', ['message'=>$message]);
        $errorView->layout = ERROR_LAYOUT;
        return $errorView->render();
    }
}
