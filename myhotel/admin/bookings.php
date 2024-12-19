<?php
include('../config.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$sql = "SELECT bookings.id,rooms.room_name, rooms.room_type, rooms.city, bookings.check_in_date, bookings.check_out_date, bookings.guests,rooms.price FROM bookings
    INNER JOIN rooms ON bookings.room_id = rooms.id";

$result = $con->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Bookings</title>

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

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    table th,
    table td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: center;
    }

    table th {
        background-color: #f2f2f2;
        font-weight: bold;
    }

    table tr:hover {
        background-color: #f5f5f5;
    }
    </style>
</head>

<body>

    <div class="container">
        <!-- Sidebar -->
        <?php include('sidebar.php'); ?>

        <!-- Manage Rooms Content -->
        <div class="dashboard-content">
            <h2>View Bookings</h2>

            <table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Room Name</th>
                        <th>Room Type</th>
                        <th>City</th>
                        <th>Check In Date</th>
                        <th>Check Out Date</th>
                        <th>Member</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['room_name']; ?></td>
                        <td><?php echo $row['room_type']; ?></td>
                        <td><?php echo $row['city']; ?></td>
                        <td><?php echo $row['check_in_date']; ?></td>
                        <td><?php echo $row['check_out_date']; ?></td>
                        <td><?php echo $row['guests']; ?></td>
                        <td>$<?php echo $row['price']; ?></td>
                    </tr>
                    <?php endwhile; ?>
                    <?php else: ?>
                    <tr>
                        <td colspan="9">No bookings found.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>

        </div>
    </div>

</body>

</html>