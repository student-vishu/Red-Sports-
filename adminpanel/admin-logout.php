<?php
session_start();

unset($_SESSION['adminemail']);

session_destroy();

header('location:../account.php');
