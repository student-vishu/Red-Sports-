<?php
session_start();
if (!isset($_SESSION['adminemail'])) {
    header('location:../account.php');
} else {
    require '../actions/vendor/autoload.php';

    $databaseconnection = new MongoDB\Client;
    $myDatabase = $databaseconnection->myDB;
    $productsCollection = $myDatabase->product;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $category = $_POST['category'];
        $price = isset($_POST['price']) ? (float) $_POST['price'] : 0; //(int)$_POST['price'];
        $imgUrl = $_POST['imgUrl'];
        $rating = $_POST['rating'];
        $description = $_POST['description'];

        $productData = [
            'name' => $name,
            'category' => $category,
            'price' => $price,
            'imgUrl' => $imgUrl,
            'rating' => $rating,
            'description' => $description
        ];

        $productsCollection->insertOne($productData);
        header('location: manage-products.php');
    }
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
        input[type="number"],
        select {
            width: 96%;
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
        <h2>Add New Product</h2>
        <form action="" method="post">
            <label for="name">Product Name:</label>
            <input type="text" name="name" required>

            <label for="category">Category:</label>
            <select name="category" id="category" style="width: 100%;">
                <option value="">Select Category</option>
                <option value="T-Shirt">T-Shirt</option>
                <option value="Shoes">Shoes</option>
                <option value="Track-Pant">Track-Pant</option>
                <option value="Socks">Socks</option>
                <option value="Watch">Watch</option>
            </select>

            <label for="price">Price:</label>
            <input type="number" name="price" step="0.01" required>

            <label for="imgUrl">Image URL:</label>
            <input type="text" name="imgUrl" required>

            <label for="rating">Rating:</label>
            <input type="number" name="rating" required>

            <label>Description:</label>
            <input type="text" name="description" required><br>

            <button type="submit">Add Product</button>
        </form>
    </div>
</body>

</html>