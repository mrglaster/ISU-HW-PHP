<?php
session_start();
if(isset($_POST['country'])){
    $_SESSION['country'] = $_POST['country'];
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Index Page</title>
</head>
<body>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<label for="country">Выберите страну:</label>
		<select name="country" id="country">
			<option value="Россия">Россия</option>
			<option value="США">США</option>
			<option value="Канада">Канада</option>
			<option value="Великобритания">Великобритания</option>
		</select>
		<input type="submit" name="submit" value="Отправить">
	</form>
</body>
</html>