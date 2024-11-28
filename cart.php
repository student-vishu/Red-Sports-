<?php

use MongoDB\Operation\InsertOne;

session_start();
if (!isset($_SESSION['email'])) {
  header('location:account.php');
  exit();
}
require 'actions/vendor/autoload.php';

//connect to the mongoDB Database
$databaseConnection = new MongoDB\Client;

//connecting to the specific database (myDB)
$myDatabase = $databaseConnection->myDB;

//connecting to our monoDB collection
$cartCollection = $myDatabase->cart;
$userCollection = $myDatabase->users;


$email = $_SESSION['email'];

$cartItems = $cartCollection->find(['Email' => $email]);
$fetch = $userCollection->findOne(['Email' => $email]);
$cartItemsArray = iterator_to_array($cartItems);

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
    ?>.quantity-btn {
      padding: 5px 10px;
      border: 1px solid #ccc;
      background-color: tomato;
      cursor: pointer;
      color: white;
    }

    .quantity-btn:hover {
      background-color: #ddd;
    }
  </style>
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap"
    rel="stylesheet" />
  <link
    rel="stylesheet"
    href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>

<body style=" background: radial-gradient(#fff, #ffd6d6);">
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
  <!-- ----------------cart items details-------------- -->

  <div class="small-container cart-page" style="background-color: mistyrose;">
    <?php
    if (count($cartItemsArray) == 0) {
      echo "Your Cart is Empty!!!";
    } else {
    ?>
      <table>
        <tr>
          <th>Product</th>
          <th>Quantity</th>
          <th>Subtotal</th>
        </tr>
        <?php
        $total = 0;
        foreach ($cartItemsArray as $item) {
          $subtotal = $item['Price'] * $item['Pquantity'];
          $total = $total + $subtotal;
        ?>
          <tr>
            <td>
              <div class="cart-info">
                <img src="<?php echo $item['Purl']; ?> " />
                <div>
                  <p><?php echo $item['Pname']; ?></p>
                  <small>Size:<?php echo $item['Psize']; ?></small><br>
                  <small>Price:<?php echo $item['Price']; ?> </small><br />
                  <form action="actions/remove.php" method="post">
                    <input type="hidden" name="Pid" value="<?php echo $item['Pid'] ?>">
                    <input type="submit" value="Remove" name="remove" id="remove" class="btn">
                  </form>
                </div>
              </div>
            </td>

            <td>
              <form action="actions/update_cart.php" method="post">
                <input type="hidden" name="Pid" value="<?php echo $item['Pid']; ?>" />
                <button type="submit" name="decrease" class="quantity-btn">-</button>
                <input type="text" name="Pquantity" style="width: 10%;" value="<?php echo $item['Pquantity']; ?>" readonly />
                <button type="submit" name="increase" class="quantity-btn">+</button>
              </form>
            </td>
            <td><?php echo $subtotal; ?></td>
          </tr>
        <?php } ?>
      </table>

      <div class="total-price">
        <table>
          <tr>
            <td>Subtotal</td>
            <td><?php echo $total; ?></td>
          </tr>
          <tr>
            <td>Tax</td>
            <td><?php echo $total * 0.18; ?></td>
          </tr>
          <tr>
            <td>Total</td>
            <td id="total"><?php echo $total + ($total * 0.18); ?></td>
          </tr>
          <tr>
            <td><button class="btn" onclick="payment('<?php echo $fetch['Fname'] ?>')" style="width: 135%;cursor: pointer;">Payment</button></td>
            <script>
              var total = parseFloat(document.getElementById('total').textContent);

              function payment(userName) {
                if (total > 0) {
                  alert('Hello ' + userName + ', Your Payment amount is ' + total + ' INR.')
                }
              }
            </script>
          </tr>
        </table>
      </div>
    <?php } ?>
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
      <!-- <p class="copyright">Copyright 2020 - Easy Tutorials</p> -->
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