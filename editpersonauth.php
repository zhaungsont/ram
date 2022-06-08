<?php
session_start();

// 檢查使用者是否無權進入
if (!isset($_SESSION['uid'])){
    $message = "你沒有參訪此頁面的權限。";
    echo "<script type='text/javascript'>alert('$message');</script>";
    header( "refresh:0;url=listings.php" );
    exit();
} else {
    $uid = $_SESSION['uid'];
}

if (!isset($_POST['username']) || !isset($_POST['account']) || !isset($_POST['password'])){
    $message = "你沒有參訪此頁面的權限。";
    echo "<script type='text/javascript'>alert('$message');</script>";
    header( "refresh:0;url=listings.php" );
    exit();
} else {
    $newUserName = $_POST['username'];
    $newAccount = $_POST['account'];
    $newPassword = $_POST['password'];
}

// 檢查是否輸入不符規定

// 密碼規定：長度 5-20 字元為限，至少包含一大寫英文、一小寫英文、一數字
$isnumeric = false;
$isupper = false;
$islower = false;
$pwarray = str_split($newPassword);
if (strlen($newPassword) < 4 || strlen($newPassword) > 20){
    $message = "更改失敗：密碼長度以5到20字元為限。";
    echo "<script type='text/javascript'>alert('$message');</script>";
    header( "refresh:0;url=listings.php" );
    exit();
}
foreach ($pwarray as $char) {
    if (ctype_upper($char)){
        $isupper = true;
    }
    if (ctype_lower($char)){
        $islower = true;
    }
    if (is_numeric($char)){
        $isnumeric = true;
    }
}
if (!$isupper || !$islower || !$isnumeric){
    $message = "更改失敗：密碼需至少包含數字和英文大小寫各一字元。";
    echo "<script type='text/javascript'>alert('$message');</script>";
    header( "refresh:0;url=listings.php" );
    exit();
}


// 驗證完畢，開始連線資料庫修改資料
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
    $updateSql = "UPDATE user SET account = '$newAccount', password = '$newPassword', username = '$newUserName' WHERE user.uid = $uid;";
    mysqli_query($link, $updateSql);

    // 斷開SQL連接
    mysqli_close($link);

    $message = "個人資料更新成功！";
    echo "<script type='text/javascript'>alert('$message');</script>";
    header( "refresh:0; url=listings.php" );
}
