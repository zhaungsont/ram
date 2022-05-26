<?php
session_start();

if (isset($_SESSION['uid']) && isset($_POST['hid'])){
    $uid = $_SESSION['uid'];
    $hid = $_POST['hid'];

    // echo "uid $uid<br>";
    // echo "hid $hid";

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
} else {

    $updateSql = "UPDATE house SET havailability = '1', hrenter = '0' WHERE house.hid = ".(int)$hid.";";
    mysqli_query($link, $updateSql);

    // 斷開SQL連接
    mysqli_close($link);

    $message = "已退訂該屋件。";
    echo "<script type='text/javascript'>alert('$message');</script>";
    header( "refresh:0; url=listings.php" );
}
?>