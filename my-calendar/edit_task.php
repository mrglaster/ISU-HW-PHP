<html>
  <header>
    <link type="text/css" rel="stylesheet" href="css/styles.css">
  </header>
</html>
<?php
if (isset($_GET['id'])) {
    $taskId = $_GET['id'];
		$servername = "127.0.0.1";
$username = "calendar_prist58";
$password = "OsIJeTL6";
$dbname = "calendar_prist58";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Ошибка подключения к базе данных: " . $conn->connect_error);
}
    // Запрос к базе данных для получения информации о задаче по идентификатору
    $sql = "SELECT * FROM tasks WHERE id = $taskId";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Форма редактирования задачи
        echo "
        <form action=\"update_task.php\" method=\"POST\">
        		<h2>Редактирование задачи</h2>
            <input type=\"hidden\" name=\"task_id\" value=\"" . $row['id'] . "\">
            <label for=\"theme\">Тема:</label>
            <input type=\"text\" name=\"theme\" id=\"theme\" value=\"" . $row['theme'] . "\" required><br>

            <label for=\"type\">Тип:</label>
            <select name=\"type\" id=\"type\" required>
                <option value=\"встреча\"" . ($row['type'] == 'встреча' ? ' selected' : '') . ">Встреча</option>
                <option value=\"звонок\"" . ($row['type'] == 'звонок' ? ' selected' : '') . ">Звонок</option>
                <option value=\"совещание\"" . ($row['type'] == 'совещание' ? ' selected' : '') . ">Совещание</option>
                <option value=\"дело\"" . ($row['type'] == 'дело' ? ' selected' : '') . ">Дело</option>
            </select><br>

            <label for=\"location\">Место:</label>
            <input type=\"text\" name=\"location\" id=\"location\" value=\"" . $row['location'] . "\" required><br>

            <label for=\"datetime\">Дата и время:</label>
            <input type=\"datetime-local\" name=\"datetime\" id=\"datetime\" value=\"" . date('Y-m-d\TH:i', strtotime($row['date_time'])) . "\" required><br>

            <label for=\"duration\">Длительность (в минутах):</label>
            <input type=\"number\" name=\"duration\" id=\"duration\" value=\"" . $row['duration'] . "\" required><br>

            <label for=\"comment\">Комментарий:</label>
            <textarea name=\"comment\" id=\"comment\">" . $row['comment'] . "</textarea><br>

            <input type=\"submit\" value=\"Сохранить изменения\">
        </form>
        ";
    } else {
        echo "Задача не найдена";
    }
}
?>