<?php
require('config.php');
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); 
    exit();
}

// Query to fetch all rooms from the database
$sql = "SELECT * FROM rooms WHERE status = 'available'";
$result = mysqli_query($con, $sql);

// Check if rooms are available
$rooms = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $rooms[] = $row; // Store each room in the rooms array
    }
} else {
    echo "No rooms available.";
}

// Get the selected room ID from the URL (if provided)
$selected_room_id = isset($_GET['room_id']) ? $_GET['room_id'] : null;

// Fetch the selected room details if room_id is set
if ($selected_room_id) {
    $sql = "SELECT * FROM rooms WHERE id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $selected_room_id);
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Room Booking</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Add your styles here */
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

        .room-selection {
            padding: 30px;
            text-align: center;
        }

        .room-list {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }

        .room-card {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            width: 300px;
            margin: 15px;
            padding: 20px;
            text-align: center;
        }

        .room-card img {
            width: 100%;
            border-radius: 8px;
        }

        .room-card .btn {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #333;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .room-card .btn:hover {
            background-color: #555;
        }

        .room-details {
            padding: 30px;
            text-align: center;
        }

        .room-detail-card {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            display: inline-block;
            padding: 20px;
            width: 80%;
            max-width: 800px;
        }

        .room-detail-card img {
            width: 100%;
            border-radius: 8px;
        }

        .booking-form {
            margin-top: 20px;
        }

        .booking-form input {
            margin: 10px;
            padding: 10px;
            width: 100%;
            max-width: 300px;
            border: 1px solid #ccc;
border-radius: 5px;
        }

        .booking-form button {
            margin-top: 20px;
            padding: 15px 30px;
            background-color: #333;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .booking-form button:hover {
            background-color: #555;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
        const checkinDateInput = document.getElementById('checkin_date');
        const checkoutDateInput = document.getElementById('checkout_date');

        checkinDateInput.addEventListener('change', validateDates);
        checkoutDateInput.addEventListener('change', validateDates);

        function validateDates() {
        const checkinDate = new Date(checkinDateInput.value);
        const checkoutDate = new Date(checkoutDateInput.value);

        if (checkinDate && checkoutDate) {
            if (checkoutDate <= checkinDate) {
                alert('Check-out date must be later than check-in date!');
                    checkoutDateInput.value = '';
                    }
                }
            }
        });
    </script>
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

    <section class="room-selection">
    <div class="container">
    <div id="contact" class="container">
        <div class="facilities-section">
            <div class="box1">
            <h2 class="title">Our Rooms</h2>
            <div class="line"></div>
            </div>
        </div>
    </div>
    </div>
        <h2>Select a Room</h2>
        
        <div class="room-list">
            <?php foreach ($rooms as $room): ?>
                <div class="room-card">
                    <!-- Image from the database -->
                    <img src="images/<?= $room['image'] ?>" alt="<?= $room['room_name'] ?>">
                    <h3><?= $room['room_name'] ?></h3>
                    <p>Type: <?= $room['room_type'] ?></p>
                    <p>Price: $<?= number_format($room['price'], 2) ?> Per Night</p>
                    <p>City:<?= $room['city'] ?></p>
                    <a href="roomdetail.php?room_id=<?= $room['id'] ?>" class="btn">View Details</a>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Footer Section -->
    <footer class="footer" id="footer">
        <div class="footer-container">
            <div class="footer-columns">
                <div class="footer-column">
                    <h5>About Us</h5>
                    <p>Learn more about our hotel, our mission, and our values.</p>
                </div>
                <div class="footer-column">
                    <h5>Quick Links</h5>
                    <ul class="footer-links">
                        <li><a href="#">Home</a></li>
                        <li><a href="#services">Rooms</a></li>
                        <li><a href="#facilites">Facilities</a></li>
                        <li><a href="#">Contact Us</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h5>Customer Service</h5>
                    <ul class="footer-links">
                        <li><a href="#">Help Center</a></li>
                        <li><a href="#">FAQs</a></li>
                        <li><a href="#">Support</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h5>Contact Us</h5>
                    <p>Email: info@yourhotel.com</p>
                    <p>Phone: +123 456 7890</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>© 2024 Book Your Hotel. All Rights Reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>
