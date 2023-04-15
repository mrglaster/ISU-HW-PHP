<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $_SESSION['email'] = $_POST['email'];
  header('Location: form2.php');
  exit();
}
?>