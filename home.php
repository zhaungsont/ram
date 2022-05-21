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
        // 有登入才給 username ，沒登入沒關係，就省略
        if (isset($_SESSION['uid'])){
            $uid = $_SESSION['uid'];
            $sql = "SELECT *  FROM user WHERE uid = '$uid';";
            $result = mysqli_query($link, $sql);
            $resultCheck = mysqli_num_rows($result);

            if ($resultCheck > 0){
                // 資料庫內有這個帳號
                while ($row = mysqli_fetch_assoc($result)){
                    $username =  $row['name'];
                }
            } 
            
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/homestyle.css">
    <link rel="stylesheet" href="styles/common.css">
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@100;300;400;500;700;900&family=Noto+Serif+TC:wght@200;300;400;500;600;700;900&family=ZCOOL+QingKe+HuangYou&display=swap" rel="stylesheet">

    <title>租隊友</title>
</head>

<body>
<section id="header">
        <div class="flex-wrap">
            <div class="fleft">
                <img src="https://picsum.photos/100" alt="">
                <span>Rent-A-Mate</span>
            </div>

            <div class="fright">
                <?php
                if (isset($_SESSION['uid'])){
                ?>

                <div class="listing">
                    <img src="https://picsum.photos/100" alt="">
                    <span>刊登物件</span>
                </div>
                <div class="user">
                    <span><?php echo $username ?></span>
                    <img src="https://picsum.photos/100" alt="">
                </div>
                <form action="logout.php" method="POST">
                    <div class="logout">
                    <button type="submit" class="btn btn-dark btn-lg">登出</button>
                    </div>
                </form>

                <?php
                } else {
                ?>
                <div>
                    <a href="login.php">登入</a>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
    </section>
    <!-- <section id="banner">
        <div class="banner-wrapper">
            <div class="bleft">
                <img src="https://picsum.photos/300/200" alt="placeholder">
                <h1 class="banner-title">&nbsp租隊友</h1>
            </div>
            <div class="bright">
                <div class="listing">
                    <img src="https://picsum.photos/100" alt="">
                    <span>刊登物件</span>
                </div>
                <div class="user">
                    <span>#使用者名稱</span>
                    <img src="https://picsum.photos/100" alt="">
                </div>
            </div>
        </div>
    </section> -->

    <section id="landing-zone">
        <div class="landing-wrapper">
            <div class="lw-left">
                <h1>租屋進行式</h1>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Magni praesentium ullam a. Nesciunt, at necessitatibus adipisci molestias impedit quas debitis culpa? Adipisci sunt facilis magnam veritatis vero maxime magni harum.</p>
            </div>
            <div class="lw-right">
                <img src="https://picsum.photos/600/800" alt="">
            </div>
        </div>
    </section>

    <?php



    ?>

</body>

</html>