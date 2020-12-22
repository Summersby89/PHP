<?php

include $_SERVER['DOCUMENT_ROOT'] . '/include/functions.php';
$path = $_SERVER['DOCUMENT_ROOT'] . '/upload/';

if (isset($_FILES['images'])) {
    // проверим количество файлов
    $filecount = $_FILES['images']['name'];
    if (count($filecount) > 5) {
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
            $errorMessages = [
                UPLOAD_ERR_INI_SIZE   => 'Размер файла превысил значение upload_max_filesize в конфигурации PHP',
                UPLOAD_ERR_FORM_SIZE  => 'Размер загружаемого файла превысил значение MAX_FILE_SIZE в HTML-форме',
                UPLOAD_ERR_PARTIAL    => 'Загружаемый файл был получен только частично',
                UPLOAD_ERR_NO_FILE    => 'Нужно выбрать хотя бы один файл',
                UPLOAD_ERR_NO_TMP_DIR => 'Отсутствует временная папка',
                UPLOAD_ERR_CANT_WRITE => 'Не удалось записать файл на диск',
                UPLOAD_ERR_EXTENSION  => 'PHP-расширение остановило загрузку файла',
            ];
            // Зададим неизвестную ошибку
            $unknownMessage = 'При загрузке файла произошла неизвестная ошибка.';
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
            if (!in_array($mime, ["image/jpeg", "image/png", "image/jpeg"])) {
                die('Можно загружать только jpg, jpeg или png изображения');
            }
            // Зададим ограничения для картинок
            $limitBytes  = 1024 * 1024 * 5;
            // Проверим нужные параметры
            if (filesize($fileTmpName) > $limitBytes) {
                die('Размер изображения не должен превышать 5 Мбайт');
            }
            // Сгенерируем новое имя файла 
            $name = getRandomFileName($fileTmpName);
            // Переместим картинку с новым именем в папку /upload
            if (!move_uploaded_file($fileTmpName, $path . $name . ".jpg")) {
                die('При записи изображения на диск произошла ошибка');
            } else {
                echo 'Файлы успешно загружены!';
            }
        }
    };
};
