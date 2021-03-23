<?php

use App\Base\BaseView\View;
use App\Controllers\MainController;
use App\Router;

Router::get('/', MainController::class . "@index");
Router::get('/about', MainController::class . '@about');

Router::get('/company', function () {
    return new View('company.index', ['title' => 'company page']);
});

Router::get('/test/{name}', MainController::class . '@test1');
Router::get('/test/{user}/{age}', MainController::class . '@test2');
Router::get('/test', MainController::class . '@test3');
