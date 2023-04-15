<?php
	session_start();
	$_SESSION['tasktwovalue'] = 'hello world'; 
	echo "Printed was: ".$_SESSION['tasktwovalue'];
