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

        $hid = $_POST['hid'];
        $hname = $_POST['hname'];
        $updateSql = "UPDATE house SET havailability = '0' WHERE house.hid = '$hid';";
        mysqli_query($link, $updateSql);

        // 釋放結果物件佔用的記憶體空間
        mysqli_free_result($result); 
        // 斷開SQL連接
        mysqli_close($link);

        echo "<h1>感謝您在租隊友訂房！</h1>";
        echo "<h3>祝您在 $hname 有美好的體驗！</h2>";
        header( "refresh:2;url=home.php" );
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