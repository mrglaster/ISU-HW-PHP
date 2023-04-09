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
    echo '<form method="post" action="delete.php"><table>'; // Начало формы и таблицы
    echo '<tr><th>Имя</th><th>Фамилия</th><th>Email</th><th>Телефон</th><th>Тема</th><th>Метод оплаты</th><th>Отправлять информацию</th><th><input type="checkbox" id="select-all"></th></tr>'; // Заголовок таблицы и колонка для чекбоксов
    foreach ($files as $file) { // Перебор файлов
        $data = file($dir . $file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES); // Чтение данных из файла
        echo '<tr>'; // Начало строки таблицы
        foreach ($data as $line) { // Перебор данных
            $value = explode(': ', $line); // Разбиваем строку на имя и значение
            echo '<td>' . $value[1] . '</td>'; // Отображаем значение
        }
        echo '<td><input type="checkbox" name="delete[]" value="' . $file . '"></td>'; // Добавляем чекбокс для удаления
        echo '</tr>'; // Конец строки таблицы
    }
    echo '<tr><td colspan="8"><input type="submit" value="Удалить выбранные заявки"></td></tr></table></form>'; // Добавляем кнопку удаления и закрываем форму и таблицу
} else {
    echo 'Нет заявок'; // Если нет файлов заявок
}
?>

<script>
    // Функция для выделения всех чекбоксов при нажатии на главный чекбокс
    document.getElementById("select-all").addEventListener("click", function(){
        var checkboxes = document.getElementsByName("delete[]");
        for(var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = this.checked;
        }
    });
</script>
