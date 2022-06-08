<?php

    session_start();

    if (isset($_SESSION['uid'])){
        $uid = $_SESSION['uid'];
    } else {
        // 沒有登入或沒有點選下單就到此頁面
        header('Location: login.php');
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

    $personalInfo = "SELECT * FROM user WHERE uid = $uid;";
    $result = mysqli_query($link, $personalInfo);
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck > 0){
        while ($row = mysqli_fetch_assoc($result)){
            $account = $row['account'];
            $username = $row['username'];
            $_SESSION['upw'] = $row['password'];
        }
    } else {
        echo "MySQL 帳號取得錯誤<br>";
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
    <title>管理我的屋件</title>
    <link rel="stylesheet" href="styles/listings.css">
    <link rel="icon" type="image/x-icon" href="public/logo.ico">

</head>
<body>
<?php require('require/header.php'); ?>
    <img class="bgblur" src="https://images.pexels.com/photos/7932264/pexels-photo-7932264.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" alt="bunch of houses">
    <h1 class="listing-main-title">管理我的屋件</h1>
    
    <section id="myaccount">
        <div class="titlebtn">
            <h2 class="listing-title">個人資料</h2>
            <form action="editpersonalinfo.php" method="POST">
                <input type="hidden" name="uid" value=<?php echo $uid ?>>
                <button type="submit" class="btn btn-outline-dark">編輯個人資料</button>
            </form>
            <!-- <a href="editpersonalinfo.php" class="btn btn-outline-dark">編輯個人資料</a> -->
        </div>
        <hr>
            <div class="account-entry">
                <h3>帳號：<?php echo $account ?></h3>
                <h3>密碼：*********</h3>
            </div>
            <div class="account-entry">
                <h3>使用者名稱：<?php echo $username?></h3>
            </div>
    </section>

    <section id="myorders">
        <div class="titlebtn">
            <h2 class="listing-title">我的訂單</h2>
            <a href="browse.php" class="btn btn-dark">瀏覽更多房型</a>
        </div>
        <hr>

        <?php
            $houseorders = "SELECT *  FROM house WHERE hrenter = ".(int)$uid.";";
            $result = mysqli_query($link, $houseorders);
            $resultCheck = mysqli_num_rows($result);
            if ($resultCheck > 0){
                while ($row = mysqli_fetch_assoc($result)){
                    $hid = $row['hid'];
                    $hname = $row['hname'];
                    $hdesc =  $row['hdesc'];
                    $hprice = $row['hprice'];
                    $havailability = $row['havailability'];
                    $haddress = $row['haddress'];
                    $hownerid = $row['howner'];
                    $himglink = $row['himglink'];
                    $hsm = $row['hsm'];
                    $hem = $row['hem'];
                    $hsd = $row['hsd'];
                    $hed = $row['hed'];
                    ?>

                    <div class="listing-entry">
                    <img class="entry-image" src=<?php echo empty($himglink) ? "https://picsum.photos/300/200" : "$himglink" ?> alt="房屋照片">
                        <div class="entry-desc">
                            <span><h3><?php echo $hname ?></h3> 
                            <img class="location" src="public/location.png" alt="location pin"><?php echo empty($haddress) ? '台灣' : $haddress ?>&nbsp;&nbsp;&nbsp;<?php echo empty($hsm) ? "" : "$hsm 月 $hsd 日 — $hem 月 $hed 日"?></span>
                            <p><?php echo $hdesc ?></p>
                        </div>
                        <div class="entry-info">
                            <h3>$<?php echo $hprice ?>元／每晚</h3>
                            <form action="cancelorder.php" method="POST">
                                <input type="hidden" name="uid" value=<?php echo $uid ?>>
                                <input type="hidden" name="hid" value=<?php echo $hid ?>>
                                <div class="d-grid gap-2 col-20 mx-auto">
                                    <button type="submit" class="btn btn-outline-danger">取消訂房</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <?php
                }
            } else {
                echo "<h3 class='nolistings'>尚無屋件。</h3>";
            }
        ?>

    </section>
    
    <section id="mylistings">
        <div class="titlebtn">
            <h2 class="listing-title">我刊登的屋件</h2>
            <a href="createlisting.php" class="btn btn-dark">刊登新的屋件</a>
        </div>
        <hr>
        <?php
            $houseuploads = "SELECT *  FROM house WHERE howner = ".(int)$uid.";";
            $result = mysqli_query($link, $houseuploads);
            $resultCheck = mysqli_num_rows($result);
            if ($resultCheck > 0){
                while ($row = mysqli_fetch_assoc($result)){
                    $hid = $row['hid'];
                    $hname = $row['hname'];
                    $hdesc =  $row['hdesc'];
                    $hprice = $row['hprice'];
                    $havailability = $row['havailability'];
                    $haddress = $row['haddress'];
                    $hownerid = $row['howner'];
                    $himglink = $row['himglink'];
                    ?>

                    <div class="listing-entry">
                        <img class="entry-image" src=<?php echo empty($himglink) ? "https://picsum.photos/300/200" : "$himglink" ?> alt="房屋照片">
                        <div class="entry-desc">
                            <span><h3><?php echo $hname ?></h3> <img class="location" src="public/location.png" alt="location pin"><?php echo empty($haddress) ? '台灣' : $haddress ?></span>
                            <p><?php echo $hdesc ?></p>
                            
                        </div>
                        <div class="entry-info">
                            <h3>$<?php echo $hprice ?>元／每晚</h3>
                            <form action="removelisting.php" method="POST">
                                <input type="hidden" name="uid" value=<?php echo $uid ?>>
                                <input type="hidden" name="hid" value=<?php echo $hid ?>>
                                <div class="d-grid gap-2 col-20 mx-auto">

                                <?php
                                    if ($havailability == '0'){
                                        echo "<button type='submit' class='btn btn-outline-danger' disabled>取消刊登</button>";
                                        echo "<i>屋件出租中</i>";
                                    } else {
                                        echo "<button type='submit' class='btn btn-outline-danger'>取消刊登</button>";
                                    }
                                ?>
                                </div>
                            </form>
                        </div>
                    </div>

                    <?php
                }
            } else {
                echo "<h3 class='nolistings'>尚無屋件。</h3>";
            }
            // 釋放結果物件佔用的記憶體空間
            mysqli_free_result($result); 
            // 斷開SQL連接
            mysqli_close($link);
        ?>
    </section>
</body>
</html>