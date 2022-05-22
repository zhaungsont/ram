<?php
    session_start();

    $inputAccount = $_POST['account'];
    $inputPassword = $_POST['password'];
    $inputUsername = $_POST['username'];

    // ＝＝＝＝＝＝＝＝還沒研究完的上傳圖像＝＝＝＝＝＝＝＝
    // if (isset($_FILES['pfp'])){
    //     echo "1<br>";
    //     $pfpname = $_FILES['pfp']['name'];
    //     $pfptmpname = $_FILES['pfp']['tmp_name'];
    //     $pfpsize = $_FILES['pfp']['size'];
    //     $pfptype = $_FILES['pfp']['type'];
    //     $pfperror = $_FILES['pfp']['error'];
        
    //     $fileExt = explode('.', $pfpname);
    //     $fileActualExt = strtolower(end($fileExt));

    //     $allowed = array('jpg', 'jpeg', 'png');
    //     echo "2<br>";
    //     if (in_array($fileActualExt, $allowed)){
    //         echo "3<br>";
    //         // valid file type
    //         if ($pfperror === 0){
    //             echo "5<br>";
    //             if ($pfpsize < 200000){
    //                 echo "7<br>";
    //                 // give each uploaded file a unique name
    //                 $newpfpname = uniqid('', true).".".$fileActualExt;
    //                 $pfpDestination = "uploads/".$newpfpname;
    //                 move_uploaded_file($pfptmpname, $pfpDestination);
    //                 echo "upload success";
    //             }
    //         } else {
    //             echo "6<br>";
    //             $message = "上傳失敗，請再試一次！";
    //             echo "<script type='text/javascript'>alert('$message');</script>";
    //             header( "refresh:1;url=register.php" );
    //         }
    //     } else {
    //         echo "4<br>";
    //         // invalid file type
    //         $message = "只接受 .jpg、.jpeg、.png 檔案！";
    //         echo "<script type='text/javascript'>alert('$message');</script>";
    //         header( "refresh:1;url=register.php" );
    //     }

    // }

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


            header( "refresh:2;url=browse.php" );
        }
        // 釋放結果物件佔用的記憶體空間
        mysqli_free_result($result); 
        // 斷開SQL連線
        mysqli_close($link);
    }
?>