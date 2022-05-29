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
        // if (isset($_SESSION['uid'])){
        //     $uid = $_SESSION['uid'];
        //     $sql = "SELECT *  FROM user WHERE uid = '$uid';";
        //     $result = mysqli_query($link, $sql);
        //     $resultCheck = mysqli_num_rows($result);

        //     if ($resultCheck > 0){
        //         // 資料庫內有這個帳號
        //         while ($row = mysqli_fetch_assoc($result)){
        //             $username =  $row['username'];
        //         }
        //     } 
            
        // }

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
                $himglink = $row['himglink'];

                $fee = (int)($hprice * 0.1);
                $actualprice = $hprice + $fee;
                // echo $fee."<br>".$actualprice;
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
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- 共用CSS -->
    <link rel="stylesheet" href="styles/common.css">
    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@100;300;400;500;700;900&family=Noto+Serif+TC:wght@200;300;400;500;600;700;900&family=ZCOOL+QingKe+HuangYou&display=swap" rel="stylesheet">
    <title>Checkout</title>
    <link rel="stylesheet" href="styles/checkoutstyle.css">
</head>
<body>
<?php require('require/header.php'); ?>

    <section id="checkout-section">
        <h1><?php echo $username ?>，這是您的訂單</h1>
        <div class="cwrapper">
            <div class="lwrap">
                <h2><?php echo $hname ?></h2>
                <!-- <h3>訂購人：<?php echo $username ?></h3> -->
                <img src=<?php echo empty($himglink) ? "https://picsum.photos/300/200" : "$himglink" ?> alt="房屋照片">
                <!-- <h2>訂單資訊</h2> -->
            </div>
            <div class="rwrap">
                <h3>屋件簡介</h3>
                <p><?php echo $hdesc ?></p>

                <br>
                <div class="sum">
                    <h3>每晚售價</h3>
                    <h3><?php echo $hprice ?>元</h3>
                </div>
                <div class="sum">
                    <h3>加收一成服務費</h3>
                    <h3><?php echo $fee ?>元</h3>
                </div>
                <hr>
                <div class="sum">
                    <h2>總金額</h2>
                    <h3><?php echo $actualprice ?>元</h3>
                </div>
                <br>

                <!-- <input type="text" class="form-control form-control-lg" name=""> -->
                <div class="inpflex">
                    <h3>入住&nbsp;</h3>
                    <!-- <div class="input-group mb-3">
                        <span class="input-group-text">入住</span>
                        <input required type="text" class="form-control form-control-lg" placeholder="1" name="nights">
                        <span class="input-group-text">個晚上</span>
                    </div> -->
                    <form action="success.php" method="POST">
                    <div class="inpflexflex">
                        <input type="text" class="form-control" placeholder="1" name="nights">
                        <h3>&nbsp;個晚上</h3>
                    </div>
                </div>
                <input type="hidden" name="hid" value=<?php echo $hid ?>>
                <input type="hidden" name="hname" value=<?php echo $hname ?>>
                <div class="d-grid gap-2 col-20 mx-auto">
                    <button type="submit" class="btn btn-dark btn-lg orderbtn">訂房</button>
                </div>
                </form>
            </div>
        </div>
        <!-- <div class="decoration">
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
        </div> -->
    </section>
</body>

</html>