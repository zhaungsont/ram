<?php
    session_start();
    
    if (!isset($_SESSION['uid'])){
        header("Location: login.php");
        exit();
    }
    if ($_SESSION['uid'] != $_POST['uid']){
        $message = "你沒有權限參訪這個頁面。";
        echo "<script type='text/javascript'>alert('$message');</script>";
        header( "refresh:0;url=listings.php" );
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
    $hid = (int)$_POST['hid'];
    
    $houseuploads = "SELECT * FROM house WHERE hid = $hid;";
    $result = mysqli_query($link, $houseuploads);
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck > 0){
        while ($row = mysqli_fetch_assoc($result)){
            $hname = $row['hname'];
            $hdesc =  $row['hdesc'];
            $hprice = $row['hprice'];
            $havailability = $row['havailability'];
            $haddress = $row['haddress'];
            $hownerid = $row['howner'];
            $himglink = $row['himglink'];
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
    
    <link rel="stylesheet" href="styles/createlistingstyle.css">
    <title>更新您的屋件</title>
    <link rel="icon" type="image/x-icon" href="public/logo.ico">

</head>
<body>
<?php require('require/header.php'); ?>

<section id="createlisting">
    <div class="clflex">

    <div class="clleft">
        <form action="modifylistingnauth.php" method="POST">
            <h1>修改您的屋件</h1>
            <br>
            <h3>屋件名稱</h3>
            <input class="form-control form-control-lg" type="text" name="hname" value="<?php echo $hname ?>" required>
            <h3>屋件地址</h3>
            <input class="form-control form-control-lg" type="text" name="haddress" value="<?php echo $haddress ?>" required>
            <h3>照片連結</h3>
            <input class="form-control form-control-lg" type="url" name="himglink" value="<?php echo $himglink ?>">
            <h3>屋件簡介</h3>
            <textarea class="form-control form-control-lg" name="hdesc"cols="30" rows="5" required><?php echo $hdesc ?></textarea>

            <h3>每晚售價</h3>
            <div class="input-group mb-3 input-group-lg">
            <span class="input-group-text">$</span>
            <input type="text" class="form-control" value="<?php echo $hprice ?>" name="hprice" required>
            <span class="input-group-text">／每晚</span>
            </div>
            <input type="hidden" name="uid" value="<?php echo $uid ?>" >
            <input type="hidden" name="hid" value="<?php echo $hid ?>" >

            <br>
            <div class="d-grid gap-2 col-20 mx-auto">
                <input type="submit" class="btn btn-lg btn-danger" value="更新資訊">
                <a href="listings.php" class="btn btn-dark">取消修改</a>
            </div>
        </form>
    </div>
        <img class="climg" src="<?php echo $himglink ?>" alt="您刊登的屋件">
    </div>
</section>

</body>

</html>