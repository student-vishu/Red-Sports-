<?php
session_start();

require '../actions/vendor/autoload.php';

if (!isset($_SESSION['adminemail'])) {
    header('location: ../account.php');
    exit();
}

$databaseconnection = new MongoDB\Client;

$myDatabase = $databaseconnection->myDB;

$productsCollection = $myDatabase->product;

if (isset($_GET['id'])) {
    $productId = new MongoDB\BSON\ObjectId($_GET['id']);
    $product = $productsCollection->findOne(['_id' => $productId]);

    if (!$product) {
        die('Product not found');
    }
} else {
    die('Product Id is Missing');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $imgUrl = $_POST['imgUrl'];
    $rating = $_POST['rating'];

    $productsCollection->updateOne(
        ['_id' => $productId],
        ['$set' => [
            'name' => $name,
            'category' => $category,
            'price' => $price,
            'imgUrl' => $imgUrl,
            'rating' => $rating
        ]]
    );
    header('location:manage-products.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap"
        rel="stylesheet" />
    <link
        rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: radial-gradient(#fff, #ffd6d6);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: pink;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        label {
            font-weight: bold;
            margin-top: 10px;
            display: block;
            color: #333;
        }

        input[type="text"],
        input[type="number"] {
            width: 95%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #218838;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #007bff;
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Edit Product</h2>
        <form action="" method="post">
            <label for="name">Product Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $product['name']; ?>" required>

            <label for="category">Category:</label>
            <input type="text" id="category" name="category" value="<?php echo $product['category']; ?>" required>

            <label for="price">Price:</label>
            <input type="number" id="price" name="price" step="0.01" value="<?php echo $product['price']; ?>" required>

            <label for="imgUrl">Image URL:</label>
            <input type="text" id="imgUrl" name="imgUrl" value="<?php echo $product['imgUrl']; ?>" required>

            <label for="rating">Rating:</label>
            <input type="number" id="rating" name="rating" value="<?php echo $product['rating']; ?>" required>

            <label for="description">Description:</label>
            <input type="text" id="description" name="description" value="<?php echo $product['description'] ?>" required><br>

            <button type="submit">Update Product</button>
        </form>
        <a class="back-link" href="manage-products.php">Back to Manage Products</a>
    </div>
</body>

</html>