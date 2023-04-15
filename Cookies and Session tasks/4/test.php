<?php
session_start();
if(isset($_SESSION['country'])){
    echo "Ваша страна: " . $_SESSION['country'];
} else {
    echo "Вы еще не выбрали страну";
}
?>
