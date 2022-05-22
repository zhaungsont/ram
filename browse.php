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
                    $username =  $row['username'];
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
    <link rel="stylesheet" href="styles/browsestyle.css">
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

<section id="browse-section">

    <div class="container">
        <div class="row row-cols-4">
        <?php
        // 載入所有房型
        $houseTable = "SELECT *  FROM house WHERE havailability = '1';";

        $result = mysqli_query($link, $houseTable);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck > 0){
            // 資料庫內有這個帳號
            while ($row = mysqli_fetch_assoc($result)){

                $hid = $row['hid'];
                $hname = $row['hname'];
                $hdesc =  $row['hdesc'];
                $hprice = $row['hprice'];
                $havailability = $row['havailability'];

                // 把介紹文縮短一點，使用的語法是 ternary operator
                $truncDesc = (strlen($hdesc) > 40) ? substr($hdesc,0,37).'...' : $hdesc;
                // if ($havailability == '1'){
                ?>
                    <div class="col d-flex align-items-stretch">
                    <div class="card" style="width: 18rem;">
                    <img src="https://picsum.photos/300/200" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $hname ?></h5>
                        <p class="card-text"><?php echo $truncDesc ?></p>
                        
                        <form action="checkout.php" method="POST">
                            <h2>$<?php echo $hprice ?> / 每晚</h2>
                            <input type="hidden" name="hid" value=<?php echo $hid ?>>
                            <input type="hidden" name="hname" value=<?php echo $hname ?>>
                            <input type="hidden" name="hdesc" value=<?php echo $hdesc ?>>
                            <input type="hidden" name="hprice" value=<?php echo $hprice ?>>

                            <input type="submit" class="btn btn-primary" value="立馬訂購">
                        </form>
                    </div>
                    </div>
                    </div>
                <?php
                // }
            }
            

        } else {
            // 都沒房子ㄌ，尷尬
            echo "沒⋯⋯房⋯⋯可⋯⋯看⋯⋯";
        }
        // 釋放結果物件佔用的記憶體空間
        mysqli_free_result($result); 
        ?>
        </div>
    </div>
</section>
    
</body>
</html>