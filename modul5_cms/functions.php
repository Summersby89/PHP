<?php

/**
 * Устанавливает в строке пути файловой системы нормальные разделители директорий
 * @param $str
 * @return mixed
 */
function setNormalSlashes($str)
{
    return str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, $str);
}

/**
 * Добавляет в сессию данные дебага, для последующего удобного вывода
 * @param mixed $var переменная
 * @param bool $explode Разбивать ли эллементы массива на отдельные части?
 */
function debug($var, $explode = false)
{
    if (DEBUG) {
        $tmp = debug_backtrace()[0];
        $backTrace = $tmp['file'] . ':' . $tmp['line'];
        ob_start();
        echo '<hr>';
        echo $backTrace;
        echo '<hr>';
        echo '<pre>';

        if (is_array($var) && $explode) {
            foreach ($var as $key => $value) {
                var_dump([$key => $value]);
                echo '<hr>';
            }
        } else {
            var_dump($var);
        }

        echo '</pre><hr>';
        $_SESSION['debug'][] = ob_get_clean();
    }
}

/**
 * Возвращает из многомерного массива эллемент по ключу разделенного "."
 * @param array $array
 * @param string $key
 * @param null $default
 * @return mixed|null
 */
function arrayGet(array $array, string $key, $default = null)
{
    if (is_null($key)) {
        return $array;
    }

    if (isset($array[$key])) {
        return $array[$key];
    }

    foreach (explode('.', $key) as $segment) {
        if (!is_array($array) || !array_key_exists($segment, $array)) {
            return $default;
        }

        $array = $array[$segment];
    }

    return $array;
}

/**
 * Выводит отладочную информацию в удобном виде
 */
function printDebug()
{
    if (DEBUG && !empty($_SESSION['debug'])) :?>
        <div class="debug container" style="margin-top: 20px;">
            <?php foreach ($_SESSION['debug'] as $key => $debug) : ?>
                <?= $debug ?>
            <?php endforeach; ?>

        </div>
        <?php
        unset($_SESSION['debug']);
    endif;
}

/**
 * Подключает шаблон из папки VIEW_DIR по его имени, если файл находится в подкатологе то указывается путь до файла через '\'
 * @param $templateName
 * @param $data
 */
function includeView($templateName, $data = [])
{
    $file = VIEW_DIR . DIRECTORY_SEPARATOR . setNormalSlashes($templateName) . '.php';
    if (file_exists($file)) {
        extract($data);
        require $file;
    } else {
        debug('Файл шаблона ' . $file . ' не существует');
    }
}


/**
 * Выводит массив с ошибками и очищает массив
 */
function printErrors()
{
    if (!empty($_SESSION['errors'])) {
        echo '<div class="errors card-panel red accent-1 black-text"><ul>';
        foreach ($_SESSION['errors'] as $error) {
            echo '<li>' . $error . '</li>';
        }
        echo '</ul></div>';
        unset($_SESSION['errors']);
    }
}

/**
 * Выводит массив с успешными действиями и очищает его
 */
function printSuccess()
{
    if (!empty($_SESSION['success'])) {
        echo '<div class="success card-panel green accent-2 black-text"><ul>';
        foreach ($_SESSION['success'] as $item) {
            echo '<li>' . $item . '</li>';
        }
        echo '</ul></div>';
        unset($_SESSION['success']);
    }
}