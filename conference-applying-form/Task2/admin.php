<style>
table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  text-align: left;
  padding: 8px;
  border-bottom: 1px solid #ddd;
}

th {
  background-color: #4CAF50;
  color: white;
}
</style>
<?php
$dir = 'applications/'; // Папка с файлами заявок
$files = array_diff(scandir($dir), array('..', '.')); // Получение списка файлов

if (count($files) > 0) { // Если есть файлы заявок
    echo '<table>'; // Начало таблицы
    echo '<tr><th>Имя</th><th>Фамилия</th><th>Email</th><th>Телефон</th><th>Тема</th><th>Метод оплаты</th><th>Отправлять информацию</th><th></th></tr>'; // Заголовок таблицы
    foreach ($files as $file) { // Перебор файлов
        $data = file($dir . $file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES); // Чтение данных из файла
        echo '<tr>'; // Начало строки таблицы
        foreach ($data as $line) { // Перебор данных
            $value = explode(': ', $line); // Разбиваем строку на имя и значение
            echo '<td>' . $value[1] . '</td>'; // Отображаем значение
        }
        echo '<td><form method="post" action="delete.php"><input type="hidden" name="file" value="' . $file . '"><input type="submit" value="Удалить заявку"></form></td>'; // Добавляем кнопку удаления
        echo '</tr>'; // Конец строки таблицы
    }
    echo '</table>'; // Конец таблицы
} else {
    echo 'Нет заявок'; // Если нет файлов заявок
}

?>
