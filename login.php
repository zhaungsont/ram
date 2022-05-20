<?php
    session_start();

    // 登入系統完成後再取消 comment
    // if (isset($_SESSION['uid'])){
    //     header('Location: home.php');
    // }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Log in</h1>
    帳號 <input type="text" name="account">
    密碼 <input type="password" name="password">
    <button type="submit" class="btn btn-dark btn-lg">登入</button>
</body>
</html>