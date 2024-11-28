<?php
session_start();

require 'actions/vendor/autoload.php';

if (!isset($_SESSION['email'])) {
  header('location:account.php');
  exit();
}

$databaseconnection = new MongoDB\Client;

$myDatabase = $databaseconnection->myDB;

$productsCollection = $myDatabase->product;

if (isset($_GET['id'])) {
  $productId = new MongoDB\BSON\ObjectId($_GET['id']);
  $product = $productsCollection->findOne(['_id' => $productId]);

  if (!$product) {
    die('Product not Found');
  }
} else {
  die('Product Id is missing');
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
</head>

<body>
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

  <!-- ---------------------single product detail------------ -->
  <form action="actions/add_to_cart.php" method="POST">
    <div class="small-container single-product">
      <div class="row">
        <div class="col-2">
          <img src="Imges/<?php echo $product['imgUrl']; ?>" width="100%" id="ProductImg">
        </div>

        <div class="col-2">
          <p>Home / <?php echo $product['category']; ?></p>
          <h1><?php echo $product['name']; ?></h1>
          <h4>RS.<?php echo $product['price']; ?></h4>

          <select name="psize">
            <option>Select Size</option>
            <option value="XXL">XXL</option>
            <option value="XL">XL</option>
            <option value="Large">Large</option>
            <option value="Medium">Medium</option>
            <option value="Small">Small</option>
          </select>

          <input type="number" value="1" min="1" name="pquantity" />
          <button type="submit" name="submit" class="btn">Add To Cart</button>

          <h3>Product Details<i class="fa fa-indent"></i></h3>
          <br />
          <p><?php echo $product['description']; ?></p>
          <input type="hidden" value="Imges/<?php echo $product['imgUrl']; ?>" name="purl">
          <input type="hidden" value="<?php echo $product['_id']; ?>" name="pid">
          <input type="hidden" value="<?php echo $product['name']; ?>" name="pname">
          <input type="hidden" name="price" value="<?php echo $product['price']; ?>">
        </div>
      </div>
    </div>
  </form>

  <!-- ------------------title----------------- -->
  <div class="small-container">
    <div class="row row-2">
      <h2>Related Products</h2>
      <p>View More</p>
    </div>
  </div>

  <!-- ------------------products------------------ -->
  <div class="small-container">
    <div class="row">
      <div class="col-4">
        <img src="Imges/product-9.jpg" />
        <h4>Casual Watch</h4>
        <div class="rating">
          <i class="fa fa-star"></i>
          <i class="fa fa-star"></i>
          <i class="fa fa-star"></i>
          <i class="fa fa-star"></i>
          <i class="fa fa-star-o"></i>
        </div>
        <p>RS.750.00</p>
      </div>
      <div class="col-4">
        <img src="Imges/product-10.jpg" />
        <h4>HRX Running Shoes</h4>
        <div class="rating">
          <i class="fa fa-star"></i>
          <i class="fa fa-star"></i>
          <i class="fa fa-star"></i>
          <i class="fa fa-star"></i>
          <i class="fa fa-star-o"></i>
        </div>
        <p>RS.1250.00</p>
      </div>
      <div class="col-4">
        <img src="Imges/product-11.jpg" />
        <h4>Formal Shoes</h4>
        <div class="rating">
          <i class="fa fa-star"></i>
          <i class="fa fa-star"></i>
          <i class="fa fa-star"></i>
          <i class="fa fa-star"></i>
          <i class="fa fa-star-o"></i>
        </div>
        <p>RS.850.00</p>
      </div>
      <div class="col-4">
        <img src="Imges/product-12.jpg" />
        <h4> Classic Black Track </h4>
        <div class="rating">
          <i class="fa fa-star"></i>
          <i class="fa fa-star"></i>
          <i class="fa fa-star"></i>
          <i class="fa fa-star"></i>
          <i class="fa fa-star-o"></i>
        </div>
        <p>RS.500.00</p>
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

  <!-- --------------------js for product gallery-------------- -->
  <script>
    var productimg = document.getElementById('ProductImg');
    var SmallImg = document.getElementsByClassName('small-img');
    SmallImg[0].onclick = function() {
      productimg.src = SmallImg[0].src;
    };
    SmallImg[1].onclick = function() {
      productimg.src = SmallImg[1].src;
    };
    SmallImg[2].onclick = function() {
      productimg.src = SmallImg[2].src;
    };
    SmallImg[3].onclick = function() {
      productimg.src = SmallImg[3].src;
    };
  </script>
</body>

</html>