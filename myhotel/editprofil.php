<?php
session_start();
require 'config.php'; // Ensure this file includes the database connection

$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';
$firstLetter = strtoupper($username[0]);

// Initialize variables for error and success messages
$error = $success = "";

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_password'])) {
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    // Retrieve the user's current hashed password from the database
    $stmt = $con->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($hashed_password);
    $stmt->fetch();
    $stmt->close();

    if (password_verify($old_password, $hashed_password)) {
        if ($new_password === $confirm_password) {
            // Hash the new password
            $new_hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

            // Update the password in the database
            $stmt = $con->prepare("UPDATE users SET password = ? WHERE username = ?");
            $stmt->bind_param("ss", $new_hashed_password, $username);
            if ($stmt->execute()) {
                $success = "Password updated successfully!";
            } else {
                $error = "An error occurred while updating the password. Please try again.";
            }
            $stmt->close();
        } else {
            $error = "New passwords do not match!";
        }
    } else {
        $error = "Old password is incorrect!";
    }
    $con->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="style.css">
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
        <h1>Edit Your Profile </h1>
    </header>
    <nav>
        <a href="profile.php">Profile</a>
    </nav>
    <div class="container dashboard-content user-info">
        <h1>Edit Profile</h1>
        <?php if ($error): ?>
        <div class="message error"><?php echo $error; ?></div>
        <?php endif; ?>
        <?php if ($success): ?>
        <div class="message success"><?php echo $success; ?>
        </div>
        <?php endif; ?>
        <form action="editprofil.php" method="post">
            <div class="form-group">
                <label for="old_password">Old Password</label>
                <input type="password" name="old_password" id="old_password" required>
            </div>
            <div class="form-group">
                <label for="new_password">New Password</label>
                <input type="password" name="new_password" id="new_password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm New Password</label>
                <input type="password" name="confirm_password" id="confirm_password" required>
            </div>
            <div class="form-group">
                <button type="submit" name="update_password" id="myBtn" class="btn">Update Password</button>
            </div>
        </form>
    </div>
</body>

</html>