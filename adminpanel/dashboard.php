<?php
session_start();
if (!isset($_SESSION['adminemail'])) {
    header('location:../account.php');
} else {
    require '../actions/vendor/autoload.php';

    $databaseconnection = new MongoDB\Client;

    $myDatabase = $databaseconnection->myDB;

    $adminsCollection = $myDatabase->admins;

    $productsCollection = $myDatabase->product;

    $userCollection = $myDatabase->users;

    $contactCollection = $myDatabase->contact;

    $feedbackCollection = $myDatabase->feedback;

    $adminEmail = $_SESSION['adminemail'];
    $data = array("Email" => $adminEmail);
    $fetch = $adminsCollection->FindOne($data);

    $totalProducts = $productsCollection->countDocuments();
    $totalUsers = $userCollection->countDocuments();
    $totalContactUs = $contactCollection->countDocuments();
    $totalFeedback = $feedbackCollection->countDocuments();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Panel | Redstore</title>
    <link rel="stylesheet" href="../style1.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            display: flex;
            min-height: 100vh;
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: radial-gradient(#fff, #ffd6d6);
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #333;
            padding: 20px;
            position: fixed;
            top: 0;
            left: 0;
            overflow-y: auto;
        }

        .sidebar a {
            display: block;
            padding: 15px;
            color: #fff;
            text-decoration: none;
            margin-bottom: 5px;
        }

        .sidebar a:hover {
            background-color: #575757;
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
            width: 100%;
        }

        .dashboard-cards {
            display: flex;
            gap: 20px;
            margin-top: 20px;
        }

        .card {
            background-color: #f8f8f8;
            padding: 20px;
            flex: 1;
            text-align: center;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card h2 {
            margin: 0;
            font-size: 2rem;
        }

        .card p {
            margin: 10px 0 0;
            font-size: 1rem;
        }

        .welcome-name {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <h2 style="color:white;">Admin Panel</h2>
        <a href="dashboard.php">Dashboard</a>
        <a href="manage-products.php">Manage Products</a>
        <a href="manage-users.php">Manage Users</a>
        <a href="admin_contact.php">Contact Users</a>
        <a href="feedback.php">Feedback</a>
        <a href="admin-logout.php">Logout</a>
    </div>

    <div class="main-content">
        <div class="welcome-name">
            <?php
            if (isset($_SESSION['adminemail'])) {
                echo "Welcome, Admin - " . $fetch['Fnamee'] . " " . $fetch['Lnamee'];
            }
            ?>
        </div>

        <div class="dashboard-cards">
            <div class="card">
                <h2><?php echo $totalProducts; ?></h2>
                <p>Total Products</p>
            </div>
            <div class="card">
                <h2><?php echo $totalUsers; ?></h2>
                <p>Total Users</p>
            </div>
            <div class="card">
                <h2><?php echo $totalContactUs; ?></h2>
                <p>Total ContactUs</p>
            </div>
            <div class="card">
                <h2><?php echo $totalFeedback; ?></h2>
                <p>Total Feedbacks</p>
            </div>
        </div>
    </div>

</body>

</html>