<?php
session_start();

require 'vendor/autoload.php';

$databaseconnection = new MongoDB\Client;
$myDatabase = $databaseconnection->myDB;
$contactCollection = $myDatabase->contact;

if (isset($_POST['contactus'])) {
    $fname = $_POST['fname'];
    $email = $_POST['email'];
    $phoneno = $_POST['phoneno'];
    $message = $_POST['message'];

    if (empty($fname) || empty($phoneno) || empty($message)) {
        echo "Please fill in all required fields!";
    } else {
        $result = $contactCollection->insertOne([
            'name' => $fname,
            'email' => $email,
            'phone' => $phoneno,
            'message' => $message,
            'submitted_at' => new MongoDB\BSON\UTCDateTime()
        ]);

        if ($result->getInsertedCount() > 0) {
            $_SESSION['mes'] = "Thank you for contacting us! We'll get back to you soon.";
        } else {
            $_SESSION['mes'] = "Failed to submit your message. Please try again.";
        }
    }
    header('location:../contact.php');
    exit();
}
