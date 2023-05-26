<html>
<head>
    <link type="text/css" rel="stylesheet" href="css/styles.css">
    <style>
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
          position: relative;
          top: 15%;
        }
        .container form {
            margin-bottom: 10px;
        }
        .button-group {
            display: flex;
            flex-direction: column;
            margin-top: 10px;
        }
        .button-group input[type="submit"] {
            margin-bottom: 5px;
        }
      
      	
      .btn{
      	margin-top: 15px;
        
      }
      
      
    </style>
    <title>Мой календарь</title>
</head>
<body>
    <div class="container">
        <form action="add_task.php" method="POST">
            <h1>Мой календарь</h1>
            <h2>Добавление задачи</h2>
            <label for="theme">Тема:</label>
            <input type="text" name="theme" id="theme" required><br>

            <label for="type">Тип:</label>
            <select name="type" id="type" required>
                <option value="встреча">Встреча</option>
                <option value="звонок">Звонок</option>
                <option value="совещание">Совещание</option>
                <option value="дело">Дело</option>
            </select><br>

            <label for="location">Место:</label>
            <input type="text" name="location" id="location" required><br>

            <label for="datetime">Дата и время:</label>
            <input type="datetime-local" name="datetime" id="datetime" required><br>

            <label for="duration">Длительность (в минутах):</label>
            <input type="number" name="duration" id="duration" required><br>

            <label for="comment">Комментарий:</label>
            <textarea name="comment" id="comment"></textarea><br>

            <input type="submit" value="Добавить задачу">
        </form>

        <h2>Выборка задач</h2>
        <form action="" method="GET">
            <div class="button-group">
                <label for="task_date">Выберите дату:</label>
                <input type="date" name="task_date" id="task_date">
                <input type="submit" class="btn" value="Показать">
            </div>
            <div>
                <input type="submit" class="btn" action="index.php?today" id="today" name="today" value="На сегодня">
                <br>
                <input type="submit" class="btn" action="index.php?tomorrow" id="tomorrow" name="tomorrow" value="На завтра">
                <br>
                <input type="submit" class="btn" action="index.php?current_week" id="current_week" name="current_week" value="На текущую неделю">
                <br>
                <input type="submit" class="btn" action="index.php?current_month" id="current_month" name="current_month" value="На текущий месяц">
            </div>
        </form>
  </div>
    <?php
    // Подключение к базе данных
    $servername = "127.0.0.1";
    $username   = "calendar_prist58";
    $password   = "OsIJeTL6";
    $dbname     = "calendar_prist58";
    $conn       = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Ошибка подключения к базе данных: " . $conn->connect_error);
    }

    // Получение текущих задач
    if (isset($_POST['task_date'])) {
        $taskDate = $_POST['task_date'];
       $sql = "SELECT * FROM tasks WHERE DATE(date_time) = '$taskDate' ORDER BY date_time DESC";
    } elseif (isset($_GET['today'])) {
        $today = date("Y-m-d", strtotime("today"));
        $sql = "SELECT * FROM tasks WHERE DATE(date_time) = '$today'";
    } elseif (isset($_GET['tomorrow'])) {
        $tomorrow = date("Y-m-d", strtotime("+1 day"));
        $sql = "SELECT * FROM tasks WHERE DATE(date_time) = '$tomorrow'";
    } elseif (isset($_GET['current_week'])) {
        $currentWeekStart = date("Y-m-d", strtotime("monday this week"));
        $currentWeekEnd = date("Y-m-d", strtotime("sunday this week"));
        $sql = "SELECT * FROM tasks WHERE DATE(date_time) >= '$currentWeekStart' AND DATE(date_time) <= '$currentWeekEnd'";
    } elseif (isset($_GET['current_month'])) {
        $currentMonthStart = date("Y-m-01");
        $currentMonthEnd = date("Y-m-t");
        $sql = "SELECT * FROM tasks WHERE DATE(date_time) >= '$currentMonthStart' AND DATE(date_time) <= '$currentMonthEnd'";
    } else {
        $sql = "SELECT * FROM tasks";
    }

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<table>
            <tr>
                <th>Тема</th>
                <th>Тип</th>
                <th>Место</th>
                <th>Дата и время</th>
                <th>Длительность</th>
                <th>Комментарий</th>
            </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . ($row['theme'] ? $row['theme'] : "-") . "</td>";
            echo "<td>" . ($row['type'] ? $row['type'] : "-") . "</td>";
            echo "<td>" . ($row['location'] ? $row['location'] : "-") . "</td>";
            echo "<td>" . ($row['date_time'] ? $row['date_time'] : "-") . "</td>";
            echo "<td>" . ($row['duration'] ? $row['duration'] . " мин." : "-") . "</td>";
            echo "<td>" . ($row['comment'] ? $row['comment'] : "-") . "</td>";
            echo "<td><a href=\"edit_task.php?id=" . $row['id'] . "\">✐</a></td>";
    				echo "<td><a href=\"delete_task.php?id=" . $row['id'] . "\"> ☒</a></td>";
          	echo "</tr>";
          
        }

        echo "</table>";
    } else {
        echo "Нет задач для отображения";
    }

    $conn->close();
    ?>
</body>
</html>