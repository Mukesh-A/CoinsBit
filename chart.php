<html>

<head>
    <link rel="stylesheet" href="chart.css">
</head>

<body>
    <?php include('navbar.php'); ?>
    <?php
    // session_start();
    if (!isset($_SESSION["email"])) {

        header("Location: login.php");
    }
    ?>
    <div class="container">
        <script>
            var currentLocation = window.location;
            console.log(currentLocation);
            var str = currentLocation['href']
            var array = str.split("?q=", );
            console.log(array[1])
        </script>
        <?php
        echo $_GET['q'];
        $urlword = $_GET['q'];
        ?>

        <script type="text/javascript">
            function red() {
                baseUrl = "https://widgets.cryptocompare.com/";
                var scripts = document.getElementsByTagName("script");
                var embedder = scripts[scripts.length - 1];
                var cccTheme = {
                    "General": {
                        "background": "#000"
                    }
                };
                (function() {
                    var appName = encodeURIComponent(window.location.hostname);
                    if (appName == "") {
                        appName = "local";
                    }
                    var s = document.createElement("script");
                    s.type = "text/javascript";
                    s.async = true;
                    // var theUrl = baseUrl+'serve/v3/coin/chart?fsym=BTC&tsyms=USD';

                    var vv = 'serve/v3/coin/chart?fsym=' + array[1] + '&tsyms=USD';
                    var theUrl = baseUrl + vv;
                    s.src = theUrl + (theUrl.indexOf("?") >= 0 ? "&" : "?") + "app=" + appName;
                    embedder.parentNode.appendChild(s);
                })();
            }
            red()
        </script>


    </div>

    <?php
    $email = $_SESSION['email'];
    // echo $_GET['q'];

    $conn = mysqli_connect("localhost", "root", "") or die("couldnt connect");
    mysqli_select_db($conn, "crypto") or die("couldnt find the db");
    // $query = "SELECT coinname, SUM(coinbought) AS total FROM trading WHERE custname = '$email' GROUP BY coinname";
    // $result = mysqli_query($conn, $query);
    //    $variables = print "<script>document.write(array[1])</script>";
    // $variables =  $_POST['displaycoinname'];
    // if(mysqli_num_rows($result)>0){

    // $selltype = "select * from portfolio where custname = '$email' and coinname = '$urlword'";
    $selltype = "select * from portfolio where custname = '$email' ";
    $sresult = mysqli_query($conn, $selltype);
    while ($rows = mysqli_fetch_array($sresult)) {


        if ($rows["coinname"] == "USD") {
            $availablebal = $rows['totalcoin'];
            // break;
        }
        if ($rows["coinname"] == $_GET['q']) {
            $cb = $rows['totalcoin'];
        }
    }

    // while ($row = mysqli_fetch_array($result)) {



    //     // if ($row["coinname"] == $_GET['q']) {
    //     //     echo "<input type='text' id='coinnamevalue' value='" . $row['total'] . "'>";
    //     // }
    // }
    ?>


    <form action="chart1.php" method="POST">
        <div class="buysellblock">
            <div id="coininfo">
                <!-- <p id="coinvalue">$12000</p> -->
                <input type="text" id="coinprice" oninput="muki();" placeholder="$25000" name="cp" readonly="readonly">
                <!-- <p id="coinname" name="inputcoinname"></p> -->
                <input type="text" id="displaycoinname" name="displaycoinname" oninput="muki();" readonly="readonly">
            </div>
            <!-- <p id="avlbal">$1000.0</p> -->
            <label for="avlbal" id="usdtname">USD :</label><input type="text" id="avlbal" oninput="rotateImage();" placeholder="$25000" value="<?php global $availablebal;
                                                                                                                                                if ($availablebal == null) {
                                                                                                                                                    echo 0;
                                                                                                                                                } else {
                                                                                                                                                    echo $availablebal;
                                                                                                                                                } ?>" readonly="readonly">
            <input type="image" id="arrow" src="arrowsnew.png" width="45" height="50" onclick="rotateImage(); return false">
            <div id="coininputbox">

                <input type="text" id="inputvalue" name="inputvalue" oninput="muki();" placeholder="$25000" required>
                <input type="text" id="inputcoinname" class="inputcoinname" name="inputcoinname" oninput="muki();" placeholder="$25000" value="USD" readonly="readonly">

                <!-- <p id="inputcoinname" class="inputcoinname">USDT</p> -->

            </div>
            <!-- <p id="calvalue" >$25000.0</p> -->
            <input type="text" id="calvalue" name="calvalue" oninput="muki();" placeholder="$25000" value="" readonly="readonly">
            <input type="text" id="buysell" name="buysell" oninput="rotateImage();" value="BUY">
            <input type="submit" id="buy" name="bought" value="BUY">
            <!-- <button id="buy" name="HTML"></button> -->
        </div>
        <input type='text' id='coinnamevalue' value="<?php global $cb;
                                                        echo $cb; ?>">
    </form>



    <p id="footer"></p>
    <script>
        rotateImage()
        var clicks = 0;

        function rotateImage() {
            clicks += 1;
            console.log(clicks)
            if (clicks == 1) {
                var img = document.getElementById('arrow');
                img.style.transform = 'rotate(180deg)';
                img.style.WebkitTransitionDuration = '1s';

                document.getElementById('coininfo').style.top = "200px";
                document.getElementById('avlbal').style.top = "200px";
                document.getElementById('usdtname').style.top = "200px";
                document.getElementById('coininfo').style.transitionDuration = "2s";
                document.getElementById('avlbal').style.transitionDuration = "2s";
                document.getElementById('usdtname').style.transitionDuration = "2s";
                //  document.getElementById('c').style.position="fixed";

                document.getElementById('coininputbox').style.marginTop = "-170px";
                document.getElementById('coininputbox').style.transitionDuration = "2s";

                document.getElementById('buy').value = "SELL"
                document.getElementById('buysell').value = "SELL"


            } else if (clicks == 2) {
                var img = document.getElementById('arrow');
                img.style.transform = 'rotate(360deg)';
                img.style.WebkitTransitionDuration = '1s';

                document.getElementById('coininfo').style.top = "20px";
                document.getElementById('avlbal').style.top = "10px";
                document.getElementById('usdtname').style.top = "10px";
                document.getElementById('coininfo').style.transitionDuration = "2s";
                document.getElementById('avlbal').style.transitionDuration = "2s";
                document.getElementById('usdtname').style.transitionDuration = "2s";


                document.getElementById('coininputbox').style.marginTop = "10px";
                document.getElementById('coininputbox').style.transitionDuration = "2s";


                document.getElementById('buy').value = "BUY"
                document.getElementById('buysell').value = "BUY"


                clicks = 0;


            }


        }

        var myBox2s = document.getElementById('inputvalue').value;



        function muki() {
            var i;

            request('GET', 'https://min-api.cryptocompare.com/data/pricemultifull?fsyms=BTC,ETH,LTC,BNB,ADA,DOT,ZIL,SOL,VET,THETA,LINK,MATIC,UNI,XRP&tsyms=USD')
                .then((r1) => {

                    var x1 = JSON.parse(r1.target.responseText);
                    var ddzz = x1['RAW'][array[1]]['USD']['PRICE']
                    document.getElementById('coinprice').value = "$ " + ddzz
                    document.getElementById('displaycoinname').value = array[1]

                    //   console.log(ddzz)
                    //   document.getElementById('coinname').innerHTML = array[1]
                    var myBox1 = parseFloat(x1['RAW'][array[1]]['USD']['PRICE']);
                    //   console.log(typeof myBox1)
                    var myBox2 = document.getElementById('inputvalue').value;
                    // console.log(typeof myBox1)
                    var inputvaluesx = document.getElementById('inputvaluesss');
                    var myResult = myBox2 / myBox1;
                    var myResult2 = myBox2 * myBox1;
                    // console.log(myResult)
                    document.getElementById('calvalue').value = parseFloat(myResult).toFixed(4);

                    if (document.getElementById("buy").value == "SELL") {
                        document.getElementById("displaycoinname").value = 'USD'
                        document.getElementById("inputcoinname").value = array[1]
                        document.getElementById("calvalue").value = parseFloat(document.getElementById("coinnamevalue").value).toFixed(4);
                        var minuscurcoinalv = document.getElementById("coinnamevalue").value
                        console.log(minuscurcoinalv)
                        var finalminuscurcoinalv = minuscurcoinalv - myBox2
                        console.log(finalminuscurcoinalv)
                        if (finalminuscurcoinalv > 0) {
                            document.getElementById("calvalue").value = parseFloat(finalminuscurcoinalv).toFixed(4);
                            document.getElementById("coinprice").value = parseFloat(myResult2).toFixed(4);

                        } else {
                            document.getElementById("calvalue").value = "Not Available"
                            document.getElementById("coinprice").value = "0";
                        }

                        // } else if (document.getElementById("buy").value == "BUY") {

                        //     var mincurUSD = document.getElementById("avlbal").value
                        //     console.log("aval", mincurUSD)
                        //     var finalcurUSD = mincurUSD - myBox2
                        //     console.log(finalcurUSD)
                        //     if (finalcurUSD > 0) {
                        //         document.getElementById("avlbal").value = parseFloat(finalcurUSD).toFixed(4);
                        //         exit
                        //         // document.getElementById("coinprice").value = parseFloat(myResult2).toFixed(4);

                        //     } else {
                        //         document.getElementById("avlbal").value = "Not Available"
                        //         exit
                        //         // document.getElementById("coinprice").value = "0";
                        //     }
                    } else {
                        document.getElementById("displaycoinname").value = array[1]
                        document.getElementById("inputcoinname").value = 'USD'

                        var mincurUSD = document.getElementById("avlbal").value
                        console.log("aval", mincurUSD)

                        if (mincurUSD <= 0) {
                            var r = confirm("You Dont Have Enough  Amount, Add Some Money?  ");
                            if (r == true) {
                                window.location.href = 'deposite.php';
                            } else {
                                window.location.reload();
                            }

                        }
                        var finalcurUSD = mincurUSD - myBox2
                        console.log(finalcurUSD)
                        if (finalcurUSD < 0) {
                            if (confirm('Limit')) {
                                window.location.reload();
                            }
                        }

                        // document.getElementById("avlbal").value = parseFloat(finalcurUSD).toFixed(4);
                        // exit
                        // document.getElementById("coinprice").value = parseFloat(myResult2).toFixed(4);

                        // } else {
                        //     // document.getElementById("avlbal").value = "Not Available"
                        //     // exit
                        //     // document.getElementById("coinprice").value = "0";
                        // }

                    }


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
        setInterval(muki, 5000)





        //  function calculate() {
        // var myBox1 = x1['DISPLAY'][array[1]]['USD']['PRICE']
        // console.log(myBox1)
        // var myBox2 = document.getElementById('inputvalue').value;
        // var inputvaluesss = document.getElementById('inputvaluesss'); 
        // var myResult = myBox1 * myBox2;
        // document.getElementById('inputvaluesss').value = myResult;

        // }   
    </script>










</body>

</html>
<!-- 
https://min-api.cryptocompare.com/documentation -->


<!-- fetch date and time  -->
</*?php date_default_timezone_set('Asia/Kolkata'); echo date('d-m-Y g:i a'); ?>

<!-- slider  -->

<!-- https://www.w3schools.com/howto/tryit.asp?filename=tryhow_css_rangeslider -->

<!-- https://www.youtube.com/watch?v=5bmDoibhKZw -->