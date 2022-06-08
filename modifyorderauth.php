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
            
        } else {
            header('Location: login.php');
            exit();
        }
        $price = $_POST['price'];
        $hid = $_POST['hid'];
        $hname = $_POST['hname'];
        $hsm = $_POST['sm'];
        $hem = $_POST['em'];
        $hsd = $_POST['sd'];
        $hed = $_POST['ed'];

        $updateSql = "UPDATE house SET havailability = '0', hrenter = $uid, hsm = $hsm, hem = $hem, hsd = $hsd, hed = $hed WHERE house.hid = '$hid';";

        mysqli_query($link, $updateSql);

        // 釋放結果物件佔用的記憶體空間
        mysqli_free_result($result); 
        // 斷開SQL連接
        mysqli_close($link);

        $message = "訂單修改成功。";
        echo "<script type='text/javascript'>alert('$message');</script>";
        header( "refresh:0;url=listings.php" );

    }