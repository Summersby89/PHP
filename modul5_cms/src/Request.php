<?php

namespace App;

class Request
{
    /**
     * Возвращает значение из массива запроса или же сам массив если ключ отсутсвует.
     * Если массив не существует возвращет false
     * @param string $name
     * @param array $args
     * @return mixed
     */
    public static function __callStatic(string $name, array $args): mixed
    {
        $key = '_' . strtoupper($name);
        if (array_key_exists($key, $GLOBALS)) {
            $arr = self::prepareData($GLOBALS[$key]);
            $key = $args[0] ?? '';
            return arrayGet($arr, $key, $arr);
        }
        return false;
    }

    /**
     * Подготавливает данные от иньекции
     * @param mixed $data
     * @return mixed
     */
    private static function prepareData(mixed $data): mixed
    {
        if (is_array($data)) {
            $preparedArray = [];
            foreach ($data as $key => $datum) {
                $preparedArray[$key] = self::prepareData($datum);
            }
            return $preparedArray;
        }
        return trim(htmlspecialchars($data, ENT_QUOTES));
    }
}
