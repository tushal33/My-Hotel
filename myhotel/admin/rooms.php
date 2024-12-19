<?php
include('../config.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$rooms_sql = "SELECT * FROM rooms";
$rooms_result = $con->query($rooms_sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Rooms</title>

    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f9;
    }

    .container {
        display: flex;
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

        <!-- Manage Rooms Content -->
        <div class="dashboard-content">
            <h2>Manage Rooms</h2>

            <table border="1" cellpadding="10" cellspacing="0">
                <thead>
                    <tr>
                        <th>Room Name</th>
                        <th>Room Type</th>
                        <th>Status</th>
                        <th>Price</th>
                        <th>City</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $rooms_result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['room_name']; ?></td>
                        <td><?php echo $row['room_type']; ?></td>
                        <td><?php echo $row['status']; ?></td>
                        <td>$<?php echo $row['price']; ?></td>
                        <td><?php echo $row['city']; ?></td>
                        <td><a href="delete_room.php?id=<?php echo $row['id']; ?>">Delete</a></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

        </div>
    </div>

</body>

</html>