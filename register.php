<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="register.css">
</head>

<body>

  <div class="container">
    <div class="left">
      <!-- <img src="loginlogo3.png" alt="Italian Trulli" class="login-img"> -->
      <img src="loginlogo.png" alt="Italian Trulli" class="login-imgs">

    </div>
    <div class="right">
      <p>REGISTER FLOKS!</p>
      <p id="login-text"> To Get One Crypto Trading Platform For Everyone</p>

      <form action="register.php" method="POST">
        <p id="login-username">USER NAME</p>
        <input type="text" id="username" name="username" required><br><br>
        <p id="login-email">EMAIL ADDRESS</p>
        <input type="text" id="fname" name="email" pattern="(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/" required><br><br>
        <p id="login-password">PASSWORD</p>
        <input type="password" id="fpass" name="password" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required><br><br>
        <p id="login-cpassword">CONFIRM PASSWORD</p>
        <input type="password" id="cpass" name="cpassword" required><br><br>
        <p id="login-phone">PHONE NUMBER</p>
        <input type="text" id="phone" name="phone" maxlength="10" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"><br><br>

        <button name="signup" id="submit">Sign up</button>
        <!-- </button> -->
      </form>

      <div id="message">
        <p class="messagefirstline">Password must contain</p>
        <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
        <p id="capital" class="invalid">A <b>uppercase</b> letter</p>
        <p id="number" class="invalid" style="line-height: 1;">A <b>number or special character</b></p>
        <p id="length" class="invalid">Minimum <b>8 characters</b></p>
      </div>

      <?php


      // echo $pass;
      if (isset($_POST['signup'])) {
        $pass = $_POST['password'];
        $cpass = $_POST['cpassword'];

        if ($pass == $cpass) {
          session_start();
          $conn = mysqli_connect("localhost", "root", "") or die("Couldn't Connect");
          mysqli_select_db($conn, "crypto") or die("couldnt find the db");
          $username = $_POST['username'];
          $email = $_POST['email'];
          $password = $_POST['password'];
          $phone = $_POST['phone'];
          $query = "select * from users where email='$email'";
          $result = mysqli_query($conn, $query);
          $num = mysqli_num_rows($result);
          if ($num == 1) {
            echo '<script type="text/javascript">alert("User Already Exists!")</script>';
          } else {
            $query1 = "insert into users(username, email, password, phone) values('$username','$email','$password','$phone')";
            $result1 = mysqli_query($conn, $query1);
            // echo '<script type="text/javascript">alert("User Registered.. Welcome")</script>';
            // $_SESSION['email'] = $email;

            // 
          }

          if ($result1) {
            echo "<script>
                     alert('User Registered.. Welcome');
                     window.location.href='login.php';
                     </script>";
            // echo '<script type="text/javascript">alert("User Registered.. Welcome")</script>';
            // sleep(5);

            // header("Location: login.php", true, 303);
          }
        } else {
          echo '<script type="text/javascript">alert("password doesnot match")</script>';
        }
      }
      ?>
    </div>

  </div>



  <script>
    var myInput = document.getElementById("fpass");
    var letter = document.getElementById("letter");
    var capital = document.getElementById("capital");
    var number = document.getElementById("number");
    var length = document.getElementById("length");

    var phone = document.getElementById("phone");

    // When the user clicks on the password field, show the message box
    myInput.onfocus = function() {
      document.getElementById("message").style.display = "block";
    }

    // When the user clicks outside of the password field, hide the message box
    myInput.onblur = function() {
      document.getElementById("message").style.display = "none";
    }

    // When the user starts to type something inside the password field
    myInput.onkeyup = function() {
      // Validate lowercase letters
      var lowerCaseLetters = /[a-z]/g;
      if (myInput.value.match(lowerCaseLetters)) {
        letter.classList.remove("invalid");
        letter.classList.add("valid");
      } else {
        letter.classList.remove("valid");
        letter.classList.add("invalid");
      }

      // Validate capital letters
      var upperCaseLetters = /[A-Z]/g;
      if (myInput.value.match(upperCaseLetters)) {
        capital.classList.remove("invalid");
        capital.classList.add("valid");
      } else {
        capital.classList.remove("valid");
        capital.classList.add("invalid");
      }

      // Validate numbers
      var numbers = /[0-9]/g;
      var format = /[ !@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/;

      if ((myInput.value.match(numbers)) || (myInput.value.match(format))) {
        number.classList.remove("invalid");
        number.classList.add("valid");
      } else {
        number.classList.remove("valid");
        number.classList.add("invalid");
      }

      // Validate length
      if (myInput.value.length >= 8) {
        length.classList.remove("invalid");
        length.classList.add("valid");
      } else {
        length.classList.remove("valid");
        length.classList.add("invalid");
      }

      // if (phone.value.length >= 8) {
      //   length.classList.remove("invalid");
      //   length.classList.add("valid");
      // } else {
      //   length.classList.remove("valid");
      //   length.classList.add("invalid");
      // }
    }
  </script>
</body>

</html>