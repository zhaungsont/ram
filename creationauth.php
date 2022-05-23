<?php

session_start();

if (!isset($_SESSION['uid'])){
    header('Location: login.php');
} elseif (!isset($_POST['hname'])){
    header('Location: createlisting.php');
}



?>