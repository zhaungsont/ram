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
    // 檢查使用者資料有沒有亂輸
    $hname = $_POST['hname'];
    $hdesc = $_POST['hdesc'];
    $hprice = $_POST['hprice'];
    $haddress = $_POST['haddress'];
    $himglink = $_POST['himglink'];
    $uid = $_POST['uid'];
    $hid = $_POST['hid'];
    if (!is_numeric($hprice)){
        $message = "售價欄位請輸入純數字內容！";
        echo "<script type='text/javascript'>alert('$message');</script>";
        header( "refresh:0;url=listing.php" );
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

    if (!$link) {
        echo "MySQL 連線錯誤<br>";
        exit();
    } else {
        // 將這筆資料存進 MySQL
        $creation = 'UPDATE house SET hname = "'.$hname.'", hdesc = "'.$hdesc.'", hprice = "'.$hprice.'", haddress = "'.$haddress.'", himglink = "'.$himglink.'" WHERE house.hid = '.$hid.';';
        $results = mysqli_query($link, $creation);
        if ($results){
            $message = "您的刊登屋件資料已更新。";
            echo "<script type='text/javascript'>alert('$message');</script>";
            header( "refresh:0;url=listings.php" );
        } else {
            echo mysqli_error($link);
        }
    }
    // 釋放結果物件佔用的記憶體空間
    mysqli_free_result($result); 
    // 斷開SQL連接
    mysqli_close($link);
    ?>