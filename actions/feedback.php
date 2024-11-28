<?php
session_start();

require 'vendor/autoload.php';

$databaseconnection = new MongoDB\Client;
$myDatabase = $databaseconnection->myDB;
$feedbackCollection = $myDatabase->feedback;

if (isset($_POST['feedback'])) {
    $fname = $_POST['fname'];
    $email = $_POST['email'];
    $phoneno = $_POST['phoneno'];
    $message = $_POST['message'];

    if (empty($fname) || empty($phoneno) || empty($message)) {
        echo "Please fill in all required fields!";
    } else {
        $result = $feedbackCollection->insertOne([
            'name' => $fname,
            'email' => $email,
            'phone' => $phoneno,
            'message' => $message
        ]);

        if ($result->getInsertedCount() > 0) {
            $_SESSION['mes'] = "Thank you for giving feedback!.";
        } else {
            $_SESSION['mes'] = "Failed to submit your message. Please try again.";
        }
    }
    header('location:../feedback.php');
    exit();
}
