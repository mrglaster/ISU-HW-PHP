<?php
// Подключение к базе данных
$servername = "127.0.0.1";
$username = "calendar_prist58";
$password = "OsIJeTL6";
$dbname = "calendar_prist58";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Ошибка подключения к базе данных: " . $conn->connect_error);
}

// Получение данных из формы
$theme = $_POST['theme'];
$type = $_POST['type'];
$location = $_POST['location'];
$datetime = $_POST['datetime'];
$duration = $_POST['duration'];
$comment = $_POST['comment'];

// Вставка данных в таблицу
$sql = "INSERT INTO tasks (theme, type, location, date_time, duration, comment) VALUES ('$theme', '$type', '$location', '$datetime', '$duration', '$comment')";

if ($conn->query($sql) === TRUE) {
    echo "Задача успешно добавлена!";
} else {
    echo "Ошибка: " . $sql . "<br>" . $conn->error;
}

$conn->close();
$redir = "https://calendar-pristavka.hostfl.ru/my-calendar/index.php";
header('Location: '.$redir);
exit();
?>