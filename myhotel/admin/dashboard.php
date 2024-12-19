<?php
session_start();  

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");  
    exit();
}
$user_id = $_SESSION['user_id'];
?>

<?php
include('../config.php');

$total_rooms_sql = "SELECT COUNT(*) AS total_rooms FROM rooms";
$total_rooms_result = $con->query($total_rooms_sql);
$total_rooms = $total_rooms_result->fetch_assoc()['total_rooms'];

$available_rooms_sql = "SELECT COUNT(*) AS available_rooms FROM rooms WHERE status = 'available'";
$available_rooms_result = $con->query($available_rooms_sql);
$available_rooms = $available_rooms_result->fetch_assoc()['available_rooms'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

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

    canvas {
        max-width: 100%;
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
            <h2>Admin Dashboard</h2>

            <!-- Dashboard Stats -->
            <div class="card">
                <h5>Total Rooms</h5>
                <p><?php echo $total_rooms; ?></p>
            </div>
            <div class="card" style="background-color: #4CAF50; color: white;">
                <h5>Available Rooms</h5>
                <p><?php echo $available_rooms; ?></p>
            </div>
        </div>
    </div>
</body>

</html>