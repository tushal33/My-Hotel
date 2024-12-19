<?php
// Include the database configuration
require('config.php');
session_start();

// Check if the user is logged in (i.e., user_id is set in the session)
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");  // Redirect to login page if not logged in
    exit();
}

// Get user_id from session
$user_id = $_SESSION['user_id'];

// Fetch user data from the database based on the user_id
$sql = "SELECT id, username,aadhar,mobile, created_at FROM users WHERE id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Check if the user exists
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();  // Fetch the user data
} else {
    header("Location: login.php");  // Redirect to login if user not found
    exit();
}

// Optional: you can add a logout feature or any other useful features for the dashboard
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
    }

    header {
        background-color: #333;
        color: #fff;
        padding: 15px 20px;
        text-align: center;
    }

    nav {
        margin: 20px;
    }

    nav a {
        text-decoration: none;
        padding: 10px;
        background-color: #333;
        color: white;
        border-radius: 5px;
        margin-right: 10px;
    }

    nav a:hover {
        background-color: #555;
    }

    .dashboard-content {
        margin: 20px;
    }

    .user-info {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .user-info p {
        margin: 10px 0;
    }

    .logout {
        margin-top: 20px;
    }
    </style>
</head>

<body>

    <header>
        <h1>Welcome to Your Profile <?php echo htmlspecialchars($user['username']); ?> </h1>
    </header>

    <nav>
        <a href="editprofil.php">Edit Profile</a>
        <a href="dashboard.php">back Dashboard</a>
    </nav>

    <div class="dashboard-content">
        <div class="user-info">
            <h2>User Information</h2>
            <p><strong>User ID:</strong> <?php echo htmlspecialchars($user['id']); ?></p>
            <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
            <p><strong>Aadhar Card Number:</strong> <?php echo htmlspecialchars($user['aadhar']);?></p>
            <p><strong>Mobile Number:</strong> <?php echo htmlspecialchars($user['mobile']);?></p>
            <p><strong>Account Created:</strong> <?php echo htmlspecialchars($user['created_at']); ?></p>
        </div>
    </div>

</body>

</html>