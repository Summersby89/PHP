<?php
//Конструкция для массового удаления файлов
$dir = $_SERVER['DOCUMENT_ROOT'] . '/upload/';
$files = scandir($dir);

if (isset($_POST['checked'])) {
    foreach ($_POST['checked'] as $check) {
        if (in_array(basename($check), $files)) {
            unlink($check);
        }
        echo 'Файл ' . (basename($check)) . ' успешно удалён<br/>';
    }
} else {
    echo "Ни одного файла не выбрано";
}
