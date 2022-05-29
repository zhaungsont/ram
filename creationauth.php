<?php

session_start();

// 防止惡意進入這個 url
if (!isset($_SESSION['uid'])){
    header('Location: login.php');
} elseif (!isset($_POST['hname'])){
    header('Location: createlisting.php');
}

// 檢查使用者資料有沒有亂輸
    $hname = $_POST['hname'];
    $hdesc = $_POST['hdesc'];
    $hprice = $_POST['hprice'];
    $haddress = $_POST['haddress'];
    $himglink = $_POST['himglink'];
    $uid = $_POST['uid'];
    if (!is_numeric($hprice)){
        $message = "售價欄位請輸入純數字內容！";
        echo "<script type='text/javascript'>alert('$message');</script>";
        header( "refresh:0;url=createlisting.php" );
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
} else {
    // 將這筆資料存進 MySQL
    $creation = 'INSERT INTO house(hname, hdesc, hprice, havailability, haddress, howner, hrenter, himglink) 
    VALUES ("'.$hname.'", "'.$hdesc.'", "'.$hprice.'", "1","'.$haddress.'", '.(int)$uid.', 0,"'.$himglink.'");';
    $results = mysqli_query($link, $creation);
    if ($results){
        $message = "恭喜！刊登成功🎉 您現在可以在個人頁面檢視您的屋件。";
        echo "<script type='text/javascript'>alert('$message');</script>";
        header( "refresh:0;url=listings.php" );
    } else {
        echo mysqli_error($link);
    }
}

// 斷開SQL連線
mysqli_close($link);
// You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 's Cheeseburger', 'It's a beeg ass yoshi', '48763', '1')' at line 2

?>
