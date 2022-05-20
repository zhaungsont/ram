<?php
    session_start();
    $link = mysqli_connect(
        'localhost', // mysql 主機名稱
        'root', // 使用者名稱
        '', // 密碼
        'ram' // 預設使用的資料庫名稱
    );

    if (!$link) {
        echo "MySQL 連線錯誤<br>";
        exit();
    } else {
        echo "MySQL ram 資料庫連接成功<br>";
    }

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
    <form action="auth.php" method="POST">
        帳號 <input type="text" name="account">
        密碼 <input type="password" name="password">
        <button type="submit" class="btn btn-dark btn-lg">登入</button>
    </form>
</body>
</html>