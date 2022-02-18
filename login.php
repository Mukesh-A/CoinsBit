<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="login.css">
</head>

<body>

    <div class="container">
        <div class="left">
            <!-- <img src="loginlogo3.png" alt="Italian Trulli" class="login-img"> -->
            <img src="loginlogo.png" alt="Italian Trulli" class="login-imgs">

        </div>
        <div class="right">
            <p>WELCOME FOLKS</p>
            <p id="login-text">One Crypto Exchange Platform For Everyone</p>

            <form action="login.php" method="POST">
                <p id="login-email">EMAIL ADDRESS</p>
                <input type="text" id="fname" name="email" required><br><br>
                <p id="login-password">PASSWORD</p>
                <input type="password" id="fpass" name="password" required><br><br>
                <!-- <button name="login" id="submit" type="button"> -->
                <button name="log" id="submit">Sign In</button>
                <!-- </button> -->
            </form>
            <button onclick="location.href='http://localhost/crypto/register.php'" type="button" id="signup">SignUp</button>
            <?php
            if (isset($_POST['log'])) {
                session_start();
                $con = mysqli_connect('localhost', 'root', '');
                mysqli_select_db($con, 'crypto') or die("couldnt find the db");
                $email1 = $_POST['email'];
                $password1 = $_POST['password'];
                $s = "select * from  users where email = '$email1' and password = '$password1'";
                $result = mysqli_query($con, $s);
                $num = mysqli_num_rows($result);
                if ($num == 1) {
                    $_SESSION['email'] = $email1;
                    header('location:home.php');
                } else if ($email1 == "admin@gmail.com" && $password1 == "admin") {
                    header('location: approved_users.php');
                } else {
                    echo '<script type="text/javascript">alert("User Does Not Exist!")</script>';
                }
            }
            ?>
        </div>

    </div>

</body>

</html>