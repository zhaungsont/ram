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
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- 共用CSS -->
    <link rel="stylesheet" href="styles/common.css">
    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@100;300;400;500;700;900&family=Noto+Serif+TC:wght@200;300;400;500;600;700;900&family=ZCOOL+QingKe+HuangYou&display=swap" rel="stylesheet">
    <title>登入租隊友</title>
    <link rel="stylesheet" href="styles/login.css">
</head>
<body>
<?php require('require/header.php'); ?>
<div class="loginwrapper">
    <img class="lwrap" src="public/ram-cover2.png" alt="室內裝潢">
    <div class="rwrap">
        <h1>登入美好。</h1>
        <form action="loginauth.php" method="POST">
            <h3>帳號</h3>
            <input class="form-control form-control-lg" type="text" name="account" required>
            <h3>密碼</h3>
            <input class="form-control form-control-lg" type="password" name="password" required>

            <br><br>
            <div class="d-grid gap-2 col-20 mx-auto">
                <button type="submit" class="btn btn-dark btn-lg">登入</button>
                <a href="register.php" class="btn btn-outline-dark btn-lg" role="button">註冊</a>
            </div>
            
        </form>
    </div>
</div>

</body>

</html>