<?php
session_start();

use MongoDB\Operation\FindOne;

require 'vendor/autoload.php';

$databaseconnection = new MongoDB\Client;

$myDatabase = $databaseconnection->myDB;

$userCollection = $myDatabase->users;

$adminsCollection = $myDatabase->admins;

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $data = array(
        "Email" => $email,
        "Password" => $password
    );

    $fetchAdmin = $adminsCollection->FindOne($data);
    $fetchUser = $userCollection->FindOne($data);
    $minPasswordLength = 4;

    if (!empty($fetchAdmin['Email']) && filter_var($fetchAdmin['Email'], FILTER_VALIDATE_EMAIL)) {
        if (!empty($fetchAdmin['Password']) && strlen($fetchAdmin['Password'] >= $minPasswordLength)) {
            $_SESSION['adminemail'] = $fetchAdmin['Email'];
        }
        header('location:../adminpanel/dashboard.php');
        exit();
    } elseif (!empty($fetchUser['Email']) && filter_var($fetchUser['Email'], FILTER_VALIDATE_EMAIL)) {
        if (!empty($fetchUser['Password']) && strlen($fetchUser['Password'] >= $minPasswordLength)) {
            $_SESSION['email'] = $fetchUser['Email'];
        }
        header('location:../index1.php');
    } else {
?>
        <Center><a href="../account.php">Try Again</a></Center>
<?php
    }
}




// if (isset($_POST['login'])) {
//     $email = $_POST['email'];
//     $password = $_POST['password'];
// }

// $data = array(
//     "Email" => $email,
//     "Password" => $password
// );

// //fetch user from mongodb users collection

// $fetch = $userCollection->FindOne($data);

// $minPasswordLength = 4;


// if (!empty($fetch['Email']) && filter_var($fetch['Email'], FILTER_VALIDATE_EMAIL)) {
//     if (!empty($fetch['Password']) && strlen($fetch['Password'] >= $minPasswordLength)) {

//         //create a session
//         $_SESSION['email'] = $fetch['Email'];
//         // $_SESSION['password'] = $fetch['Password'];
//     }
//     //redirect to the home page
//     header('location: ../index1.php');
//     exit();
// } else {
?>
<!-- <Center>
        <h4 style="color: red;">User Not Found!!</h4>
    </Center>
    <Center><a href="../account.php">Try Again</a></Center> -->
<?php
//}
