<?php
session_start();

if (isset($_SESSION['uid']) && $_SESSION['uid'] == $_POST['uid']){
    $uid = $_SESSION['uid'];
    $hid = $_POST['hid'];
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

$sql = "DELETE FROM house WHERE hid=$hid";
if (mysqli_query($link, $sql)) {
    // success
    $message = "刪除成功。";
    echo "<script type='text/javascript'>alert('$message');</script>";
    header( "refresh:0;url=listings.php" );
  } else {
    echo "<h1>Oops...</h2>";
    echo "Error deleting record: " . $link->error;
    header( "refresh:2;url=listings.php" );
  }
?>