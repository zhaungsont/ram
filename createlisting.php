<?php

    session_start();

    if (!isset($_SESSION['uid'])){
        header("Location: login.php");
    }
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

    $uid = $_SESSION['uid'];
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
    
    <link rel="stylesheet" href="styles/createlistingstyle.css">
    <title>刊登在租隊友上</title>
</head>
<body>
<?php require('require/header.php'); ?>

<section id="createlisting">
    <div class="clflex">

    <div class="clleft">
        <form action="creationauth.php" method="POST">
            <h1>刊登您的房屋</h1>
            <br>
            <h3>屋件名稱</h3>
            <input class="form-control form-control-lg" type="text" name="hname" placeholder="屋件名稱⋯⋯" required>
            <h3>屋件地址</h3>
            <input class="form-control form-control-lg" type="text" name="haddress" placeholder="屋件地址⋯⋯" required>
            <h3>照片連結</h3>
            <input class="form-control form-control-lg" type="url" name="himglink" placeholder="非必填">
            <h3>屋件簡介</h3>
            <textarea class="form-control form-control-lg" name="hdesc"cols="30" rows="5" placeholder="屋件簡介⋯⋯" required></textarea>

            <h3>每晚售價</h3>
            <div class="input-group mb-3 input-group-lg">
            <span class="input-group-text">$</span>
            <input type="text" class="form-control" placeholder="售價⋯⋯" name="hprice" required>
            <span class="input-group-text">／每晚</span>
            </div>
            <input type="hidden" name="uid" value=<?php echo $uid ?>>
            <br>
            <div class="d-grid gap-2 col-20 mx-auto">
                <input type="submit" class="btn btn-lg btn-dark" value="刊登">
            </div>
        </form>
    </div>


        <img class="climg" src="https://images.pexels.com/photos/2102587/pexels-photo-2102587.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260" alt="黃色混凝土房子">


    </div>

</section>

</body>

</html>