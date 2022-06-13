<?php
    session_start();

    // if (isset($_SESSION['uid'])){
    //     $uid = $_SESSION['uid'];
    // } else {
    //     // 沒有登入或沒有點選下單就到此頁面
    //     header('Location: login.php');
    // }

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
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- 共用CSS -->
    <link rel="stylesheet" href="styles/common.css">
    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@100;300;400;500;700;900&family=Noto+Serif+TC:wght@200;300;400;500;600;700;900&family=ZCOOL+QingKe+HuangYou&display=swap" rel="stylesheet">
    <title>屋件一覽</title>
    <link rel="stylesheet" href="styles/browsestyle.css">
    <link rel="icon" type="image/x-icon" href="public/logo.ico">

</head>
<body>

<?php require('require/header.php'); ?>

<section id="browse-section">



    <div class="container_parents">
    <div class="container_left">

    <form action="browse.php">
        <fieldset>
            <legend>有預算考量嗎？</legend>

            <div class="form-check">
            <input class="form-check-input" type="radio" id="500under" name="price" value="500under"
                    checked>
            <label class="form-check-label" for="500under">NT$500以下</label>
            </div>

            <div class="form-check">
            <input class="form-check-input" type="radio" id="500-1000" name="price" value="500-1000">
            <label class="form-check-label" for="500-1000">NT$500 - 1000</label>
            </div>

            <div class="form-check">
            <input class="form-check-input" type="radio" id="1000-2000" name="price" value="1000-2000">
            <label class="form-check-label" for="1000-2000">NT$1000 - 2000</label>
            </div>

            <div class="form-check">
            <input class="form-check-input" type="radio" id="2000-3000" name="price" value="2000-3000">
            <label class="form-check-label" for="2000-3000">NT$2000 - 3000</label>
            </div>

            <div class="form-check">
            <input class="form-check-input" type="radio" id="3000-4000" name="price" value="3000-4000">
            <label class="form-check-label" for="3000-4000">NT$3000 - 4000</label>
            </div>

            <div class="form-check">
            <input class="form-check-input" type="radio" id="4000-5000" name="price" value="4000-5000">
            <label class="form-check-label" for="4000-5000">NT$4000 - 5000</label>
            </div>

            <div class="form-check">
            <input class="form-check-input" type="radio" id="5000up" name="price" value="5000up">
            <label class="form-check-label" for="5000up">NT$5000以上</label>
            </div>
        </br>
            <div>
            <button type="submit" class="btn btn-outline-dark"> > </button>
            </div>
        </fieldset>
    </form>
    </div>


    <div class="container_mid">
        <div class="row row-cols-1 row-cols-md-4 g-4">
        <?php
        // 載入所有房型
        if (isset($_GET['price'])){

            $price=$_GET['price'];
            switch($price){
                case '500under':
                    $price_sql="SELECT * FROM house WHERE havailability = '1' AND hprice <= 500;";
                    $result=mysqli_query($link,$price_sql); //執行sql指令
                    break;
        
                case '500-1000':
                    $price_sql="SELECT * FROM house WHERE havailability = '1' AND hprice BETWEEN 500 AND 1000;";
                    $result=mysqli_query($link,$price_sql); //執行sql指令
                    // header("Location: browse.php");
                    break;
        
                case '1000-2000':
                    $price_sql="SELECT * FROM house WHERE havailability = '1' AND hprice BETWEEN 1000 AND 2000;";
                    $result=mysqli_query($link,$price_sql); //執行sql指令
                    // header("Location: browse.php");
                    break;
            
                case '2000-3000':
                    $price_sql="SELECT * FROM house WHERE havailability = '1' AND hprice BETWEEN 2000 AND 3000;";
                    $result=mysqli_query($link,$price_sql); //執行sql指令
                    // header("Location: browse.php");
                    break;
        
        
                case '3000-4000':
                    $price_sql="SELECT * FROM house WHERE havailability = '1' AND hprice BETWEEN 3000 AND 4000;";
                    $result=mysqli_query($link,$price_sql); //執行sql指令
                    // header("Location: browse.php");
                    break;
            
                case '4000-5000':
                    $price_sql="SELECT * FROM house WHERE havailability = '1' AND hprice BETWEEN 4000 AND 5000;";
                    $result=mysqli_query($link,$price_sql); //執行sql指令
                    // header("Location: browse.php");
                    break;
            
                case '5000up':
                    $price_sql="SELECT * FROM house WHERE havailability = '1' AND hprice >=5000;";
                    $result=mysqli_query($link,$price_sql); //執行sql指令
                    // header("Location: browse.php");
                    break;
        
            }
        } else {
            $houseTable = "SELECT * FROM house WHERE havailability = '1';";
            $result = mysqli_query($link, $houseTable);
        }


        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck > 0){
            // 資料庫內有這個帳號
            while ($row = mysqli_fetch_assoc($result)){

                $hid = $row['hid'];
                $hname = $row['hname'];
                $hdesc =  $row['hdesc'];
                $hprice = $row['hprice'];
                $havailability = $row['havailability'];
                $haddress = $row['haddress'];
                $hownerid = $row['howner'];
                $himglink = $row['himglink'];

                // 找屋主名字
                $howner = "SELECT * FROM user WHERE uid = $hownerid;";
                $hownerResult = mysqli_query($link, $howner);
                $hownerResultCheck = mysqli_num_rows($hownerResult);
                if ($hownerResultCheck > 0){
                    while ($row = mysqli_fetch_assoc($hownerResult)){
                        $hownerName = $row['username'];
                    }
                } else {
                    $hownerName = '';
                }
                

                // 把介紹文縮短一點，使用的語法是 ternary operator
                $truncDesc = (strlen($hdesc) > 40) ? substr($hdesc,0,37).'...' : $hdesc;
                // if ($havailability == '1'){
                ?>
                    <div class="col d-flex align-items-stretch">
                        <div class="card" style="width: 18rem;">
                            <img src=<?php echo empty($himglink) ? "https://picsum.photos/300/200" : "$himglink" ?> class="card-img-top" alt="房屋照片">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $hname ?></h5>
                                <div class="location">
                                    <img src="public/location.png" alt="location pin">
                                    <span class="card-text address"><?php echo empty($haddress) ? '台灣' : $haddress ?></span>
                                </div>
                                <div class="owner">
                                    <img src="public/user.png" alt="user icon">
                                    <span class="card-text"><?php echo empty($hownerName) ? '匿名' : $hownerName ?></span>
                                </div>
                                <p class="card-text"><?php echo $truncDesc ?></p>
                                <br>
                                &nbsp; 
                                <br>
                                <br>
                                <br>
                                <h3 class="hprice">$<?php echo $hprice ?> / 每晚</h3>
                                <form action="checkout.php" method="POST">
                                    <input type="hidden" name="hid" value=<?php echo $hid ?>>
                                    <input type="hidden" name="hname" value=<?php echo $hname ?>>
                                    <input type="hidden" name="hdesc" value=<?php echo $hdesc ?>>
                                    <input type="hidden" name="hprice" value=<?php echo $hprice ?>>
                                    <div class="orderbtn">
                                        <input type="submit" class="btn btn-dark" value="立馬訂購">
                                    </div>
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
        // 斷開SQL連接
        mysqli_close($link);
    
        ?>
        
        </div>
    </div>

    <div class='container_right'>
    </div>
    
    </div>
</section>
    
</body>

</html>