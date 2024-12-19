<?php
session_start();
require '../config.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $hotel_name = $_POST['hotel_name'];
    $mobile = $_POST['mobile']; 
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (strlen($mobile) != 10 || !ctype_digit($mobile)) {
        $error = 'Mobile number must be 10 digits.';
    }
    elseif ($password !== $confirm_password) {
        $error = 'Passwords do not match.';
    } else {
        $query = $con->prepare("SELECT id FROM admins WHERE username = ?");
        $query->bind_param('s', $username);
        $query->execute();
        $query->store_result();

        if ($query->num_rows > 0) {
            $error = 'Username already taken.';
        } else {
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            $insert = $con->prepare("INSERT INTO admins (username, hotel_name, mobile, password) VALUES (?, ?, ?, ?)");
            $insert->bind_param('ssss', $username, $hotel_name, $mobile, $hashed_password);
            if ($insert->execute()) {
                $success = 'Registration successful! You can now <a href="login.php">login</a>.';
                header("Location:index.php");
            } else {
                $error = 'An error occurred. Please try again.';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Admin Register</title>
    <style>
    body {
        background-image: url(../room/admin.jpg);
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
    input[type="password"],
    input[type="number"] {
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
        <h1>Admin Register</h1>
        <?php if ($error): ?>
        <div style="color: red;"><?php echo $error; ?></div>
        <?php endif; ?>
        <?php if ($success): ?>
        <div style="color: green;"><?php echo $success; ?></div>
        <?php endif; ?>
        <form method="post" action="register.php">
            <input type="text" name="username" id="username" placeholder="Username" required>
            <br>
            <input type="text" name="hotel_name" id="hotel_name" placeholder="Hotel Name" required>
            <br>
            <input type="number" name="mobile" id="mobile" placeholder="Mobile Number" required>
            <br>
            <input type="password" name="password" id="password" placeholder="Password" required>
            <br>
            <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password"
                required>
            <br>
            <button type="submit">Register</button>
            <p>Already have an account? <a href="index.php">Login</a></p>
        </form>
    </div>
</body>

</html>