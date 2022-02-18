<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="history.css">
</head>

<body>
    <div class="topnav">

        <a class="active" href="profile.php">PROFILE</a>
        <a href="portfolio.php">PORTFOLIO</a>
        <a href="history.php">HISTORY</a>
        <a href="home.php">HOME</a>

    </div>
    <div class="container">
        <table>
            <tr>
                <th> Coin Name</th>
                <th>Coin Price</th>
                <th>Coin Bought</th>
                <th>USD</th>
                <th>Date Time</th>
                <th>Operation</th>

            </tr>

            <?php
            session_start();
            $email = $_SESSION['email'];
            $conn = mysqli_connect("localhost", "root", "") or die("couldnt connect");
            mysqli_select_db($conn, "crypto") or die("couldnt find the db");
            $query = "SELECT * FROM trading WHERE custname = '$email' ORDER BY 'tid' DESC";
            $result = mysqli_query($conn, $query);

            // if(mysql_num_rows($query) > 0 )
            // {
            while ($row = mysqli_fetch_array($result)) {
                // $cb = $row['total'];
                // $url = "https://min-api.cryptocompare.com/data/pricemultifull?fsyms=BTC,ETH,LTC,BNB,ADA,DOT,ZIL,SOL,VET,THETA,LINK,MATIC,UNI,XRP&tsyms=USD";
                // $jsons = file_get_contents($url);
                // $json_data = json_decode($jsons , true);
                // $final = $json_data['RAW'][$row['coinname']]['USD']['PRICE'];
                // $nextfinalval = $final * $cb;

                echo "<tr>";

                echo "<td>" . $row['coinname'] . "</td>";
                echo "<td>" . $row['coinprice'] . "</td>";
                echo "<td>" . $row['coinbought'] . "</td>";
                echo "<td>" . $row['inputamount'] . "</td>";
                echo "<td>" . $row['datetime'] . "</td>";
                echo "<td>" . $row['buysell'] . "</td>";
                // echo "<td>" . $nextfinalval . "</td>";

                echo "</tr>";
            }
            ?>
        </table>
    </div>
</body>

</html>