<?php
    session_start();

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
                <img src="https://picsum.photos/100" alt="">
                <span>Rent-A-Mate</span>
            </div>

            <div class="fright">
                <?php
                if (isset($_SESSION['uid'])){
                ?>

                <div class="listing">
                    <img src="https://picsum.photos/100" alt="">
                    <span>刊登物件</span>
                </div>
                <div class="user">
                    <span><?php echo $username ?></span>
                    <img src="https://picsum.photos/100" alt="">
                </div>
                <form action="logout.php" method="POST">
                    <div class="logout">
                    <button type="submit" class="btn btn-dark btn-lg">登出</button>
                    </div>
                </form>

                <?php
                } else {
                ?>
                <div>
                    <a href="login.php" class="btn btn-dark btn-lg">登入</a>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
    </section>