<?php
    session_start();

    // 懶得一直做登入的話就把這個放出來
    // $_SESSION['uid'] = 'gg';
    // $_POST['hchoice'] = '124';

    if (isset($_SESSION['uid']) && (isset($_POST['hid']))){
        $user = $_SESSION['uid'];
    } else {
        // 沒有登入或沒有點選下單就到此頁面
        header('Location: login.php');
    }

    // 連線 MySQL
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
                    $username =  $row['username'];
                }
            } 
            
        }

        // 載入使用者欲下單的房型（沒辦法直接用表單傳，PHP POST 有資料乘載上限）
        $hid = $_POST['hid'];
        $houseTable = "SELECT * FROM house WHERE hid = '$hid';";
        $result = mysqli_query($link, $houseTable);
        $resultCheck = mysqli_num_rows($result);

        if ($resultCheck > 0){
            while ($row = mysqli_fetch_assoc($result)){
                $hname = $row['hname'];
                $hdesc =  $row['hdesc'];
                $hprice = $row['hprice'];
                $havailability = $row['havailability'];
            }
        } else {
            echo "錯誤";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/checkoutstyle.css">
    <link rel="stylesheet" href="styles/common.css">
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@100;300;400;500;700;900&family=Noto+Serif+TC:wght@200;300;400;500;600;700;900&family=ZCOOL+QingKe+HuangYou&display=swap" rel="stylesheet">
    <title>Checkout</title>
</head>
<body>
<?php require('require/header.php'); ?>

    <section id="checkout-section">
        <div class="decoration">
            <img src="https://picsum.photos/400/200">
            <div class="form">
                <h1><?php echo $username ?>，這是您的訂單</h1>
                <h2><?php echo $hname ?></h2>
                <p><?php echo $hdesc ?></p>

                <form action="success.php" method="POST">
                    <span>入住長度：</span>
                    <input required type="text" name="nights">    
                    <span>x $<?php echo $hprice ?></span>
                    <input type="hidden" name="hid" value=<?php echo $hid ?>>
                    <input type="hidden" name="hname" value=<?php echo $hname ?>>
                    <br><br>
                    <div class="buttonflex">
                        <button type="submit" class="btn btn-dark btn-lg">訂房</button>
                    </div>

                </form>
            </div>
        </div>
    </section>
</body>
</html>