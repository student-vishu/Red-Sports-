<?php
session_start();
if (!isset($_SESSION['email'])) {
    //  header('location:account.php');
    //exit();
} else {
    require 'actions/vendor/autoload.php';

    $databaseconnection = new MongoDB\Client;

    $myDatabase = $databaseconnection->myDB;

    $userCollection = $myDatabase->users;

    $productsCollection = $myDatabase->product;

    $userEmail = $_SESSION['email'];

    $data = array(
        "Email" => $userEmail
    );

    //fetch user from mongodb users collection

    $fetch = $userCollection->FindOne($data);
    $products = $productsCollection->find();
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

<body>
    <div class="header">
        <div class="container">
            <div class="navbar">
                <div class="logo">
                    <a href="index1.php"><img src="Imges/logo1.png" width="125px" /></a>
                </div>
                <div class="welcome-name">
                    <?php
                    if (isset($_SESSION['email'])) {
                        echo "Welcome!! " . $fetch['Fname'] . " " . $fetch['Lname'];
                    }
                    ?>
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
                <a href="cart.php"><img src="Imges/cart.png" width="30px" height="30px"></a>
                <img src="Imges/menu.png" class="menu-icon" onclick="menutoggle()">
            </div>
            <div class="row">
                <div class="col-2">
                    <h1>
                        Give your Workout<br />
                        A New Style!
                    </h1>
                    <p>
                        Success isn't always about greatness. It's about consistency.
                        Consistant <br />hard work gain sucess. Greatness will come.
                    </p>
                    <a href="product.php" class="btn">Explore Now &#8594</a>
                </div>
                <div class="col-2">
                    <img src="Imges/image1.png" />
                </div>
            </div>
        </div>
    </div>

    <!-------------------featured categories------------->
    <div class="categories">
        <div class="small-container">
            <div class="row">
                <div class="col-3">
                    <img src="Imges/category-1.jpg">
                </div>
                <div class="col-3">
                    <img src="Imges/category-2.jpg">
                </div>
                <div class="col-3">
                    <img src="Imges/category-3.jpg">
                </div>
            </div>
        </div>
    </div>

    <!-------------------featured products------------->
    <div class="small-container">
        <h2 class="title">Featured Products</h2>
        <?php
        if (isset($_SESSION['email'])) {
        ?>
            <div class="row">
                <?php
                foreach ($products as $product) {
                ?>
                    <div class="col-4">
                        <a href="product details.php?id=<?php echo $product['_id']; ?>">
                            <img src="Imges/<?php echo $product['imgUrl']; ?>" alt="<?php echo $product['name']; ?>">
                            <h4><?php echo $product['name']; ?></h4>
                        </a>
                        <div class="rating">

                            <?php
                            for ($i = 1; $i <= 5; $i++) {
                                echo ($i <= $product['rating']) ? '<i class="fa fa-star"></i>' : '<i class="fa fa-star-o"></i>';
                            }
                            ?>
                        </div>
                        <p>RS.<?php echo $product['price']; ?></p>
                    </div>
                <?php
                }
                ?>
            </div>
        <?php
        } else {
        ?>
            <div class="row">
                <div class="col-4">
                    <a href="product.php"><img src="Imges/product-1.jpg"></a>
                    <a href="product.php">
                        <h4>Red Printed T-Shirts</h4>
                    </a>
                    <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>
                    </div>
                    <p>RS.250.00</p>
                </div>
                <div class="col-4">
                    <a href="product.php"><img src="Imges/product-2.jpg"></a>
                    <a href="product.php">
                        <h4>Fast-x Black Shoes </h4>
                    </a>
                    <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half-o"></i>
                        <i class="fa fa-star-o"></i>
                    </div>
                    <p>RS.450.00</p>
                </div>
                <div class="col-4">
                    <a href="product.php"><img src="Imges/product-3.jpg"></a>
                    <a href="product.php">
                        <h4>Sports Classic Track</h4>
                    </a>
                    <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half-o"></i>
                    </div>
                    <p>RS.500.00</p>
                </div>
                <div class="col-4">
                    <a href="product.php"><img src="Imges/product-4.jpg"></a>
                    <a href="product.php">
                        <h4>Blue Printed T-Shirts</h4>
                    </a>
                    <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>
                    </div>
                    <p>RS.250.00</p>
                </div>
            </div>
        <?php
        }
        ?>

    </div>
    <!-----------------offer----------------->
    <div class="offer">
        <div class="small-container">
            <div class="row">
                <div class="col-2">
                    <img src="Imges/exclusive.png" class="offer-img">
                </div>
                <div class="col-2">
                    <p>Exclusively Available On RedStore</p>
                    <h1>Smart Band 4</h1>
                    <small>The Mi Smart Band 4 features a 39.9% larger
                        (than Mi Band 3)AMOLED color full-touch display with
                        adjustable brightness, so everything is clear as can
                        be.</small><br>
                    <a href="" class="btn">Buy Now &#8594;</a>
                </div>
            </div>
        </div>
    </div>
    <!-- -------------testimonial------------------- -->
    <div class="testimonial">
        <div class="small-container">
            <div class="row">
                <div class="col-3">
                    <i class="fa fa-quote-left"></i>
                    <p>Lorem Ipsum is simply dummy text of the printing
                        and typesetting industry. Lorem Ipsum has been the
                        industry's standard dummy text ever
                    </p>
                    <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>
                    </div>
                    <img src="Imges/user-1.png">
                    <h3>Sean Parker</h3>
                </div>
                <div class="col-3">
                    <i class="fa fa-quote-left"></i>
                    <p>Lorem Ipsum is simply dummy text of the printing
                        and typesetting industry. Lorem Ipsum has been the
                        industry's standard dummy text ever
                    </p>
                    <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>
                    </div>
                    <img src="Imges/user-2.png">
                    <h3>Mike Smith</h3>
                </div>
                <div class="col-3">
                    <i class="fa fa-quote-left"></i>
                    <p>Lorem Ipsum is simply dummy text of the printing
                        and typesetting industry. Lorem Ipsum has been the
                        industry's standard dummy text ever
                    </p>
                    <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>
                    </div>
                    <img src="Imges/user-3.png">
                    <h3>Mable Joe</h3>
                </div>
            </div>
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
            <p class="copyright">Copyright 2024 - Easy Tutorials</p>
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