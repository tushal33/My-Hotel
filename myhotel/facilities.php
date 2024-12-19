<?php
session_start();  

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");  
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Merienda:wght@700&family=Poppins:wght@400;500;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Book Your Hotel</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="facility.css">
</head>

<body>
    <div id="main">
        <!-- navigation menu -->
        <nav class="navbar" id="navbar">
            <div id="nav-left-items">
                <div id="logo-menu">
                    <div id="nav-logo" class="h-font">Book Your Hotel</div>
                </div>
                <div id="nav-items">
                    <ul>
                        <li id="active"><a href="dashboard.php">Home</a></li>
                        <li><a href="room.php">Rooms</a></li>
                        <li><a href="#">Facilities</a></li>
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

        <div class="container">
            <div id="contact" class="container">
                <div class="facilities-section">
                    <div class="box1">
                        <h2 class="title">Our Facilities</h2>
                        <div class="line"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="facility">
                        <div class="faci-item">
                            <img src="facilities/3.svg" alt="Wi-Fi" width="40px">
                            <h5>Wi-Fi</h5>
                        </div>
                        <p>Our fast and reliable Wi-Fi is available in all rooms and public areas, perfect for both work
                            and leisure.</p>
                    </div>
                </div>
                <div class="col">
                    <div class="facility">
                        <div class="faci-item air">
                            <img src="facilities/5.svg" alt="Air-Conditioner" width="40px">
                            <h5>Air-Conditioner</h5>
                        </div>
                        <p>Each of our rooms features adjustable air-conditioning to ensure a perfect temperature and a
                            restful night’s sleep.</p>
                    </div>
                </div>
                <div class="col">
                    <div class="facility">
                        <div class="faci-item">
                            <img src="facilities/6.svg" alt="Heater" width="40px">
                            <h5>Heater</h5>
                        </div>
                        <p>Enjoy a snug and pleasant stay with adjustable heating in all our rooms, ensuring the perfect
                            temperature for a restful night.</p>
                    </div>
                </div>
                <div class="col">
                    <div class="facility">
                        <div class="faci-item">
                            <img src="facilities/4.svg" alt="Therapy" width="40px">
                            <h5>Therapy</h5>
                        </div>
                        <p>Experience personalized therapy sessions that cater to your wellness needs, offering
                            relaxation and revitalization right at our hotel.</p>
                    </div>
                </div>
                <div class="col">
                    <div class="facility">
                        <div class="faci-item">
                            <img src="facilities/2.svg" alt="TV" width="40px">
                            <h5>TV</h5>
                        </div>
                        <p>Each room is equipped with a high-definition TV, providing the perfect backdrop for a cozy
                            night in or catching up on your favorite shows.</p>
                    </div>
                </div>
                <div class="col">
                    <div class="facility">
                        <div class="faci-item">
                            <img src="facilities/1.svg" alt="Water Heater" width="40px">
                            <h5>Water Heater</h5>
                        </div>
                        <p>Our rooms are equipped with convenient water full heaters, ensuring you to have access to
                            very hot water whenever you need it.</p>
                    </div>
                </div>
            </div>
        </div>


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
    </div>
    <script src="script.js"></script>
</body>

</html>