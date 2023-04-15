<?php

session_start();
function generateRandomString($length = 10)
{
    $characters =
        "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $charactersLength = strlen($characters);
    $randomString = "";
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
}

function write_secretdata($data){
	$file = 'people.txt';
	$current = file_get_contents($file);
	$current .= $data."\n";
	file_put_contents($file, $current);
}


function is_in_file($string) {
    $file = fopen('people.txt', 'r');
    while (!feof($file)) {
        $line = fgets($file);
        $line = trim($line);
        if ($string === $line) {
            fclose($file);
            return true; 
        }
    }
    fclose($file);
    return false; 
}

function main()
{	
    if (!isset($_SESSION["mysuperkey"])) {
        echo "<h2> Welcome to our super website! </h2>";
        $_SESSION["mysuperkey"] = generateRandomString(20);
		write_secretdata($_SERVER["HTTP_USER_AGENT"].$_SESSION["mysuperkey"]);
    } else {
		
        if (!is_in_file($_SERVER["HTTP_USER_AGENT"] . $_SESSION["mysuperkey"])) {
            echo "<h2> ACHTUNG! YOU ARE USING THE STOLEN COOKIES! </h2>";
        } else {
            echo "<h2> Welcome back to our website! </h2>";
        }
    }
}
main();