<?php
session_start();
if ($_SESSION['uid'] != $_POST['uid']){
    header('Location: listings.php');
    exit();
}
if (!isset($_SESSION['upw'])){
    header('Location: listings.php');
    exit();
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
$uid = $_SESSION['uid'];
$personalInfo = "SELECT * FROM user WHERE uid = $uid;";
    $result = mysqli_query($link, $personalInfo);
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck > 0){
        while ($row = mysqli_fetch_assoc($result)){
            $account = $row['account'];
            $username = $row['username'];
            $password = $row['password'];
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
    
    <link rel="stylesheet" href="styles/editperson.css">
    <link rel="icon" type="image/x-icon" href="public/logo.ico">
    <title>更改個資</title>
</head>
<body>
<?php require('require/header.php'); ?>

<section id="edit-section">
    <h1>更改個人資訊</h1>
    <div class="form">
        <form action="editpersonauth.php" method="POST">
            <h3>姓名</h3>
            <input type="text" class="form-control" name="username" value=<?php echo $username ?> required> 
            <h3>帳號</h3>
            <input type="email" class="form-control" name="account" value=<?php echo $account ?> required>
            <h3>帳號</h3>
            <input type="password" class="form-control" name="password" value=<?php echo $password ?> required>

            <br>
            <div class="form-buttons">
                <input type="submit" class="btn btn-danger" value="確認更改">
                <a href="listings.php" class="btn btn-dark">取消修改</a>
            </div>
        </form>
        <div class="valid-desc">
            <p>帳號需為電子郵件形式（包含 <code>@</code> 與 <code>.</code> ）</p>
            <p>密碼長度須介於 5~20 字元，需至少包含一個大寫英文字母、一個小寫英文字母，以及一個數字。</p>
            <strong style="color: red; ">切勿輸入真實帳號資訊！本網站為練習用網站，沒有資安防護措施。你輸入的資訊「會」上傳到雲端伺服器上！</strong>
        </div>
    </div>
</section>
</body>
</html>

