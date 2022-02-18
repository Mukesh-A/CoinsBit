<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="deposite.css">
    <link rel="stylesheet" href="navbar.css">
</head>

<body>
    <!-- <div class="nacolor"> -->
    <?php include('navbar.php'); ?>

    <!-- </div> -->


    <?php
    // session_start();
    if (!isset($_SESSION["email"])) {

        header("Location: login.php");
    }
    ?>


    <div class="container">
        <div class="headnav">
            <label id="withdraw" onclick="change()" value="WITHDRAW">WITHDRWAL</label>
            <div class="vl"></div>
            <label id="deposite" onclick="reverse()" value="DEPOSIT">DEPOSITE</label>
        </div>
        <?php
        $email = $_SESSION['email'];


        $conn = mysqli_connect("localhost", "root", "") or die("couldnt connect");
        mysqli_select_db($conn, "crypto") or die("couldnt find the db");
        $query = "SELECT * FROM bank WHERE email = '$email'";
        $result = mysqli_query($conn, $query);

        // if(mysqli_num_rows($result)>0){
        while ($row = mysqli_fetch_array($result)) {


            $cardnumbers = $row['cardnumber'];
            // $roomtype = $row['roomtype'];

        }
        ?>
        <form action=" deposite.php" method="post">
            <div class="card">
                <div class="card1">
                    <input type="text" class="cardnumber" id="cardnumber" required name="cardnumber" value="<?php global $cardnumbers;
                                                                                                            echo $cardnumbers; ?>" placeholder="CARD NUMBER" maxlength="16" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                </div>
                <div id="card2" class="card2">
                    <input type="text" class="monthyear" name="monthyear" placeholder="MM / YY" maxlength="4" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                    <input type="text" class="cvv" name="cvv" placeholder="CVV" maxlength="3" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                </div>
                <div id="card3" class="card3">
                    <input type="text" class="cardname" name="cardname" placeholder="CARD HOLDER'S NAME">
                </div>
            </div>
            <div id="rsbox">
                <p class="amount">ENTER AMOUNT</P>
                <input type="text" class="buyrate" id="buyrate" name="buyrate">
                <!-- <p class="calculatedvalue">$100</P> -->
                <lable id="usdname">USD</lable><input type="text" class="calculatedvalue" id="calculatedvalue" name="calculatedvalue" readonly>
            </div>
            <input type="submit" class="sub" id="sub" name="sub" value="SUBMIT">
        </form>

        <?php
        if (isset($_POST['sub'])) {
            if ($_POST['sub'] == "SUBMIT") {

                $email = $_SESSION['email'];
                $con = mysqli_connect('localhost', 'root', '');
                mysqli_select_db($con, 'crypto') or die("couldnt find the db");
                $cardnumber = $_POST['cardnumber'];
                $monthyear = $_POST['monthyear'];
                $cvv = $_POST['cvv'];
                $cardname = $_POST['cardname'];
                $query1 = "insert into bank(email, cardnumber, monthyear, cvv, cardname) values('$email','$cardnumber','$monthyear','$cvv','$cardname')";

                $result = mysqli_query($con, $query1);
                if ($result) {

                    echo '<script type="text/javascript">alert("Successfully Added")</script>';
                    header("Refresh:0");
                } else {
                    echo '<script type="text/javascript">alert("sorry")</script>';
                }
            } else if ($_POST['sub'] == "withdraw") {
                $conn = mysqli_connect("localhost", "root", "") or die("couldnt connect");
                mysqli_select_db($conn, "crypto") or die("couldnt find the db");
                $sellrate = $_POST['buyrate'];
                $email = $_SESSION['email'];
                $withdraw = "update portfolio set totalcoin = totalcoin - '$sellrate'  WHERE coinname = 'USD' and custname = '$email'";
                $resultss1 = mysqli_query($conn, $withdraw);

                if ($resultss1) {
                    echo '<script type="text/javascript">alert("Withdrawed")</script>';
                }
            } else {



                // if(isset($_POST['sub']))
                // {
                date_default_timezone_set('Asia/Kolkata');
                $dbdate = date('d-m-Y g:i a');
                $emails = $_SESSION['email'];
                $cons = mysqli_connect('localhost', 'root', '');
                mysqli_select_db($cons, 'crypto') or die("couldnt find the db");
                $buyrate = $_POST['buyrate'];
                $calculatedvalue = $_POST['calculatedvalue'];

                $url = "https://min-api.cryptocompare.com/data/pricemultifull?fsyms=USD&tsyms=INR";
                $jsons = file_get_contents($url);
                $json_data = json_decode($jsons, true);
                $final = $json_data['RAW']['USD']['INR']['PRICE'];

                $query11 = "insert into trading(custname, coinname, coinprice, coinbought, inputamount, datetime, buysell) values('$emails','USD','$final','$calculatedvalue','$buyrate','$dbdate','buy')";
                $result1 = mysqli_query($cons, $query11);

                $sample = "select * from portfolio where custname = '$emails' and coinname = 'USD'";
                $sresult = mysqli_query($cons, $sample);
                $num = mysqli_num_rows($sresult);

                if ($num == 1) {
                    $samplefinel = "update portfolio set totalcoin = totalcoin + '$calculatedvalue'  WHERE coinname = 'USD' and custname = '$emails'";
                    $resultss = mysqli_query($cons, $samplefinel);
                    // echo '<script type="text/javascript">alert("bought")</script>';
                } else {
                    $query2 = "insert into portfolio(custname, coinname, totalcoin) values('$emails','USD',$calculatedvalue)";
                    $resultss = mysqli_query($cons, $query2);
                    // echo '<script type="text/javascript">alert("bought")</script>';
                }
                echo "<script>
                     alert('successfully Added');
                     window.location.href='home.php';
                     </script>";


                // if ($result1 && $resultss) {

                //     echo "<script>
                //     alert('successfully Added');
                //     window.location.href='home.php';
                //     </script>";
                // } else {
                //     echo '<script type="text/javascript">alert("sorry")</script>';
                // }
            }
        }


        ?>
    </div>
    <script>
        if (document.getElementById("cardnumber").value == "") {
            document.getElementById("sub").value = "SUBMIT"
            document.getElementById("rsbox").style.display = "none"



        } else {
            document.getElementById("sub").value = "deposite"
            document.getElementById("card2").style.display = "none"
            document.getElementById("card3").style.display = "none"
        }

        function change() {
            document.getElementById("sub").value = "withdraw"
            document.getElementById("calculatedvalue").style.display = "none"
            document.getElementById("usdname").style.display = "none"
        }

        function reverse() {
            document.getElementById("sub").value = "deposite"
            document.getElementById("calculatedvalue").style.display = "block"
            document.getElementById("usdname").style.display = ""
        }

        function muki() {
            var i;

            request('GET', 'https://min-api.cryptocompare.com/data/pricemultifull?fsyms=USD&tsyms=INR')
                .then((r1) => {

                    var x1 = JSON.parse(r1.target.responseText);
                    var myBox1 = x1['RAW']['USD']['INR']['PRICE']
                    var myBox2 = document.getElementById('buyrate').value;
                    var myResult = myBox2 / myBox1;

                    document.getElementById('calculatedvalue').value = parseFloat(myResult).toFixed(4);

                })

            function request(method, url) {
                return new Promise(function(resolve, reject) {
                    var xhr = new XMLHttpRequest();
                    xhr.open(method, url);
                    xhr.onload = resolve;
                    xhr.onerror = reject;
                    xhr.send();
                });
            }
        }
        muki()
        setInterval(muki, 1000)
    </script>


</body>

</html>