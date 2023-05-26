<html>
	<header>
  <style>
    body {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  background-color: #f5f5f5;
  font-family: Arial, sans-serif;
}

.container {
  max-width: 500px;
  background-color: #ffffff;
  padding: 40px;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

h1 {
  text-align: center;

}

form {
  margin-top: 20px;
}

form label {
  display: block;
  font-weight: bold;
  margin-bottom: 8px;
}

form input[type="text"],
form select,
form input[type="datetime-local"],
form input[type="number"],
form textarea {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-bottom: 16px;
  font-size: 16px;
}


form input[type="submit"] {
  background-color: #4CAF50;
  color: #ffffff;
  border: none;
  padding: 12px 20px;
  border-radius: 4px;
  cursor: pointer;
  font-size: 16px;
}

form input[type="submit"]:hover {
  background-color: #45a049;
}



table {
  margin-top: 50px;
  width: 100%;
  border-collapse: collapse;
  margin-bottom: 20px;
}

th, td {
  padding: 12px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}

th {
  background-color: #f5f5f5;
}

tr:nth-child(even) {
  background-color: #f9f9f9;
}

tr:hover {
  background-color: #f2f2f2;
}
    </style>
  </header>
  <body>
    
  </body>
</html>
<?php
if (isset($_POST['task_id'])) {
    $taskId = $_POST['task_id'];
    $theme = $_POST['theme'];
    $type = $_POST['type'];
    $location = $_POST['location'];
    $datetime = $_POST['datetime'];
    $duration = $_POST['duration'];
    $comment = $_POST['comment'];
		$servername = "127.0.0.1";
		$username = "calendar_prist58";
		$password = "OsIJeTL6";
		$dbname = "calendar_prist58";

		$conn = new mysqli($servername, $username, $password, $dbname);
		if ($conn->connect_error) {
    	die("Ошибка подключения к базе данных: " . $conn->connect_error);
		}
    // Запрос к базе данных для обновления задачи
    $sql = "UPDATE tasks SET theme = '$theme', type = '$type', location = '$location', date_time = '$datetime', duration = $duration, comment = '$comment' WHERE id = $taskId";
    if ($conn->query($sql) === TRUE) {
        echo "Задача успешно обновлена";
    } else {
        echo "Ошибка при обновлении задачи: " . $conn->error;
    }
	$redir = "https://calendar-pristavka.hostfl.ru/my-calendar/index.php";
	header('Location: '.$redir);
	exit();
}
?>