<?php

namespace App;

use App\Exception\NotFoundException;

class Router
{
    protected $routes = [];

    /**
     * Добавляет в таблицу новый маршрут
     * @param $pattern
     * @param $data
     * @param string $method
     */
    public function addRoute($pattern, $data, $method = 'get')
    {
        $this->routes[] = new Route(mb_strtolower($method), "/" . trim($pattern, '/'), $data);
    }

    /**
     * Добавляет в таблицу новый маршрут с типом запроса GET
     * @param $pattern
     * @param $data
     */
    public function get($pattern, $data)
    {
        $this->addRoute($pattern, $data);
    }

    /**
     * Добавляет в таблицу маршрут с типом запрос POST
     * @param $pattern
     * @param $data
     */
    public function post($pattern, $data)
    {
        $this->addRoute($pattern, $data, 'post');
    }

    /**
     * Выполняет программу с заданным маршрутом
     */
    public function dispatch()
    {
        $result = $this->getRoute()->run(self::getPath());
        if (is_callable($result)) {
            $result();
        }
        return $result;
    }

    /**
     * Возвращает первый найденный маршрут совпадающий с паттерном
     * @return mixed
     * @throws NotFoundException
     */
    public function getRoute()
    {
        foreach ($this->routes as $route) {
            if ($route->match(mb_strtolower($_SERVER['REQUEST_METHOD']), self::getPath())) {
                return $route;
            }
        }
        throw new NotFoundException('Страница не найдена');
    }

    /**
     * Возвращает полный урл страницы
     * @return string
     */
    public static function getUri()
    {
        $url = 'http' . ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') ? 's' : '') . '://';
        $url = $url . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
        return $url;
    }

    /**
     * Возвращает путь до страницы в адресной строке
     * @return string
     */
    public static function getPath()
    {
        return '/' . trim(parse_url(self::getUri(), PHP_URL_PATH), '/');
    }

    /**
     * Проверяет совпадет ли путь
     * @param string $path
     * @return bool
     */
    public static function checkPath(string $path)
    {
        return self::getPath() === $path;
    }

    public static function buildQueryString(array $newParams)
    {
        $getArr = Request::get();

        $getArr = array_merge($getArr, $newParams);
        $query = http_build_query($getArr);
        return self::getPath().'?'.$query;
    }
}
