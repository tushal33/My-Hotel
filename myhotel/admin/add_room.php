<?php
require('../config.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $room_name = $_POST['room_name'];
    $room_type = $_POST['room_type'];
    $price = $_POST['price'];
    $status = $_POST['status'];
    $city = $_POST['city'];

    $image_name = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $target_dir = "../images/";
    $target_file = $target_dir . basename($image_name);

    if (move_uploaded_file($image_tmp, $target_file)) {
        $sql = "INSERT INTO rooms (room_name, room_type, price,status,image,city) 
                VALUES ('$room_name', '$room_type', '$price', '$status', '$image_name','$city')";
        if (mysqli_query($con, $sql)) {
            echo "<p>Room added successfully!</p>";
        } else {
            echo "<p>Error: " . mysqli_error($con) . "</p>";
        }
    } 
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Room</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f9;
    }

    .container {
        display: flex;
        margin-top: 20px;
    }

    .sidebar {
        width: 250px;
        background-color: #333;
        color: white;
        padding-top: 20px;
    }

    .sidebar a {
        color: white;
        text-decoration: none;
        display: block;
        padding: 12px;
        margin: 5px 0;
    }

    .sidebar a:hover {
        background-color: #575757;
    }

    .dashboard-content {
        flex-grow: 1;
        padding: 20px;
    }

    .card {
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        margin: 10px;
        padding: 20px;
        text-align: center;
    }

    .form-label {
        font-weight: bold;
    }

    input,
    select,
    button {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }

    button {
        background-color: #4CAF50;
        color: white;
        font-size: 16px;
        border: none;
        cursor: pointer;
    }

    button:hover {
        background-color: #45a049;
    }

    .card form {
        width: 100%;
        max-width: 500px;
        margin: auto;
    }

    .card h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    .message {
        text-align: center;
        font-size: 18px;
        color: green;
        margin-top: 20px;
    }
    </style>
</head>

<body>
    <div class="container">
        <!-- Sidebar -->
        <?php include('sidebar.php'); ?>

        <!-- Dashboard Content -->
        <div class="dashboard-content">
            <div class="card">
                <h2>Add Room</h2>
                <form action="add_room.php" method="POST" enctype="multipart/form-data">
                    <label for="room_name" class="form-label">Room Name:</label>
                    <input type="text" name="room_name" id="room_name" required>

                    <label for="room_type" class="form-label">Room Type:</label>
                    <input type="text" name="room_type" id="room_type" required>

                    <label for="price" class="form-label">Price:</label>
                    <input type="number" name="price" id="price" step="0.01" required>

                    <label for="status" class="form-label">Status:</label>
                    <select name="status" id="status" required>
                        <option value="available">Available</option>
                        <option value="booked">Booked</option>
                    </select>

                    <label for="image" class="form-label">Room Image:</label>
                    <input type="file" name="image" id="image" required>

                    <label for="city" class="form-label">City:</label>
                    <input type="text" name="city" id="city" required>

                    <button type="submit">Add Room</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>