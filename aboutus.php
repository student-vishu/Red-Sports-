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
        ?>.about-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
            font-family: 'Poppins', sans-serif;
        }

        .about-container h1 {
            font-size: 36px;
            color: #333;
            margin-bottom: 20px;
        }

        .about-container p {
            font-size: 18px;
            color: #555;
            line-height: 1.8;
            margin-bottom: 40px;
        }

        .about-container img {
            max-width: 100%;
            height: auto;
            margin-bottom: 20px;
        }

        .about-container .mission-section,
        .about-container .vision-section,
        .about-container .team-section {
            margin-bottom: 40px;
        }

        .about-container h2 {
            font-size: 28px;
            color: #333;
            margin-bottom: 10px;
        }

        .about-container hr {
            width: 60px;
            border: 1px solid #f00;
            margin: 20px auto;
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="header">

        <div class="navbar">
            <div class="logo">
                <a href="index1.php"><img src="Imges/logo1.png" width="125px" /></a>
            </div>
            <nav>
                <ul id="MenuItems">
                    <li><a href="index1.php">Home</a></li>
                    <li><a href="product.php">Product</a></li>
                    <li><a href="">About</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="account.php">Account</a></li>
                    <li><a href="feedback.php">Feedback</a></li>
                    <li><a href="actions/logout.php">LogOut</a></li>
                </ul>
            </nav>
            <a href="cart.php"><img src="Imges/cart.png" width="30px" height="30px"></a>
            <img src="Imges/menu.png" class="menu-icon" onclick="menutoggle()">
        </div>
        <div class="row">
            <div class="about-container">
                <h1>Welcome to Red Sports Wear</h1>
                <p>
                    At Red Sports Wear, we are passionate about delivering high-quality sports apparel designed to help athletes and fitness enthusiasts reach their full potential. Whether you're training in the gym, competing in a race, or just enjoying an active lifestyle, our clothing is built for comfort, performance, and style.
                </p>

                <img src="Imges/logo1.png" alt="Red Sports Wear Banner Image">

                <div class="mission-section">
                    <h2>Our Mission</h2>
                    <hr>
                    <p>
                        Our mission is to empower athletes with cutting-edge sportswear that enhances their performance and makes them feel confident. We are committed to providing innovative designs and high-quality fabrics at affordable prices to athletes of all levels.
                    </p>
                </div>
                <div class="vision-section">
                    <h2>Our Vision</h2>
                    <hr>
                    <p>
                        We envision a world where everyone, regardless of age, gender, or skill level, can access premium sportswear that supports their journey to becoming the best version of themselves. Our vision is to become a trusted global brand known for quality, innovation, and customer satisfaction.
                    </p>
                </div>
                <div class="team-section">
                    <h2>Meet Our Team</h2>
                    <hr>
                    <p>
                        Our team is made up of sports enthusiasts and professionals dedicated to bringing you the best sportswear experience. We work together to innovate, design, and deliver products that meet the needs of athletes everywhere.
                    </p>
                    <img src="Imges/user-4.jpg" alt="Red Sports Wear Team">
                </div>
                <p>
                    Thank you for choosing Red Sports Wear as your go-to sports apparel brand. We are honored to be a part of your fitness journey and look forward to supporting you every step of the way.
                </p>
            </div>
        </div>

        <!-- ---------------------brands------------------------------ -->
        <div class="brands">
            <div class="small-container">
                <div class="row">
                    <div class="col-5">
                        <img src="Imges/logo-godrej.png">
                    </div>
                    <div class="col-5">
                        <img src="Imges/logo-oppo.png">
                    </div>
                    <div class="col-5">
                        <img src="Imges/logo-coca-cola.png">
                    </div>
                    <div class="col-5">
                        <img src="Imges/logo-paypal.png">
                    </div>
                    <div class="col-5">
                        <img src="Imges/logo-philips.png">
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
        <!-- --------------------js for toggle menu-------------- -->

        <script>
            var menuItems = document.getElementById("MenuItems");
            menuItems.style.maxHeight = "0px";

            function menutoggle() {
                if (MenuItems.style.maxHeight == "0px") {
                    MenuItems.style.maxHeight = "200px";
                } else {
                    MenuItems.style.maxHeight = "0px";
                }
            }
        </script>

</body>

</html>