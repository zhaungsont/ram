<?php
    session_start();

    // 因為現在懶得一直做登入
    $_SESSION['uid'] = 'gg';
    $_POST['hchoice'] = '124';

    if (isset($_SESSION['uid']) && (isset($_POST['hchoice']))){
        $user = $_SESSION['uid'];
        $house = $_POST['hchoice'];
    } else {
        // 沒有登入或沒有點選下單就到此頁面
        header('Location: login.php');
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
    <section id="header">
        <div class="flex-wrap">
            <div class="fleft">
                <img src="https://picsum.photos/100" alt="">
                <span>Rent-A-Mate</span>
            </div>
            <div class="fright">
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
    </section>
    <section id="checkout-section">
        <div class="decoration">
            <img src="https://picsum.photos/400/300">
            <div class="form">
                <h1>#使用者，這是您的訂單</h1>
                <h2>#屋件名稱</h2>
                <p>#屋件簡介屋件簡介屋件簡介屋件簡介屋件簡介屋件簡介屋件簡介屋件簡介屋件簡介屋件簡介屋件簡介屋件簡介屋件簡介屋件簡介屋件簡介屋件簡介屋件簡介屋件簡介屋件簡介屋件簡介屋件簡介屋件簡介屋件簡介屋件簡介屋件簡介屋件簡介屋件簡介屋件簡介屋件簡介屋件簡介屋件簡介屋件簡介屋件簡介屋件簡介屋件簡介屋件簡介屋件簡介屋件簡介屋件簡介屋件簡介屋件簡介屋件簡介屋件簡介屋件簡介屋件簡介屋件簡介屋件簡介屋件簡介</p>
                <form action="success.php" method="POST">
                    <span>入住長度：</span>
                    <input required type="text" name="nights">    
                    <span>x $#價錢</span>
                    <input type="hidden" name="checkouthouse" value=<?php echo $house ?>>
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