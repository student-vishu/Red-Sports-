<?php
session_start();

require '../actions/vendor/autoload.php';

if (!isset($_SESSION['adminemail'])) {
    header('location: ../account.php');
    exit();
}

$databaseconnection = new MongoDB\Client;

$myDatabase = $databaseconnection->myDB;

$usersCollection = $myDatabase->users;

if (isset($_GET['id'])) {
    $userId = new MongoDB\BSON\ObjectId($_GET['id']);
    $user = $usersCollection->findOne(['_id' => $userId]);

    if (!$user) {
        die('User not found');
    }
} else {
    die('User Id is Missing');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phoneno = $_POST['phoneno'];

    $usersCollection->updateOne(
        ['_id' => $userId],
        ['$set' => [
            'Fname' => $fname,
            'Lname' => $lname,
            'Email' => $email,
            'Phone No' => $phoneno
        ]]
    );
    header('location:manage-users.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap"
        rel="stylesheet" />
    <link
        rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: radial-gradient(#fff, #ffd6d6);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: pink;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        label {
            font-weight: bold;
            margin-top: 10px;
            display: block;
            color: #333;
        }

        input[type="text"],
        input[type="number"] {
            width: 95%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        input[type="email"] {
            width: 95%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #218838;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #007bff;
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Edit User</h2>
        <form action="" method="post">
            <label for="fname">First Name:</label>
            <input type="text" id="fname" name="fname" value="<?php echo $user['Fname']; ?>" required>

            <label for="lname">Last Name:</label>
            <input type="text" id="lname" name="lname" value="<?php echo $user['Lname']; ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $user['Email']; ?>" required>

            <label for="phoneno">Phone No:</label>
            <input type="number" id="phoneno" name="phoneno" value="<?php echo $user['Phone No']; ?>" required>

            <button type="submit">Update User</button>
        </form>
        <a class="back-link" href="manage-users.php">Back to Manage Users</a>
    </div>
</body>

</html>