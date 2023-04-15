<!-- form2.php -->
<?php
session_start();

if (!isset($_SESSION['email'])) {
  header('Location: form.php');
  exit();
}
?>

<form method="post"">
  <label for="email">Email:</label>
  <input type="email" id="email" name="email" value="<?php echo $_SESSION['email'] ?>" readonly>
  
  <label for="name">Имя:</label>
  <input type="text" id="name" name="name">
  
  <label for="surname">Фамилия:</label>
  <input type="text" id="surname" name="surname">
  
  <label for="password">Пароль:</label>
  <input type="password" id="password" name="password">
  
  <button type="submit">Отправить</button>
</form>