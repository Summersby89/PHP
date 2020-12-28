<?php

include $_SERVER['DOCUMENT_ROOT'] . '/include/functions.php';
include $_SERVER['DOCUMENT_ROOT'] . '/include/config.php';

if (isset($_FILES['images'])) {
    // проверим количество файлов
    $filecount = $_FILES['images']['name'];
    if (count($filecount) > $maxUploadFiles) {
        die('Нельзя загружать больше 5 файлов');
    }
    if (count($filecount) === 0) {
        die('Ни одного файла не выбрано');
    }
    // Изменим структуру $_FILES
    foreach ($_FILES['images'] as $key => $value) {
        foreach ($value as $k => $v) {
            $_FILES['images'][$k][$key] = $v;
        }
        // Удалим старые ключи
        unset($_FILES['images'][$key]);
    }
    // Загружаем все картинки по порядку
    foreach ($_FILES['images'] as $k => $v) {
        // Загружаем по одному файлу
        $fileName = $_FILES['images'][$k]['name'];
        $fileTmpName = $_FILES['images'][$k]['tmp_name'];
        $fileType = $_FILES['images'][$k]['type'];
        $fileSize = $_FILES['images'][$k]['size'];
        $errorCode = $_FILES['images'][$k]['error'];
        // Проверим на ошибки
        if ($errorCode !== UPLOAD_ERR_OK || !is_uploaded_file($fileTmpName)) {
            // Массив с названиями ошибок
            include $_SERVER['DOCUMENT_ROOT'] . '/include/errors.php';
            // Если в массиве нет кода ошибки, скажем, что ошибка неизвестна
            $outputMessage = isset($errorMessages[$errorCode]) ? $errorMessages[$errorCode] : $unknownMessage;
            // Выведем название ошибки
            echo ($outputMessage);
        } else {
            // Создадим ресурс FileInfo
            $fi = finfo_open(FILEINFO_MIME_TYPE);
            // Получим MIME-тип
            $mime = (string) finfo_file($fi, $fileTmpName);
            // Проверим ключевое слово image (image/jpeg, image/png и т. д.),
            // а также прописываем запрет в .htaccess на выполнение скриптов php, js и т.д.
            if (!in_array($mime, $types)) {
                die('Можно загружать только jpg, jpeg или png файлы');
            }
            // Зададим ограничения для картинок
            $limitBytes  = 1024 * 1024 * 5;
            // Проверим нужные параметры
            if (filesize($fileTmpName) > $limitBytes) {
                die('Размер файла не должен превышать 5 Мбайт');
            }
            // Переместим картинку в папку /upload
            if (!move_uploaded_file($fileTmpName, $path . $fileName)) {
                die('При записи файла на диск произошла ошибка');
            } else {
                echo 'Файл ' . $fileName . ' успешно добавлен<br/>';
            }
        }
    }
}
