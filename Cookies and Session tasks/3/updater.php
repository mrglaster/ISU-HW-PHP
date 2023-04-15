<?php

session_start();
if (!isset($_SESSION['counter'])) {
    $_SESSION['counter'] = 0;
	echo "Page wasn't updated yet!";
} else { 
	$_SESSION['counter'] = $_SESSION['counter'] + 1;
    echo "Page was updated ".$_SESSION['counter']." times"; 
}