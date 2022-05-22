<?php
    session_start();

    if (isset($_SESSION['uid'])){
        session_destroy();
        
        // echo "<h1>已登出</h1>";
        // header( "refresh:3;url=home.php" );
        
        header('Location: home.php');
    } else {
        header('Location: home.php');
    }
?>