<?php

use MongoDB\Operation\InsertOne;

require 'vendor/autoload.php';

//connect to the mongoDB Database
$databaseConnection = new MongoDB\Client;

//connecting to the specific database (myDB)
$myDatabase = $databaseConnection->myDB;

//connecting to our monoDB collection
$userCollection = $myDatabase->users;


if (isset($_POST['signup'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phoneno = $_POST['phoneno'];
    $password = $_POST['password'];
}

$data = array(
    "Fname" => $fname,
    "Lname" => $lname,
    "Email" => $email,
    "Phone No" => $phoneno,
    "Password" => $password
);

$insert = $userCollection->insertOne($data);

if ($insert) {
    header('location: ../account.php?msg=777');
} else {
    header('location: ../account.php?msg=18');
}




// if ($userCollection) {
//     echo "collection ".$userCollection." connected";
// } else {
//     echo 'fail';
// }

/*if (isset($_POST['signup'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phoneNo = $_POST['phoneNo'];
    $password = sha1($_POST['password']);
}

$data = array(
    "Firstname" => $fname,
    "Lastname" => $lname,
    "Email" => $email,
    "Phone Number" => $phoneNo,
    "Password" => $password
);

//insert into mongodb user collection

$insert = $userCollection->insertOne($data);

if ($insert) {

?>
    <center>
        <h4 style="color: green;">Successfully Registered</h4>
    </center>
    <center><a href="../account.php">Login</a></center>
<?php
} else {

?>
    <center>
        <h4 style="color: red;">Registered Failed</h4>
    </center>
    <center><a href="../account.php">Try Again</a></center>
<?php
}*/
