<?php
    session_start();

    $inputAccount = $_POST['account'];
    $inputPassword = $_POST['password'];
    $inputUsername = $_POST['username'];

    echo "預註冊帳號密碼: $inputAccount, $inputPassword <br>";
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
        echo "MySQL ram 資料庫連接成功<br>";

        // 檢查帳號是否有重複
        $sql = "SELECT *  FROM user WHERE account = '$inputAccount';";
        $result = mysqli_query($link, $sql);
        $resultCheck = mysqli_num_rows($result);

        if ($resultCheck > 0){
            // 註冊失敗，因為資料庫內有重複帳號
            $message = "這支帳號已經有註冊過！";
            echo "<script type='text/javascript'>alert('$message');</script>";
            header( "refresh:0;url=register.php" );

        } else {
            // 將這筆資料存進 MySQL
            $registration = "INSERT INTO user(account, password, username)
            VALUES ('$inputAccount', '$inputPassword', '$inputUsername')";
            mysqli_query($link, $registration);
            $last_id = $link->insert_id;
            $_SESSION['uid'] = $last_id;
            echo "last id is $last_id <br>";
            echo "<h1>註冊成功！重新導向到首頁⋯⋯</h1>";

            header( "refresh:3;url=home.php" );
        }
    }
?>