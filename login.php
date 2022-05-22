<?php
    session_start();

    // 檢查使用者是否早就登入過了，如果是就重新導向到 /browse
    if (isset($_SESSION['uid'])){
        header("Location: browse.php");
        exit();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- 共用CSS -->
    <link rel="stylesheet" href="styles/common.css">
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@100;300;400;500;700;900&family=Noto+Serif+TC:wght@200;300;400;500;600;700;900&family=ZCOOL+QingKe+HuangYou&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body>
<?php require('require/header.php'); ?>

    <h1>Log in</h1>
    <form action="loginauth.php" method="POST">
        帳號 <input type="text" name="account">
        密碼 <input type="password" name="password">
        <button type="submit" class="btn btn-dark btn-lg">登入</button>
        <a href="register.php" class="btn btn-light btn-lg" role="button">註冊</a>
    </form>

</body>
</html>