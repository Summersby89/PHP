<?php

/**
 * Получить из многомерного массива элемент по ключу в виде строки,
 * где каждый уровень вложенности отделен точкой, если такой элемент найден не будет,
 * то функция вернет значение по умолчанию.
 *
 * @param array $array
 * @param string $key
 * @param null $default
 * @return mixed|null
 * @throws Exception
 */
function arrayGet(array $array, $key, $default = null)
{
    $keyItems = is_array($key) ? $key : explode('.', $key);
    $firstKey = array_shift($keyItems);
    $result = null;

    if (isset($array[$firstKey])) {
        if (count($keyItems) == 0) {
            return $array[$firstKey];
        } else {
            return arrayGet($array[$firstKey], $keyItems);
        }
    }
    return $default;
}

/** Функция для распечатки данных в браузер для удобного просмотра
 * @param mixed $data
 */
function dd($data)
{
    echo '<pre>';
    print_r($data);
    echo '</pre>';
    exit();
}
