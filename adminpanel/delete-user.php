<?php
session_start();

require '../actions/vendor/autoload.php';

if (!isset($_SESSION['adminemail'])) {
    header('location:../account.php');
}

$databaseconnection = new MongoDB\Client;
$myDatabase = $databaseconnection->myDB;
$usersCollection = $myDatabase->users;

if (isset($_GET['id'])) {
    $userId = new MongoDB\BSON\ObjectId($_GET['id']);

    $deleteResult = $usersCollection->deleteOne(['_id' => $userId]);

    if ($deleteResult->getDeletedCount() === 1) {
        echo "User Successfully Deleted";
    } else {
        echo "User not Found";
    }

    header('location: manage-users.php');
    exit();
} else {
    die('User Id is Missing');
}
