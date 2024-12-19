<?php
require('config.php');
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    die("User not logged in. Please log in.");
}

$user_id = $_SESSION['user_id'];

// Get the selected room ID from the URL
$room_id = isset($_GET['room_id']) ? $_GET['room_id'] : null;

// Fetch the selected room details from the database
if ($room_id) {
    $sql = "SELECT * FROM rooms WHERE id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $room_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $selected_room = mysqli_fetch_assoc($result); // Fetch the selected room details
    } else {
        $selected_room = null; // Room not found
    }
    mysqli_stmt_close($stmt);
} else {
    $selected_room = null;
}

// Redirect if room not found
if (!$selected_room) {
    header("Location: room.php");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['book_room'])) {
    // Get input values from the form
    $room_id = $_POST['room_id'];
    $check_in_date = $_POST['check_in_date'];
    $check_out_date = $_POST['check_out_date'];
    $guests = $_POST['member'];
    $user_id = $_SESSION['user_id']; // Assuming the user is logged in and user_id is stored in the session

    // Validate input values (e.g., check if dates are valid, etc.)
    if (strtotime($check_in_date) >= strtotime($check_out_date)) {
        echo "<script>alert('Check-out date must be after check-in date.');</script>";
    } else {
        // Check if the user exists
        $sql_check_user = "SELECT id FROM users WHERE id = ?";
        $stmt_check_user = mysqli_prepare($con, $sql_check_user);
        mysqli_stmt_bind_param($stmt_check_user, "i", $user_id);
        mysqli_stmt_execute($stmt_check_user);
        mysqli_stmt_store_result($stmt_check_user);

        if (mysqli_stmt_num_rows($stmt_check_user) == 0) {
            echo "<script>alert('User does not exist. Please login again.');</script>";
            mysqli_stmt_close($stmt_check_user);
        } else {
            // Insert the booking into the database
            $sql = "INSERT INTO bookings (user_id, room_id, check_in_date, check_out_date, guests) 
                    VALUES (?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($con, $sql);
            mysqli_stmt_bind_param($stmt, "iissi", $user_id, $room_id, $check_in_date, $check_out_date, $guests);

            if (mysqli_stmt_execute($stmt)) {
                echo "<script>alert('Booking successful!'); window.location.href='dashboard.php';</script>";
            } else {
                echo "<script>alert('Error in booking. Please try again later.');</script>";
            }

            mysqli_stmt_close($stmt);
        }
        mysqli_stmt_close($stmt_check_user);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Details - <?= htmlspecialchars($selected_room['room_name']) ?></title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* General Styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    color: #333;
}

h2, h3 {
    color: #444;
}

a {
    text-decoration: none;
    color: inherit;
}

ul {
    list-style: none;
}

button, input[type="submit"] {
    cursor: pointer;
}



/* Room Details Page */
.room-details {
    padding: 50px 20px;
    text-align: center;
}
/* Room Details Page */
.room-details {
    padding: 50px 20px;
    text-align: center;
}

.room-detail-card {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    max-width: 900px;
    margin: 0 auto;
    padding: 30px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.room-detail-card img {
    width: 100%;
    border-radius: 8px;
    margin-bottom: 20px;
}

.room-detail-card h3 {
    font-size: 28px;
    color: #333;
    margin-top: 20px;
}

.room-detail-card p {
    font-size: 18px;
    color: #666;
    margin-top: 10px;
}

.room-detail-card .btn {
    background-color: #333;
    color: white;
    padding: 12px 24px;
    text-decoration: none;
    border-radius: 5px;
    margin-top: 20px;
    display: inline-block;
}

.room-detail-card .btn:hover {
    background-color: #555;
}

/* Booking Form */
.booking-form {
    margin-top: 30px;
    max-width: 600px;
    margin: 0 auto;
    background-color: #fff;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.booking-form input[type="date"],
.booking-form input[type="number"],
.booking-form input[type="text"] {
    width: 100%;
    padding: 12px;
    margin-bottom: 15px;
    border-radius: 5px;
    border: 1px solid #ccc;
    font-size: 16px;
    background-color: #f9f9f9;
}

.booking-form button {
    background-color: #333;
    color: white;
    padding: 12px 24px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    width: 100%;
}

.booking-form button:hover {
    background-color: #555;
}

.booking-form label {
    font-size: 16px;
    color: #444;
    display: block;
    margin-bottom: 8px;
}


/* Responsive Design */
@media (max-width: 768px) {
    .room-detail-card {
        padding: 20px;
    }

    .room-detail-card h3 {
        font-size: 24px;
    }

    .navbar ul {
        flex-direction: column;
    }

    .navbar a {
        padding: 10px;
    }

    .booking-form {
        padding: 20px;
        width: 90%;
    }
}

    </style>
</head>
<body>
<header>
        <nav class="navbar" id="navbar">
            <div id="nav-left-items">
                <div id="logo-menu">
                    <div id="nav-logo" class="h-font">Book Your Hotel</div>
                    <div class="menu-icon" onclick="toggleMenu()">
                        <i class="fas fa-bars"></i>
                        <i class="fas fa-times"></i>
                    </div>
                </div>
                <div id="nav-items">
                    <ul>
                        <li id="active"><a href="dashboard.php">Home</a></li>
                        <li><a href="#">Rooms</a></li>
                        <li><a href="facilities.php">Facilities</a></li>
                        <li><a href="contactUs.php">Contact Us</a></li>
                    </ul>
                </div>
            </div>
            <div id="nav-right-items">
                <div id="nav-btn">
                    <a href="profile.php" id="myBtn">Profil</a>
                    <a href="logout.php" id="myBtn2">Logout</a>
                </div>
            </div>
        </nav>
    </header>

    <br><br><br><br><br>

    <section class="room-details">
        <h2>Room Details</h2>
        <div class="room-detail-card">
            <img src="images/<?= htmlspecialchars($selected_room['image']) ?>" alt="<?= htmlspecialchars($selected_room['room_name']) ?>">
            <h3><?= htmlspecialchars($selected_room['room_name']) ?></h3>
            <p>Type: <?= htmlspecialchars($selected_room['room_type']) ?></p>
            <p><strong>Price: $<?= number_format($selected_room['price'], 2) ?> per night</strong></p>
            <p>Status: <?= ucfirst(htmlspecialchars($selected_room['status'])) ?></p>
            <p>City: <?= htmlspecialchars($selected_room['city']) ?></p>
            <br>

            <!-- Booking Form -->
            <form action="roomdetail.php?room_id=<?= htmlspecialchars($selected_room['id']) ?>" method="POST">
                <input type="hidden" name="room_id" value="<?= htmlspecialchars($selected_room['id']) ?>">

                <label for="checkin_date">Check-in Date:</label>
                <input type="date" name="check_in_date" required><br><br>

                <label for="checkout_date">Check-out Date:</label>
                <input type="date" name="check_out_date" required><br><br>

                <label for="guests">Guests:</label>
                <input type="number" name="member" min="1" max="2" required><br><br>

                <button type="submit" name="book_room" class="btn">Book Now</button>
            </form>
        </div>
    </section>
</body>
</html>
