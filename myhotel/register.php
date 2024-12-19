<?php
session_start();
require 'config.php';

$error = '';
$success = '';
$fieldErrors = []; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $aadhar = $_POST['aadhar'];
    $mobile = $_POST['mobile']; 
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($username)) {
        $fieldErrors['username'] = 'Username cannot be empty.';
    } else {
        $query = $con->prepare("SELECT id FROM users WHERE username = ?");
        $query->bind_param('s', $username);
        $query->execute();
        $query->store_result();
        if ($query->num_rows > 0) {
            $fieldErrors['username'] = 'Username already taken.';
        }
    }

    if (strlen($aadhar) != 12 || !ctype_digit($aadhar)) {
        $fieldErrors['aadhar'] = 'Aadhar number must be 12 digits.';
    }

    if (strlen($mobile) != 10 || !ctype_digit($mobile)) {
        $fieldErrors['mobile'] = 'Mobile number must be 10 digits.';
    }

    if ($password !== $confirm_password) {
        $fieldErrors['password'] = 'Passwords do not match.';
    }

    if (empty($fieldErrors)) {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        $insert = $con->prepare("INSERT INTO users (username, aadhar, mobile, password) VALUES (?, ?, ?, ?)");
        $insert->bind_param('ssss', $username, $aadhar, $mobile, $hashed_password);
        if ($insert->execute()) {
            $success = 'Registration successful! You can now <a href="login.php">login</a>.';
            header("Location:login.php");
        } else {
            $fieldErrors['general'] = 'An error occurred. Please try again.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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

    .error {
        color: red;
        font-size: 12px;
        margin-top: 5px;
    }

    .success {
        color: green;
        font-size: 16px;
        margin-top: 15px;
    }
    </style>
</head>

<body>
    <div class="container">
        <h1>Register</h1>
        <?php if ($success): ?>
        <div class="success"><?php echo $success; ?></div>
        <?php endif; ?>
        <?php if (isset($fieldErrors['general'])): ?>
        <div class="error"><?php echo $fieldErrors['general']; ?></div>
        <?php endif; ?>
        <form method="post" action="register.php" onsubmit="return validateForm();">
            <input type="text" name="username" id="username" placeholder="Username">
            <div class="error" id="username-error">
                <?php echo isset($fieldErrors['username']) ? $fieldErrors['username'] : ''; ?></div>
            <br>
            <input type="number" name="aadhar" id="aadhar" placeholder="Aadhar Card Number">
            <div class="error" id="aadhar-error">
                <?php echo isset($fieldErrors['aadhar']) ? $fieldErrors['aadhar'] : ''; ?></div>
            <br>
            <input type="number" name="mobile" id="mobile" placeholder="Mobile Number">
            <div class="error" id="mobile-error">
                <?php echo isset($fieldErrors['mobile']) ? $fieldErrors['mobile'] : ''; ?></div>
            <br>
            <input type="password" name="password" id="password" placeholder="Password">
            <div class="error" id="password-error">
                <?php echo isset($fieldErrors['password']) ? $fieldErrors['password'] : ''; ?></div>
            <br>
            <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password">
            <div class="error" id="confirm_password-error"></div>
            <br>
            <button type="submit">Register</button>
            <p>Already have an account? <a href="login.php">Login</a></p>
        </form>
    </div>

    <script>
    function validateForm() {
        let username = document.getElementById('username').value;
        let aadhar = document.getElementById('aadhar').value;
        let mobile = document.getElementById('mobile').value;
        let password = document.getElementById('password').value;
        let confirm_password = document.getElementById('confirm_password').value;
        let valid = true;

        document.getElementById('username-error').innerText = '';
        document.getElementById('aadhar-error').innerText = '';
        document.getElementById('mobile-error').innerText = '';
        document.getElementById('password-error').innerText = '';
        document.getElementById('confirm_password-error').innerText = '';

        if (aadhar.length != 12 || !/^\d{12}$/.test(aadhar)) {
            document.getElementById('aadhar-error').innerText = 'Aadhar number must be 12 digits.';
            valid = false;
        }

        if (mobile.length != 10 || !/^\d{10}$/.test(mobile)) {
            document.getElementById('mobile-error').innerText = 'Mobile number must be 10 digits.';
            valid = false;
        }

        if (password !== confirm_password) {
            document.getElementById('password-error').innerText = 'Passwords do not match.';
            valid = false;
        }

        if (username.trim() === '') {
            document.getElementById('username-error').innerText = 'Username cannot be empty.';
            valid = false;
        }

        return valid;
    }
    </script>
</body>

</html>