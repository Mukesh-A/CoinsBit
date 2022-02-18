<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="portfolio.css">
</head>

<body>
    <div class="topnav">

        <a class="active" href="profile.php">PROFILE</a>
        <a href="portfolio.php">PORTFOLIO</a>
        <a href="history.php">HISTORY</a>
        <a href="home.php">HOME</a>

    </div>
    <div class="container">
        <div class="usdprice">
            <p class="usdt">MY PORTFOLIO</p>
            <p class="usdtprice"></p>
            <!-- <input type="text" class="cardnumber" id="cardnumber" name="cardnumber" value="<?php global $cardnumbers;
                                                                                                echo $cardnumbers; ?>" placeholder="CARD NUMBER"> -->
        </div>
        <!-- <script>
            function muki(mj){
                      var i;
                        console.log(mj);
                      request('GET','https://min-api.cryptocompare.com/data/pricemultifull?fsyms=BTC,ETH,LTC,BNB,ADA,DOT,ZIL,SOL,VET,THETA,LINK,MATIC,UNI,XRP&tsyms=USD')
                  .then((r1) => {
                      
                                var x1 = JSON.parse(r1.target.responseText);
                              var ddzz = x1['RAW'][mj]['USD']['PRICE']
                              document.getElementById('calvalue').value = dzzz;
                            //   document.getElementById('coinprice').value = "$ " + ddzz
                            //   document.getElementById('inputcoinname').value = array[1]
                              
                            })
  
                        function request(method, url) {
                                return new Promise(function (resolve, reject) {
                                    var xhr = new XMLHttpRequest();
                                    xhr.open(method, url);
                                    xhr.onload = resolve;
                                    xhr.onerror = reject;
                                    xhr.send();
                                });
                        }
                        }
                        // muki()
                        // setInterval(muki, 1000)
            </script> -->

        <table>
            <tr>
                <th> Coin Name</th>
                <th>Total Coins</th>
                <th>Rate (usd)</th>
            </tr>

            <?php
            session_start();
            $email = $_SESSION['email'];
            $conn = mysqli_connect("localhost", "root", "") or die("couldnt connect");
            mysqli_select_db($conn, "crypto") or die("couldnt find the db");
            // $query = "SELECT coinname, SUM(coinbought) AS total FROM trading WHERE custname = '$email' GROUP BY coinname";
            $query = "SELECT * from portfolio WHERE custname = '$email' ORDER BY id DESC";
            $result = mysqli_query($conn, $query);
            // $totalval = 0;
            // if(mysql_num_rows($query) > 0 )
            // {
            while ($row = mysqli_fetch_array($result)) {
                $cb = $row['totalcoin'];
                $url = "https://min-api.cryptocompare.com/data/pricemultifull?fsyms=BTC,ETH,LTC,BNB,ADA,DOT,ZIL,SOL,VET,THETA,LINK,MATIC,UNI,USD,XRP&tsyms=USD";
                $jsons = file_get_contents($url);
                $json_data = json_decode($jsons, true);
                $final = $json_data['RAW'][$row['coinname']]['USD']['PRICE'];
                $nextfinalval = $final * $cb;
                // $totalval = $totalval + $nextfinalval;
                // echo $totalval;

                echo "<tr>";

                echo "<td>" . $row['coinname'] . "</td>";
                echo "<td>" . $row['totalcoin'] . "</td>";
                echo "<td>" . $nextfinalval . "</td>";
                // $mj = $row['coinname'];
                // echo '<script type="text/javascript">',
                //         'var mvx = $mj;',
                //             'muki(mvx);',
                //         '</script>';
                // $mj = $row['total'];
                // echo $mj;
                echo "</tr>";
            }
            // echo " no";
            //  }
            // if(mysqli_num_rows($result)>0)
            // {
            // while ($row = mysqli_fetch_array ($result,MYSQLI_BOTH))
            //  {


            //     echo "<tr>";

            // while($sum = mysqli_fetch_array(mysqli_query($conn, $query)));
            // {
            // echo "Total : ".$sum[0];
            // echo "Total : ".$sum[1];
            // }
            // echo "<td>".$row["id"]."</td>";
            // echo "<td>".$row["name"]."</td>";
            // echo "<td>".$row["email"]."</td>";
            // echo "<td>".$row["total"]."</td>";
            // echo $result;
            // echo "<td><button id='delete' name='delete'>DELETE</button></td>";
            // echo "<td><button id='update' name='edit'>EDIT</button></td>";
            // echo "<td><input type='hidden' name='id' value='".$row["id"]."'";
            //  echo "</tr>";
            //     // echo"</form>";
            // }  
            // }
            // else
            // {
            //     echo "QUERY WRONG!";
            // }
            ?>
        </table>
    </div>
</body>

</html>