<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="navbar.css">
</head>

<body>
  <?php
  session_start();
  if (!isset($_SESSION["email"])) {

    header("Location: login.php");
  }
  ?>
  <?php
  $email = $_SESSION['email'];
  $conn = mysqli_connect("localhost", "root", "") or die("couldnt connect");
  mysqli_select_db($conn, "crypto") or die("couldnt find the db");
  $query = "SELECT username FROM users WHERE email = '$email'";
  $result = mysqli_query($conn, $query);
  while ($row = mysqli_fetch_array($result)) {
    $username = $row['username'];
  }
  ?>

  <nav>
    <ul>
      <li><a href="home.php">HOME</a></li>
      <li><a href="profile.php">PROFILE</a></li>
      <li><a href="deposite.php">DEPOSIT</a></li>
      <li><a href="history.php">HISTORY</a></li>
      <li><a href="aboutus.html">SERVICES</a></li>

      <label class="username"><?php echo $username; ?></label>
      <form action="navbar.php" method="POST">
        <button id="logout" name="logout">LOGOUT</button>
      </form>
    </ul>
  </nav>

  <?php
  if (isset($_POST['logout'])) {
    session_destroy();
    $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/login.php';
    header('Location: ' . $home_url);
  }
  ?>

  <!--  -->
</body>

</html>