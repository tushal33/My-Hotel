<?php
require('../config.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT id, username, hotel_name, mobile FROM admins WHERE id = ?";
$stmt = $con->prepare($sql);

if ($stmt) {
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $admin = $result->fetch_assoc();
} else {
    die("Error preparing the statement: " . $con->error);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
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
    </style>
</head>

<body>

    <header>
        <h1>Welcome to Your Profile <?php echo htmlspecialchars($admin['username']); ?> </h1>
    </header>

    <nav>
        <a href="dashboard.php">Back to Dashboard</a>
    </nav>

    <div class="dashboard-content">
        <div class="user-info">
            <h2>Admin Information</h2>
            <?php if ($admin): ?>
            <p><strong>User ID:</strong> <?php echo htmlspecialchars($admin['id']); ?></p>
            <p><strong>Username:</strong> <?php echo htmlspecialchars($admin['username']); ?></p>
            <p><strong>Hotel Name:</strong> <?php echo htmlspecialchars($admin['hotel_name']); ?></p>
            <p><strong>Mobile Number:</strong> <?php echo htmlspecialchars($admin['mobile']); ?></p>
            <?php else: ?>
            <p>No admin information found.</p>
            <?php endif; ?>
        </div>
    </div>

</body>

</html>