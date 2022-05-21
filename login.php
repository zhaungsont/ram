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
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@100;300;400;500;700;900&family=Noto+Serif+TC:wght@200;300;400;500;600;700;900&family=ZCOOL+QingKe+HuangYou&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <h1>Log in</h1>
    <form action="loginauth.php" method="POST">
        帳號 <input type="text" name="account">
        密碼 <input type="password" name="password">
        <button type="submit" class="btn btn-dark btn-lg">登入</button>
        <a href="register.php" class="btn btn-light btn-lg" role="button">註冊</a>
    </form>

</body>
</html>