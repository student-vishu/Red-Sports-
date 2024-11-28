<?php
session_start();

require '../actions/vendor/autoload.php';

if (!isset($_SESSION['adminemail'])) {
    header('location:../account.php');
}

$databaseconnection = new MongoDB\Client;
$myDatabase = $databaseconnection->myDB;
$productsCollection = $myDatabase->product;

if (isset($_GET['id'])) {
    $productId = new MongoDB\BSON\ObjectId($_GET['id']);

    $deleteResult = $productsCollection->deleteOne(['_id' => $productId]);

    if ($deleteResult->getDeletedCount() === 1) {
        echo "Product Successfully Deleted";
    } else {
        echo "Product not Found";
    }

    header('location: manage-products.php');
    exit();
} else {
    die('Product Id is Missing');
}
