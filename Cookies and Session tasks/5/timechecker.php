<?php
session_start();
if (empty($_SESSION['time'])) {
    $_SESSION['time'] = time();
}
 
echo "You joined this page ".time() - $_SESSION['time']." seconds ago";