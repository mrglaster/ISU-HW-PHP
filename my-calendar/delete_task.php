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
    // Запрос к базе данных для удаления задачи по идентификатору
    $sql = "DELETE FROM tasks WHERE id = $taskId";
    if ($conn->query($sql) === TRUE) {
        echo "Задача успешно удалена";
    } else {
        echo "Ошибка при удалении задачи: " . $conn->error;
    }
	$redir = "https://calendar-pristavka.hostfl.ru/my-calendar/index.php";
	header('Location: '.$redir);
	exit();
}
?>