<?php
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$interests = $_POST['interests'];
$payment_method = $_POST['payment_method'];
$newsletter = isset($_POST['newsletter']) ? 'Да' : 'Нет';

// Проверка заполненности полей
if (!((empty($first_name) || empty($last_name) || empty($email) || empty($phone) || empty($interests) || empty($payment_method)))) {
    // Сохранение данных в файл
    $file_name = 'applications/' . uniqid() . '.txt';
    $data = "Имя: $first_name\nФамилия: $last_name\nEmail: $email\nТелефон: $phone\nТема: $interests\nМетод оплаты: $payment_method\nОтправлять информацию о конференции: $newsletter\n";
		$file = fopen($file_name, "w");
		fwrite($file, $data);
		fclose($file);
		echo "<h2>Ваша заявка успешно отправлена!</h2>";
} else {
	echo "<h2>Вы должны заполнить все поля!</h2>";
}