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
        $price = $_POST['price'];

        $hid = $_POST['hid'];
        $hname = $_POST['hname'];
        $updateSql = "UPDATE house SET havailability = '0', hrenter = ".(int)$uid." WHERE house.hid = '$hid';";
        mysqli_query($link, $updateSql);

        // 釋放結果物件佔用的記憶體空間
        mysqli_free_result($result); 
        // 斷開SQL連接
        mysqli_close($link);

        $message = "恭喜！訂房成功🎉 您現在可以在個人頁面檢視您的屋件。";
        echo "<script type='text/javascript'>alert('$message');</script>";
        header( "refresh:0;url=listings.php" );
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- 共用CSS -->
    <link rel="stylesheet" href="styles/common.css">
    <title>Success</title>
</head>
<body>
    
</body>
</html>