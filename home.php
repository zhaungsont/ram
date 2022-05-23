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
    } 
    // else {
    //     // 有登入才給 username ，沒登入沒關係，就省略
    //     if (isset($_SESSION['uid'])){
    //         $uid = $_SESSION['uid'];
    //         $sql = "SELECT *  FROM user WHERE uid = '$uid';";
    //         $result = mysqli_query($link, $sql);
    //         $resultCheck = mysqli_num_rows($result);

    //         if ($resultCheck > 0){
    //             // 資料庫內有這個帳號
    //             while ($row = mysqli_fetch_assoc($result)){
    //                 $username =  $row['username'];
    //             }
    //         } 
            
    //     }
    // }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/homestyle.css">
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- 共用CSS -->
    <link rel="stylesheet" href="styles/common.css">
    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@100;300;400;500;700;900&family=Noto+Serif+TC:wght@200;300;400;500;600;700;900&family=ZCOOL+QingKe+HuangYou&display=swap" rel="stylesheet">

    <title>租隊友</title>
</head>

<body>
    <?php require('require/header.php'); ?>

    <section id="landing-zone">
        <div class="landing-wrapper">
            <div class="lw-left">
                <h1>租屋進行式</h1>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Magni praesentium ullam a. Nesciunt, at necessitatibus adipisci molestias impedit quas debitis culpa? Adipisci sunt facilis magnam veritatis vero maxime magni harum.</p>
                <a href="browse.php" class="btn btn-dark btn-lg">立即看房</a>
            </div>
            <div class="lw-right">
                <img src="https://picsum.photos/600/800" alt="">
            </div>
        </div>
    </section>

    <?php
    // 釋放結果物件佔用的記憶體空間
    mysqli_free_result($result); 
    

    ?>

</body>

</html>