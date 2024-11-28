<?php
session_start();
if (!isset($_SESSION['email'])) {
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="viewport" content="width=device-width,initial-scale=1.0 " />
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>All Products - RedSports</title>
  <link rel="stylesheet" href="style1.css" />
  <style>
    <?php
    include 'style1.css';
    ?>
  </style>
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap"
    rel="stylesheet" />
  <link
    rel="stylesheet"
    href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
  <script>
    function validation() {
      const email = document.getElementById('reg-email').value
      const emailerror = document.getElementById('reg-emailerror')
      const emailpattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
      const password = document.getElementById('reg-password').value
      const passworderror = document.getElementById('reg-passworderror')

      let isValid = true
      //for email validation

      if (email == "") {
        emailerror.textContent = "Email is require!!"
        isValid = false
      } else if (!emailpattern.test(email)) {
        emailerror.textContent = "Email must be in valid format!!"
        isValid = false
      } else {
        emailerror.textContent = ""
      }

      //for password validation
      if (password == "") {
        passworderror.textContent = "Password must be require!!"
        isValid = false
      } else if (password.length < 5 || password.length > 10) {
        passworderror.textContent = "Password must be 5 to 10 character!!"
        isValid = false
      } else {
        passworderror.textContent = ""
      }
      return isValid
    }
  </script>

</head>

<body style="background-color: mistyrose;">
  <div class="container">
    <div class="navbar">
      <div class="logo">
        <a href="index1.php"><img src="Imges/logo1.png" width="125px" /></a>
      </div>
      <nav>
        <ul id="MenuItems" style="display: none;">
          <li><a href="index1.php">Home</a></li>
          <li><a href="product.php">Product</a></li>
          <li><a href="">About</a></li>
          <li><a href="">Contact</a></li>
          <li><a href="account.php">Account</a></li>
        </ul>
      </nav>
      <!-- <a href="cart.php"><img src="Imges/cart.png" width="30px" height="30px" /></a> -->
      <img src="Imges/menu.png" class="menu-icon" onclick="menutoggle()" />
    </div>
  </div>

  <!-- ------------------account-page----------------- -->

  <div class="account-page">
    <?php
    if (isset($_GET['msg'])) {
      if ($_GET['msg'] == 777) {
        echo "<center><h3><font color='green'>Registration Successfull!!</font></h3></center>";
      }
      if ($_GET['msg'] == 18) {
        echo "<center><h3><font color='red'>Registration Failed!!, Please Try Again!!</font></h3></center>";
      }
    }
    ?>
    <div class="container">
      <div class="row">
        <div class="col-2">
          <img src="Imges/image1.png" width="100%" />
        </div>

        <div class="col-2">
          <div class="form-container">
            <div class="form-btn">
              <span onclick="login()">Login</span>
              <span onclick="register()">Register</span>
              <hr id="Indicator" />
            </div>
            <!-- User-Login form -->
            <form id="LoginForm" action="actions/login.php" method="post">
              <input type="email" placeholder="Username" name="email" id="email" required />
              <input type="password" placeholder="Password" name="password" id="password" required />
              <input type="submit" class="btn" name="login" id="login" value="Login">
              <p>New Customer? Create Account<span onclick="register()">SignUp</span></p>
            </form>
            <!-- User-Reg Form -->
            <form id="RegForm" action="actions/action.php" method="post" onsubmit="return validation()">
              <input type="text" placeholder="First Name" name="fname" id="fname" required />
              <input type="text" placeholder="Last Name" name="lname" id="lname" required />
              <input type="text" placeholder="Email" name="email" id="reg-email" />
              <span id="reg-emailerror" style="color: red; font-size:xx-small "></span>
              <input type="text" placeholder="Phone No" name="phoneno" id="phoneNo" minlength="10" maxlength="10" required>
              <input type="password" placeholder="Password" name="password" id="reg-password" required />
              <span id="reg-passworderror" style="color: red;font-size:xx-small;white-space: nowrap;"></span>
              <input type="submit" class="btn" name="signup" id="signup" value="Register">
              <p>Already have an account?<span onclick="login()">Login</span></p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- ----------------------footer------------------- -->
  <div class="footer">
    <div class="container">
      <div class="row">
        <div class="footer-col-1">
          <h3>Download Our App</h3>
          <p>Download App for Android and IOS mobile phone.</p>
          <div class="app-logo">
            <img src="Imges/play-store.png" />
            <img src="Imges/app-store.png" />
          </div>
        </div>
        <div class="footer-col-2">
          <img src="Imges/logo-white1.png" />
          <p>
            Our Purpose Is To Sustainably Make the Pleasure and Benefits of
            Sports Accessible to the Many.
          </p>
        </div>
        <div class="footer-col-3">
          <h3>Usefull Links</h3>
          <ul>
            <li>Coupons</li>
            <li>Blog Post</li>
            <li>Return Policy</li>
            <li>Join Affiliate</li>
          </ul>
        </div>
        <div class="footer-col-4">
          <h3>Follow us</h3>
          <ul>
            <li>Facebook</li>
            <li>Twitter</li>
            <li>Instagram</li>
            <li>You Tube</li>
          </ul>
        </div>
      </div>
      <hr />
      <p class="copyright">Copyright 2020 - Easy Tutorials</p>
    </div>
  </div>
  <!-- --------------------js for toggle menu-------------- -->

  <script>
    var menuItems = document.getElementById('MenuItems');
    menuItems.style.maxHeight = '0px';

    function menutoggle() {
      if (MenuItems.style.maxHeight == '0px') {
        MenuItems.style.maxHeight = '200px';
      } else {
        MenuItems.style.maxHeight = '0px';
      }
    }
  </script>
  <!-- --------------------js for toggle form-------------- -->
  <script>
    var LoginForm = document.getElementById('LoginForm');
    var RegForm = document.getElementById('RegForm');
    var Indicator = document.getElementById('Indicator');

    function register() {
      RegForm.style.transform = 'translateX(0px)';
      LoginForm.style.transform = 'translateX(0px)';
      Indicator.style.transform = 'translateX(100px)';
    }

    function login() {
      RegForm.style.transform = 'translateX(300px)';
      LoginForm.style.transform = 'translateX(300px)';
      Indicator.style.transform = 'translateX(0px)';
    }
  </script>
</body>

</html>