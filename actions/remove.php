<?php

use MongoDB\Operation\InsertOne;

require 'vendor/autoload.php';

//connect to the mongoDB Database
$databaseConnection = new MongoDB\Client;

//connecting to the specific database (myDB)
$myDatabase = $databaseConnection->myDB;

//connecting to our monoDB collection
$cartCollection = $myDatabase->cart;

session_start();
if (!isset($_SESSION['email'])) {
    header('location:account.php');
    exit();
}

if (isset($_POST['remove'])) {
    $email = $_SESSION['email'];
    $pid = $_POST['Pid'];

    $cartCollection->deleteOne([
        'Email' => $email,
        'Pid' => $pid
    ]);

    header('location: ../cart.php');
}
