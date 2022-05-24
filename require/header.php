<?php

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
        
    }
?>

<section id="header">
        <div class="flex-wrap">
            <div class="fleft">
                <a href="home.php"><img class="logo" src="public/home.png" alt="go home"></a>
                <span><a href="home.php">租隊友 Rent-A-Mate</a></span>
            </div>

            <div class="fright">
                <?php
                if (isset($_SESSION['uid'])){
                ?>

                <div class="listing">
                    <a href="createlisting.php"><img class="logo" src="public/upload.png" alt="upload new listing"></a>
                    <span><a href="createlisting.php">刊登物件</a></span> 
                </div>

                <div class="user">
                    <img  class="logo" src="public/user.png" alt="user profile photo">
                    <span><?php echo $username ?></span>
                </div>

                <form action="logout.php" method="POST">
                    <div class="logout">
                    <button type="submit" class="btn btn-outline-light btn-lg">登出</button>
                    </div>
                </form>

                <?php
                } else {
                ?>
                <div>
                    <a href="login.php" class="btn btn-outline-light btn-lg">登入</a>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
    </section>