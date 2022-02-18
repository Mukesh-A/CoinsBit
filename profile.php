<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <link rel="stylesheet" href="profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Document</title>
</head>

<body>
    <!--  -->
    <div class="topnav">

        <a class="active" href="profile.php">PROFILE</a>
        <a href="portfolio.php">PORTFOLIO</a>
        <a href="history.php">HISTORY</a>
        <a href="home.php">HOME</a>

    </div>


    <div class="container">
        <div id="leftdiv">

            <?php
            session_start();
            $emails = $_SESSION['email'];
            echo $emails;
            $con = mysqli_connect("localhost", "root", "") or die("couldnt connect");
            mysqli_select_db($con, "crypto") or die("couldnt find the db");
            $query = "SELECT * FROM bank WHERE email = '$emails' ";

            $result = mysqli_query($con, $query);
            while ($row = mysqli_fetch_array($result)) {

                $cardnumber = $row['cardnumber'];
                $cardholdername = $row['cardname'];
                $cardyear = $row['monthyear'];
                $cardcvv = $row['cvv'];
            }

            ?>
            <form action="profile.php" method="POST">
                <div class="ccard">
                    <div class="top">
                        <p class="carddebit">Debit Card </p>
                        <p class="cardbankname">BANK NAME </p>
                    </div>
                    <div class="middel">
                        <!-- <p class="cardnumber">1234 4567 8910 1112</p> -->

                        <input type="text" class="cardnumber" name="cardnumber" required id="cardnumber" readonly value="<?php global $cardnumber;
                                                                                                                            echo $cardnumber; ?>" maxlength="16" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                        <input type=" text" class="cardyear" name="cardyear" required id="cardyear" readonly value="<?php global $cardyear;
                                                                                                                    echo $cardyear; ?>" maxlength="4" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                        <label id="lablecvv">CVV</label><input type="text" required class="cardcvv" name="cardcvv" id="cardcvv" readonly value="<?php global $cardcvv;
                                                                                                                                                echo $cardcvv; ?>" maxlength="3" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">

                    </div>

                    <div class="bottom">
                        <!-- <p class="cardholdername">MUKESH A </p> -->
                        <input type="text" class="cardholdername" name="cardholdername" id="cardholdername" readonly value="<?php global $cardholdername;
                                                                                                                            echo $cardholdername; ?>">

                        <input type="submit" id="updatebtn" name="updatebtn">


                    </div>
                    <i class="fas fa-pen" onclick="myFunction()"></i>
                    <!--  -->
                </div>
            </form>
            <?php
            if (isset($_POST['updatebtn'])) {

                $cardnumber = $_POST['cardnumber'];
                $cardyear = $_POST['cardyear'];
                $cardholdername = $_POST['cardholdername'];
                $cvv = $_POST['cardcvv'];

                $con = mysqli_connect("localhost", "root", "") or die("couldnt connect");
                mysqli_select_db($con, "crypto") or die("couldnt find the db");

                $resultss = mysqli_query($con, "update bank set cardnumber='$cardnumber', monthyear='$cardyear', cvv='$cvv', cardname='$cardholdername' where email='$emails'");

                if ($resultss = true) {
                    echo '<script type="text/javascript">alert("Record!")</script>';
                    header("Refresh:0");
                }
            }

            ?>



        </div>

        <div id="rightdiv">
            <?php

            $email = $_SESSION['email'];
            echo $email;
            $con = mysqli_connect("localhost", "root", "") or die("couldnt connect");
            mysqli_select_db($con, "crypto") or die("couldnt find the db");
            $query = "SELECT * FROM users WHERE email = '$email' ";

            $result = mysqli_query($con, $query);
            while ($row = mysqli_fetch_array($result)) {

                $username = $row['username'];
                $emails = $row['email'];
                $phone = $row['phone'];
                $aadhar = $row['aadhar'];
                $pancard = $row['pancard'];
            }

            ?>
            <form action="profile.php" method="POST">
                <p id="login-username">USER NAME</p>
                <input type="text" id="username" name="username" readonly value="<?php global $username;
                                                                                    echo $username; ?>"><br><br>
                <p id="login-email">EMAIL ADDRESS</p>
                <input type="text" id="fname" name="email" readonly value="<?php global $emails;
                                                                            echo $emails; ?>"><br><br>
                <p id="login-password">PHONE</p>
                <input type="text" id="fphone" name="fphone" value="<?php global $phone;
                                                                    echo $phone; ?>"><br><br>
                <p id="login-cpassword">AADHAR</p>
                <input type="text" id="aadhar" name="aadhar" value="<?php global $aadhar;
                                                                    echo $aadhar; ?>"><br><br>
                <p id="login-phone">PAN CARD NUMBER</p>
                <input type="text" id="pancard" name="pancard" value="<?php global $pancard;
                                                                        echo $pancard; ?>"><br><br>

                <input type="submit" id="finalsubmit" name="finalsubmit">
            </form>

        </div>

        <?php
        if (isset($_POST['finalsubmit'])) {
            $email = $_SESSION['email'];
            $aadhar = $_POST['aadhar'];
            $pancard = $_POST['pancard'];
            $con = mysqli_connect("localhost", "root", "") or die("couldnt connect");
            mysqli_select_db($con, "crypto") or die("couldnt find the db");

            $result1 = mysqli_query($con, "update users set aadhar='$aadhar',pancard='$pancard' where email='$email'");

            if ($result1 = true) {
                echo '<script type="text/javascript">alert("Modifying Record!")</script>';
                header("Refresh:0");
            }
        }


        ?>
    </div>

    <script>
        if (document.getElementById("aadhar").value != "" && document.getElementById("pancard").value != "") {

            document.getElementById("finalsubmit").style.display = "none"


        }

        function myFunction() {
            document.getElementById("updatebtn").style.visibility = "visible"
            document.getElementById("lablecvv").style.visibility = "visible"
            document.getElementById("cardcvv").style.visibility = "visible"
            document.getElementById("cardnumber").readOnly = false;
            document.getElementById("cardyear").readOnly = false;
            document.getElementById("cardholdername").readOnly = false;

            document.getElementById("cardcvv").readOnly = false;

            document.getElementById("cardnumber").focus();
            document.getElementById("cardnumber").style.outline = "black solid 2px";
        }
    </script>

</body>

</html>