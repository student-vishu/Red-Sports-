<?php
session_start();
require 'vendor/autoload.php';

if (!isset($_SESSION['email'])) {
    header('location:account.php');
    exit();
}

$databaseConnection = new MongoDB\Client;
$myDatabase = $databaseConnection->myDB;
$cartCollection = $myDatabase->cart;

if (isset($_POST['Pid'])) {
    $email = $_SESSION['email'];
    $pid = $_POST['Pid'];
}

$data = array(
    'Email' => $email,
    'Pid' => $pid
);

$cartItem = $cartCollection->findOne($data);

if ($cartItem) {
    $currentQuantity = $cartItem['Pquantity'];
    $price = $cartItem['Price'];

    if (isset($_POST['increase'])) {
        $newQuantity = $currentQuantity + 1;
    } elseif (isset($_POST['decrease'])) {
        $newQuantity = max(1, $currentQuantity - 1);
    }

    $newTotalPrice = $newQuantity * $price;

    $cartCollection->updateOne(
        ['Email' => $email, 'Pid' => $pid],
        [
            '$set' =>
            [
                'Pquantity' => $newQuantity,
                'total_price' => $newTotalPrice
            ]
        ]
    );
}

header('location:../cart.php');
exit();
