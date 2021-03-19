<?php

namespace App;

use App\Exception\HttpException;

class Route
{
    private $method;
    private $path;
    private $callback;

    public function __construct($method, $path, $callback)
    {
        $this->method = $method;
        $this->path = $path;
        $this->callback = $callback;
    }

    /**
     * Подготавливает и выполняет метод если он сущевствует
     * @param $callback
     * @return array
     * @throws HttpException
     */
    private function prepareCallback($callback)
    {
        if (is_callable($callback)) {
            return $callback;
        } else {
            $classAndMethod = explode("@", $callback);
            $controller = $classAndMethod[0] . "Controller";
            $method = $classAndMethod[1] . "Action";
            if (!class_exists($controller)) {
                throw new HttpException("Не найден контроллер маршрута! " . $controller, 500);
            }
            if (method_exists($controller, $method)) {
                return [new $controller(), $method];
            } else {
                throw new HttpException("Обработчик маршрута не найден! " . $classAndMethod[1], 500);
            }
        }
    }

    public function getPath()
    {
        return $this->path;
    }

    /**
     * Прверяет подходит ли данный роут к пути
     * @param $method
     * @param $uri
     * @return bool
     */
    public function match($method, $uri): bool
    {
        return $this->method === $method && preg_match('/^' . str_replace(['*', '/'], ['\w+', '\/'], $this->getPath()) . '$/', $uri);
    }

    /**
     * Выполняет программу заданную эти роутом
     * @param $uri
     * @return mixed
     * @throws HttpException
     */
    public function run($uri): mixed
    {
        if (preg_match('/^' . str_replace(['*', '/'], ['\w+', '\/'], $this->getPath()) . '$/', $uri, $matches)) {
            $arr = explode('/', $uri);
            $arr2 = explode('/', $this->path);
            $params = [];

            foreach ($arr2 as $k => $v) {
                if ($arr[$k] !== $v) {
                    $params[] = $arr[$k];
                }
            }

            debug($this);

            return call_user_func_array($this->prepareCallback($this->callback), $params);
        }
    }
}
