<?php
session_start();

require 'actions/vendor/autoload.php';

if (!isset($_SESSION['email'])) {
    header('location:account.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width,initial-scale=1.0 ">
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>RedSports | Ecommerce Website Design</title>
    <link rel="stylesheet" href="style1.css" />
    <style>
        <?php
        include 'style1.css';
        ?>
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body style="background-color: mistyrose;">
    <div class="container">
        <div class="navbar">
            <div class="logo">
                <a href="index1.php"><img src="Imges/logo1.png" width="125px" /></a>
            </div>
            <nav>
                <ul id="MenuItems">
                    <li><a href="index1.php">Home</a></li>
                    <li><a href="product.php">Product</a></li>
                    <li><a href="aboutus.php">About</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="account.php">Account</a></li>
                    <li><a href="feedback.php">Feedback</a></li>
                    <li><a href="actions/logout.php">LogOut</a></li>
                </ul>
            </nav>
            <a href="cart.php"><img src="Imges/cart.png" width="30px" height="30px" /></a>
            <img src="Imges/menu.png" class="menu-icon" onclick="menutoggle()" />
        </div>
    </div>

    <!-- ======================Feedback Form=================================== -->
    <div class="account-page">
        <div class="container">
            <div class="row">
                <div class="col-2">
                    <img src="Imges/image1.png" width="100%" />
                </div>

                <div class="col-2">
                    <div class="form-container">
                        <div class="form-btn">
                            <span style="width: 100%;">Feedback</span>
                        </div>
                        <?php
                        if (isset($_SESSION['mes'])) {
                            echo '<p style="color: green;">' . $_SESSION['mes'] . '</p>';
                            unset($_SESSION['mes']);
                        }
                        ?>
                        <form id="feedbackForm" action="actions\feedback.php" method="post">
                            <input type="text" placeholder="Full Name" name="fname" id="fname" required />
                            <input type="text" placeholder="Email" name="email" id="reg-email" />
                            <input type="text" placeholder="Phone No" name="phoneno" id="phoneNo" required>
                            <textarea name="message" id="" placeholder="Feedback"></textarea>
                            <input type="submit" class="btn" name="feedback" id="feedback" value="feedback">
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
                        <img src="Imges/play-store.png">
                        <img src="Imges/app-store.png">
                    </div>
                </div>
                <div class="footer-col-2">
                    <img src="Imges/logo-white1.png">
                    <p>Our Purpose Is To Sustainably Make the Pleasure and
                        Benefits of Sports Accessible to the Many.</p>
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
            <hr>
            <p class="copyright">Copyright 2020 - Easy Tutorials</p>
        </div>
    </div>

</body>

</html>