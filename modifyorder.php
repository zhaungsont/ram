<?php
    session_start();

    if (isset($_SESSION['uid']) && (isset($_POST['hid']))){
        $user = $_SESSION['uid'];
    } else {
        // 沒有登入或沒有點選下單就到此頁面
        $message = "你沒有讀取此網站的權限。";
        echo "<script type='text/javascript'>alert('$message');</script>";
        header( "refresh:0;url=login.php" );
    }

    // 連線 MySQL
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


        // 載入使用者欲下單的房型（沒辦法直接用表單傳，PHP POST 有資料乘載上限）
        $hid = $_POST['hid'];
        $houseTable = "SELECT * FROM house WHERE hid = '$hid';";
        $result = mysqli_query($link, $houseTable);
        $resultCheck = mysqli_num_rows($result);

        if ($resultCheck > 0){
            while ($row = mysqli_fetch_assoc($result)){
                $hname = $row['hname'];
                $hdesc =  $row['hdesc'];
                $hprice = $row['hprice'];
                $havailability = $row['havailability'];
                $himglink = $row['himglink'];

                $fee = (int)($hprice * 0.1);
                $actualprice = $hprice + $fee;
                // echo $fee."<br>".$actualprice;
            }
        } else {
            echo "錯誤";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- jQUERY -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- 共用CSS -->
    <link rel="stylesheet" href="styles/common.css">
    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@100;300;400;500;700;900&family=Noto+Serif+TC:wght@200;300;400;500;600;700;900&family=ZCOOL+QingKe+HuangYou&display=swap" rel="stylesheet">
    <title>Checkout</title>
    <link rel="stylesheet" href="styles/checkoutstyle.css">
    <link rel="icon" type="image/x-icon" href="public/logo.ico">

</head>
<body>
<?php require('require/header.php'); ?>

    <section id="checkout-section">
        <h1>修改您的訂單</h1>
        <div class="cwrapper">
            <div class="lwrap">
                <h2><?php echo $hname ?></h2>
                <!-- <h3>訂購人：<?php echo $username ?></h3> -->
                <img src=<?php echo empty($himglink) ? "https://picsum.photos/300/200" : "$himglink" ?> alt="房屋照片">
                <!-- <h2>訂單資訊</h2> -->
            </div>
            <div class="rwrap">
                <h4>屋件簡介</h4>
                <p><?php echo $hdesc ?></p>

                <hr>

                <div class="sum">
                    <h4>每日售價</h4>
                    <h4><?php echo $hprice ?> 元</h4>
                </div>
                <div>
                    
                </div>
                <div class="sum">
                    <h4>加收一成服務費</h4>
                    <h4><?php echo $fee ?> 元</h4>
                </div>
                <div class="sum">
                    <h4>每日總金額</h4>
                    <h4 id="phpActualPrice"><?php echo $actualprice ?> 元</h4>
                </div>

                <form action="modifyorderauth.php" method="POST">
                <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-sm">入住時間</span>
                        <select class="form-select" name="sm" required>
                            <option value="" selected disabled>入住月份</option>
                            <option value="1">1月</option>
                            <option value="2">2月</option>
                            <option value="3">3月</option>
                            <option value="4">4月</option>
                            <option value="5">5月</option>
                            <option value="6">6月</option>
                            <option value="7">7月</option>
                            <option value="8">8月</option>
                            <option value="9">9月</option>
                            <option value="10">10月</option>
                            <option value="11">11月</option>
                            <option value="12">12月</option>
                        </select>
                        <select class="form-select" name="sd" required>
                            <option value="" selected disabled>入住日期</option>
                            <option value="1">1日</option>
                            <option value="2">2日</option>
                            <option value="3">3日</option>
                            <option value="4">4日</option>
                            <option value="5">5日</option>
                            <option value="6">6日</option>
                            <option value="7">7日</option>
                            <option value="8">8日</option>
                            <option value="9">9日</option>
                            <option value="10">10日</option>
                            <option value="11">11日</option>
                            <option value="12">12日</option>
                            <option value="13">13日</option>
                            <option value="14">14日</option>
                            <option value="15">15日</option>
                            <option value="16">16日</option>
                            <option value="17">17日</option>
                            <option value="18">18日</option>
                            <option value="19">19日</option>
                            <option value="20">20日</option>
                            <option value="21">21日</option>
                            <option value="22">22日</option>
                            <option value="23">23日</option>
                            <option value="24">24日</option>
                            <option value="25">25日</option>
                            <option value="26">26日</option>
                            <option value="27">27日</option>
                            <option value="28">28日</option>
                            <option value="29">29日</option>
                            <option value="30">30日</option>
                        </select>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-sm">退房時間</span>
                        <select class="form-select" name="em" required>
                            <option value="" selected disabled>退房月份</option>
                            <option value="1">1月</option>
                            <option value="2">2月</option>
                            <option value="3">3月</option>
                            <option value="4">4月</option>
                            <option value="5">5月</option>
                            <option value="6">6月</option>
                            <option value="7">7月</option>
                            <option value="8">8月</option>
                            <option value="9">9月</option>
                            <option value="10">10月</option>
                            <option value="11">11月</option>
                            <option value="12">12月</option>
                        </select>
                        <select class="form-select" name="ed" required>
                            <option value="" selected disabled>退房日期</option>
                            <option value="1">1日</option>
                            <option value="2">2日</option>
                            <option value="3">3日</option>
                            <option value="4">4日</option>
                            <option value="5">5日</option>
                            <option value="6">6日</option>
                            <option value="7">7日</option>
                            <option value="8">8日</option>
                            <option value="9">9日</option>
                            <option value="10">10日</option>
                            <option value="11">11日</option>
                            <option value="12">12日</option>
                            <option value="13">13日</option>
                            <option value="14">14日</option>
                            <option value="15">15日</option>
                            <option value="16">16日</option>
                            <option value="17">17日</option>
                            <option value="18">18日</option>
                            <option value="19">19日</option>
                            <option value="20">20日</option>
                            <option value="21">21日</option>
                            <option value="22">22日</option>
                            <option value="23">23日</option>
                            <option value="24">24日</option>
                            <option value="25">25日</option>
                            <option value="26">26日</option>
                            <option value="27">27日</option>
                            <option value="28">28日</option>
                            <option value="29">29日</option>
                            <option value="30">30日</option>
                        </select>
                    </div>
                    <div class="inpflex">
                        <h4>入住&nbsp;</h4>
                        <div class="inpflexflex">
                            <h4 id="precalc"></h4>
                            <h4>&nbsp;日</h4>
                        </div>
                    </div>

                    <hr>

                <div class="sum">
                    <h3>總金額</h3>
                    <h3 id="pricePreview">元</h3>
                </div>
                <br>

                <!-- <input type="text" class="form-control form-control-lg" name=""> -->
                
                <input type="hidden" name="hid" value=<?php echo $hid ?>>
                <input type="hidden" name="hname" value=<?php echo $hname ?>>
                <input type="hidden" name="price" id="submitPrice">
                <div class="d-grid gap-2 col-20 mx-auto">
                    <button type="submit" class="btn btn-dark btn-lg orderbtn">訂房</button>
                </div>
                </form>
            </div>
        </div>
    </section>
</body>

</html>

<script>
    let sm = undefined;
    let em = undefined;
    let sd = undefined;
    let ed = undefined;

    $("select[name='sm']").on("change", function() {
        sm = Number(this.value); 

        if (sm != undefined && em != undefined && sm > em){
            alert('入住月份不得晚於退房月份！');
        }

        if (sd != undefined && ed != undefined && sm == em && sd > ed){
            alert('入住日期不得晚於退房日期！');
        }

        if (sm != undefined && em != undefined && sd != undefined && ed != undefined){
            calcDays();
        }
    });
    $("select[name='em']").on("change", function() {
        em = Number(this.value); 
        if (sm != undefined && em != undefined && sm > em){
            alert('入住月份不得晚於退房月份！');
        }
        if (sd != undefined && ed != undefined && sm == em && sd > ed){
            alert('入住日期不得晚於退房日期！');
        }

        if (sm != undefined && em != undefined && sd != undefined && ed != undefined){
            calcDays();
        }
    });
    $("select[name='sd']").on("change", function() {
        sd = Number(this.value); 

        if (sm != undefined && em != undefined){
            if (ed != undefined && sm == em){
                if (sd > ed){
                    alert('入住日期不得晚於退房日期！');
                }
            }
        }

        if (sm != undefined && em != undefined && sd != undefined && ed != undefined){
            calcDays();
        }
    });
    $("select[name='ed']").on("change", function() {
        ed = Number(this.value); 

        if (sm != undefined && em != undefined){
            if (sd != undefined && sm == em){
                if (sd > ed){
                    alert('入住日期不得晚於退房日期！');
                }
            }
        }

        if (sm != undefined && em != undefined && sd != undefined && ed != undefined){
            calcDays();
        }
    });

function calcDays(){
    if (sm == em){
        // let val = ed - sd == 0 ? '0' : ed - sd;
        let val = ed - sd + 1;
        $('#precalc').text(val);

        let price = Number($('#phpActualPrice').text().replace('元',''));
        let pricePreview = price * val;

        $('#pricePreview').text(pricePreview + " 元");
        $('#submitPrice').val(pricePreview);
    }
    else {
        smLeft = 30 - sd;
        monthSpan = (em - sm - 1) * 30;
        let val = (smLeft + monthSpan + ed + 1)==0 ? '0' : smLeft + monthSpan + ed + 1;
        $('#precalc').text(val);

        let price = Number($('#phpActualPrice').text().replace('元',''));
        let pricePreview = price * val;

        $('#pricePreview').text(pricePreview + " 元");
        $('#submitPrice').val(pricePreview);
    }
}
</script>