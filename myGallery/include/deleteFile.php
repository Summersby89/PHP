<?php

$dir = $_SERVER['DOCUMENT_ROOT'] . '/upload';
$files = scandir($dir);

if (isset($_POST['checked'])) { //Конструкция для массового удаления файлов
    foreach($_POST['checked'] as $check) {
        if (in_array(basename($check), $files )) {
            unlink($check);  
        }
    }
    echo "Файлы успешно удалены";
} else {
    echo "Файлы не выбраны";
}