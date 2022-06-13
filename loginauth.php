<?php
    session_start();

    $inputAccount = $_POST['account'];
    $inputPassword = $_POST['password'];

    echo "post: $inputAccount, $inputPassword <br>";
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
        $sql = "SELECT *  FROM user WHERE account = '$inputAccount' AND password = '$inputPassword';";
        $result = mysqli_query($link, $sql);
        $resultCheck = mysqli_num_rows($result);

        if ($resultCheck > 0){
            // 資料庫內有這個帳號

            while ($row = mysqli_fetch_assoc($result)){

                $_SESSION['uid'] = $row['uid'];
                // header( "refresh:2;url=browse.php" );
                header('Location: browse.php');
            }
            
        } else {
            // 資料庫內沒有查到這個帳號
            // 所以將使用者重新導向回登入頁面
            // 有兩種方式：
            // 第一種：在網頁上寫
            // echo "<h1>登入失敗！ 5 秒後將你跳轉回登入畫面</h1>";

            // 第二種：用跳出式提醒
            $message = "帳號或密碼錯誤！";
            echo "<script type='text/javascript'>alert('$message');</script>";
            header( "refresh:0;url=login.php" );

        }
        // 釋放結果物件佔用的記憶體空間
        mysqli_free_result($result); 
        // 斷開SQL連接
        mysqli_close($link);
    }

?>