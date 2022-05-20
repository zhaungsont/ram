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
        echo "MySQL ram 資料庫連接成功<br>";
        // $sql = "SELECT * FROM user;";
        $sql = "SELECT *  FROM `user` WHERE `account` = \'zhsont\' AND `pw` = \'1234\';";
        $result = mysqli_query($link, $sql);
        var_dump($result);
        $resultCheck = mysqli_num_rows($result);

        if ($resultCheck > 0){
            while ($row = mysqli_fetch_assoc($result)){
                echo $row['uid']."<br>";
                echo $row['name']."<br>";
                echo $row['account']."<br>";
                echo $row['pw']."<br>";
            }
        } else {

            echo "aa<br>";
        }
    }

?>