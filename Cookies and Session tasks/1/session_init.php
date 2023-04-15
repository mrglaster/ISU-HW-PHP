
<?php
session_start(); 

if (!isset($_SESSION['text'])) {
    $_SESSION['text'] = 'test'; 
} else { 
    echo $_SESSION['text']; 
}
?>
