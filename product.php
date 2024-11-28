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

$filterOption = [];
$sortOption = [];

if (isset($_GET['search'])) {
  $searchquery = $_GET['search'];
  $filterOption['name'] = ['$regex' => $searchquery, '$options' => 'i']; //this $regex is regular expression for searching.its have two parameter(pattern,options).and in this 'i' is option and 'i' means it search case-insensitive.
}

if (isset($_GET['sort'])) {
  if ($_GET['sort'] == 'Low To High') {
    $sortOption = ['price' => 1];
  } elseif ($_GET['sort'] == 'High To Low') {
    $sortOption = ['price' => -1];
  }
}
$products = $productsCollection->find($filterOption, ['sort' => $sortOption]);

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

<body style="background-color: antiquewhite;">
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

  <div class="small-container" style="background-color: beige;">
    <h2 class="ptitle">All Products</h2>
    <div class="row row-2">
      <form action="product.php" method="get" class="search_filter">
        <select name="sort" onchange="this.form.submit()">
          <option value="">Filter</option>
          <option value="Low To High" <?php echo isset($_GET['sort']) && $_GET['sort'] == 'Low To High' ? 'selected' : ''; ?>>Price: Low To High</option>
          <option value="High To Low" <?php echo isset($_GET['sort']) && $_GET['sort'] == 'High To Low' ? 'selected' : ''; ?>>Price: High To Low</option>
        </select>

        <div class="search">
          <input type="text" name="search" placeholder="search here.." value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
          <input type="submit" class="btn" name="search_btn" value="Search">
        </div>
      </form>
    </div>
    <div class="row">
      <?php
      foreach ($products as $product) {
      ?>

        <div class="col-4">
          <a href="product details.php?id=<?php echo $product['_id']; ?>">
            <img src="Imges/<?php echo $product['imgUrl']; ?>" alt="<?php echo $product['name'] ?>">
            <h4><?php echo $product['name'] ?></h4>
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
    <div class="page-btn">
      <!-- <span><a>1</a></span>
      <span>2</span>
      <span>3</span>
      <span>4</span>
      <span>&#8594;</span> -->
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
</body>

</html>