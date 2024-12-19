<?php
session_start();
require 'config.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Check if username exists
    $query = $con->prepare("SELECT id, password FROM users WHERE username = ?");
    $query->bind_param('s', $username);
    $query->execute();
    $query->store_result();

    if ($query->num_rows == 0) {
        $error = 'Username not found.';
    } else {
        // Fetch the hashed password from the database
        $query->bind_result($id, $hashed_password);
        $query->fetch();

        // Verify the password
        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $username;
            header('Location: dashboard.php');
            exit();
        } else {
            $error = 'Invalid password.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <style>
    body {
        background-image: url(mk.jpg);
        background-size: cover;
        font-family: sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        margin: 0;
    }

    .container {
        background-color: rgba(255, 255, 255, 0.8);
        padding: 50px;
        border-radius: 10px;
        text-align: center;
    }

    input[type="text"],
    input[type="password"] {
        width: 350px;
        padding: 12px 20px;
        margin: 8px 0;
        display: border-box;
        border-radius: 8px;
    }

    button {
        background-color: #4CAF50;
        color: white;
        padding: 12px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        border-radius: 5px;
        width: 150px;
    }

    button:hover {
        background-color: #45a049;
    }

    .checkbox {
        margin: 10px 0;
    }
    </style>
</head>

<body>
    <div class="container">
        <h1>Login</h1>
        <!-- Display error message -->
        <?php if ($error): ?>
        <div style="color: red;"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="post" action="login.php">
            <input type="text" name="username" id="username" placeholder="Username" required>
            <br>
            <input type="password" name="password" id="password" placeholder="Password" required>
            <br>
            <button type="submit" value="login">LOGIN</button>
            <p>Don't have an account? <a href="register.php">Register</a></p>
        </form>
    </div>
</body>

</html>