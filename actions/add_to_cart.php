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

if (isset($_POST['submit'])) {
    $email = $_SESSION['email'];
    $pid = $_POST['pid'];
    $purl = $_POST['purl'];
    $pname = $_POST['pname'];
    $price = (float)$_POST['price'];
    $psize = $_POST['psize'];
    $pquantity = (int)$_POST['pquantity'];
    $total_price = $price * $pquantity;

    $data = array(
        'Email' => $email,
        'Pid' => $pid,
        'Purl' => $purl,
        'Pname' => $pname,
        'Price' => $price,
        'Psize' => $psize,
        'Pquantity' => $pquantity,
        'total_price' => $total_price
    );

    $data1 = array(
        'Email' => $email,
        'Pid' => $pid
    );

    $existingItem = $cartCollection->findOne($data1);

    if ($existingItem) {
        $newQuantity = $existingItem['Pquantity'] + $pquantity;
        $newTotalPrice = $newQuantity * $price;
        $newSize = $psize;

        $cartCollection->updateOne(
            ['_id' => $existingItem['_id']],
            ['$set' => [
                'Psize' => $newSize,
                'Pquantity' => $newQuantity,
                'total_price' => $newTotalPrice
            ]]
        );
    } else {
        $cartCollection->insertOne($data);
    }

    header("location: ../cart.php");
}
