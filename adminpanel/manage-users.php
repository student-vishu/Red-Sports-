<?php
session_start();
require '../actions/vendor/autoload.php';

$databaseconnection = new MongoDB\Client;
$myDatabase = $databaseconnection->myDB;

$adminsCollection = $myDatabase->admins;
$adminEmail = $_SESSION['adminemail'];
$data1 = array("Email" => $adminEmail);
$fetch = $adminsCollection->findOne($data1);

$userCollection = $myDatabase->users;
$fetchUser = $userCollection->find();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel | Manage User</title>
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
            width: 230px;
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

        .welcome-name {
            text-align: center;
            margin-bottom: 20px;
        }

        .add-product-btn {
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 30px;
            padding: 10px 15px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .add-product-btn:hover {
            background-color: tomato;
            transform: scale(1.05);
        }

        .add-product-btn:active {
            background-color: #1e7e34;
            transform: scale(0.95);
        }

        .add-product-btn:focus {
            outline: none;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
        }


        .products-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .products-table th,
        .products-table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }

        .products-table th {
            background-color: tomato;
            font-size: 20px;
            font-weight: 600;
        }

        .product-img {
            width: 60px;
            height: 60px;
            object-fit: cover;
        }

        .action-btn {
            padding: 5px 10px;
            margin: 0 5px;
            border: none;
            cursor: pointer;
            color: #fff;
        }

        .edit-btn {
            background-color: #007bff;
            border-radius: 30px;
        }

        .delete-btn {
            background-color: #dc3545;
            border-radius: 30px;
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
                echo "Welcome, Admin - " . $fetch['Fnamee'] . " " . $fetch['Lnamee'] . "";
            }
            ?>
        </div>

        <table class="products-table">
            <tr>
                <th>Fname</th>
                <th>Lname</th>
                <th>Email</th>
                <th>Phone No</th>
                <th>Password</th>
                <th>Actions</th>
            </tr>
            <?php
            foreach ($fetchUser as $user) {
                echo "<tr>
                        <td>{$user['Fname']}</td>
                        <td>{$user['Lname']}</td>
                        <td>{$user['Email']}</td>
                        <td>{$user['Phone No']}</td>
                        <td>{$user['Password']}</td>
                        <td>
                            <button class='action-btn edit-btn' onclick=\"window.location.href='edit-user.php?id={$user['_id']}'\">Edit</button>
                            <button class='action-btn delete-btn' onclick=\"window.location.href='delete-user.php?id={$user['_id']}'\">Delete</button>
                        </td>
                    </tr>";
            }
            ?>



        </table>
    </div>
</body>

</html>