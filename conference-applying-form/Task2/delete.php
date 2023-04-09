<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Если запрос был отправлен методом POST
    $dir = 'applications/'; // Папка с файлами заявок
    $file = $_POST['file']; // Получаем имя файла заявки
    if (file_exists($dir . $file)) { // Если файл существует
        unlink($dir . $file); // Удаляем файл
        header('Location: admin.php'); // Перенаправляем обратно на страницу администратора
        exit();
    } else {
        echo 'Файл не найден'; // Если файл не найден
    }
}

?>
