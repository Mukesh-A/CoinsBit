<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="chart1.css">
</head>

<body>



    <?php
    session_start();
    if (!isset($_SESSION["email"])) {

        header("Location: login.php");
    }
    ?>

    <?php



    if (isset($_POST['bought'])) {
        $email = $_SESSION['email'];
        // echo $email;
        $con = mysqli_connect('localhost', 'root', '');
        mysqli_select_db($con, 'crypto') or die("couldnt find the db");
        $query12 = "SELECT aadhar,pancard FROM users WHERE email = '$email'";
        $query13 = "SELECT SUM(coinbought) AS total FROM trading WHERE custname = '$email' and coinname = 'USD'";

        $result12 = mysqli_query($con, $query12);
        $result13 = mysqli_query($con, $query13);

        $row12 = mysqli_fetch_array($result12);
        $row13 = mysqli_fetch_array($result13);

        $aadharexist = $row12['aadhar'];
        $pancardexist = $row12['pancard'];

        echo $row13['total'];

        if ($row13['total'] <= 0) {
            header("Location: deposite.php");
        } elseif ($aadharexist == "") {
            header("Location: profile.php");
        } elseif ($pancardexist == "") {
            header("Location: profile.php");
        } else {
            date_default_timezone_set('Asia/Kolkata');
            $dbdate = date('d-m-Y g:i a');
            $dbprice = $_POST['cp'];
            $dbcoinname = $_POST['displaycoinname'];
            $dbinputvalue = $_POST['inputvalue'];
            $dbcalvalue = $_POST['calvalue'];
            $buysell = $_POST['buysell'];
            echo $dbprice;


            $inputcoinname = $_POST['inputcoinname'];



            if ($_POST['bought'] == "BUY") {

                // $validation_not_avail = $_POST['avlbal'];
                // if ($validation_not_avail == "Not Available") {
                //     echo '<script type="text/javascript">alert("BUY Limit Failed")</script>';
                // } else {

                // $query1 = "insert into trading(custname, coinname, coinprice, coinbought, inputamount, datetime, buysell) values('$email','$dbcoinname','$dbprice','$dbcalvalue','$dbinputvalue','$dbdate','$buysell')";
                // $result = mysqli_query($con, $query1);
                $query1 = "update portfolio set totalcoin = totalcoin - '$dbinputvalue' WHERE coinname = 'USD' and custname = '$email'";
                $result1 = mysqli_query($con, $query1);

                $query2 = "select * from portfolio where custname = '$email' and coinname = '$dbcoinname'";
                $result2 = mysqli_query($con, $query2);
                $num = mysqli_num_rows($result2);

                if ($num == 1) {
                    $query3 = "update portfolio set totalcoin = totalcoin + '$dbcalvalue'  WHERE coinname = '$dbcoinname' and custname = '$email'";
                    $result3 = mysqli_query($con, $query3);

                    $query4 = "insert into trading(custname, coinname, coinprice, coinbought, inputamount, datetime, buysell) values('$email','$dbcoinname','$dbprice','$dbcalvalue','$dbinputvalue','$dbdate','$buysell')";
                    $result4 = mysqli_query($con, $query4);
                    // echo '<script type="text/javascript">alert("bought")</script>';
                } else {
                    $query5 = "insert into portfolio(custname, coinname, totalcoin) values('$email','$dbcoinname',$dbcalvalue)";
                    $result5 = mysqli_query($con, $query5);

                    $query5b = "insert into trading(custname, coinname, coinprice, coinbought, inputamount, datetime, buysell) values('$email','$dbcoinname','$dbprice','$dbcalvalue','$dbinputvalue','$dbdate','$buysell')";
                    $result5b = mysqli_query($con, $query5b);
                    // echo '<script type="text/javascript">alert("bought")</script>';
                }

                echo "<script>
            alert('Coin Bought');
            window.location.href='chart.php?q=$dbcoinname';
            </script>";
            } else {
                // echo $email;
                // echo $inputcoinname;
                // echo $dbcalvalue;
                // $query1 = "insert into trading(custname, coinname, coinprice, coinbought, inputamount, datetime, buysell) values('$email','$inputcoinname','$dbprice','$dbcalvalue','$dbinputvalue','$dbdate','$buysell')";
                // $query2 = "insert into portfolio(custname, coinname, totalcoin) values('$email','$inputcoinname',$dbcalvalue)ON DUPLICATE KEY UPDATE totalcoin = totalcoin - $dbcalvalue";

                // $result = mysqli_query($con, $query1);
                // $resultss = mysqli_query($con, $query2);
                // if ($resultss && $result) {

                //     echo '<script type="text/javascript">alert("bought")</script>';
                //     // header("Location: chart.php?q=" . $dbcoinname);
                // } else {
                //     echo '<script type="text/javascript">alert("sorry")</script>';
                // }




                $query6 = "select * from portfolio where custname = '$email' and coinname = '$inputcoinname'";
                $result6 = mysqli_query($con, $query6);
                $nums = mysqli_num_rows($result6);

                if ($nums == 1) {
                    $validation_not_avail = $_POST['calvalue'];
                    if ($validation_not_avail == "Not Available") {
                        echo '<script type="text/javascript">alert("SELL Limit Failed")</script>';
                    } else {
                        $query7 = "update portfolio set totalcoin = totalcoin - '$dbinputvalue'  WHERE coinname = '$inputcoinname' and custname = '$email'";
                        $result7 = mysqli_query($con, $query7);

                        $query7a = "update portfolio set totalcoin = totalcoin + '$dbprice'  WHERE coinname = 'USD' and custname = '$email'";
                        $result7a = mysqli_query($con, $query7a);

                        $query7b = "insert into trading(custname, coinname, coinprice, coinbought, inputamount, datetime, buysell) values('$email','$inputcoinname','$dbprice','$dbcalvalue','$dbinputvalue','$dbdate','$buysell')";
                        $result7b = mysqli_query($con, $query7b);


                        echo "<script>
                    alert('Coin Sold');
                    window.location.href='chart.php?q=$dbcoinname';
                    </script>";
                    }
                }
                // $query8 = "insert into trading(custname, coinname, coinprice, coinbought, inputamount, datetime, buysell) values('$email','$inputcoinname','$dbprice','$dbcalvalue','$dbinputvalue','$dbdate','$buysell')";
                // $result8 = mysqli_query($con, $query8);


                // $validation_not_avail = $_POST['calvalue'];
                // if ($validation_not_avail == "Not Available") {
                //     echo '<script type="text/javascript">alert("Failed")</script>';
                // } else {
                //     echo '<script type="text/javascript">alert("error")</script>';
                // }

                // echo '<script type="text/javascript">alert("bought")</script>';


                // echo '<script type="text/javascript">alert("bought")</script>';
            }
        }
    } else {
        echo '<script type="text/javascript">alert("Error")</script>';
    }

    ?>

    <!-- header("Location: chart.php?q=$dbcoinname", true, 303); -->
</body>

</html>