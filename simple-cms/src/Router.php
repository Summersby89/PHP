<?php

namespace App;

use App\Base\Routes\GetRoute;
use App\Base\Routes\Interfaces\RouteInterface;
use App\Base\Routes\PostRoute;
use App\Exception\NotFoundException;

class Router
{
    private static $routes = [];

    public static function get($path, $callback)
    {
        self::$routes[] = new GetRoute($path, $callback);
    }

    public static function post($path, $callback)
    {
        self::$routes[] = new PostRoute($path, $callback);
    }

    public function dispatch(Application $app)
    {
        $routeFound = false;
        foreach (self::$routes as $route) {
            /**@var RouteInterface $route */
            if ($route->match()) {
                return $route->run($app);
            }
        }
        throw new NotFoundException('Страница по адресу ' . '\'' . $_SERVER['REQUEST_URI'] . '\'' . ' не найдена',
            404);
    }
}
