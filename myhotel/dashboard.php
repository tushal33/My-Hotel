<?php
session_start();  

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");  
    exit();
}
$user_id = $_SESSION['user_id'];

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Merienda:wght@700&family=Poppins:wght@400;500;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Book Your Hotel</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div id="main">
        <!-- navigation menu -->
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
                        <li><a href="room.php">Rooms</a></li>
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
        <!-- main section -->
        <div class="main-section" id="main-section">
            <div class="video-container">
                <video src="room/my5.mp4" id="video" loop autoplay muted></video>
            </div>
            <div id="main-container">
                <div id="main-content">
                    <h3>Check Availibility</h3>
                    <div class="citySelect">
                        <select name="room" id="room ">
                            <option value="select">Select City</option>
                            <option value="rajkot">Rajkot</option>
                        </select>
                    </div>
                    <div class="checking">
                        <label for="dateCheck">Date of checking</label>
                        <input type="date" id="dateCheck" />
                    </div>
                    <div class="checkout">
                        <label for="dateOut">Date of checking out</label>
                        <input type="date" id="dateOut">
                    </div>
                    <div class="capacity">
                        <p>Select Persons</p>
                        <label for="adults">Adults</label>
                        <select id="adults">
                            <option value="select">Open this to select menu</option>
                            <option value="one">One</option>
                            <option value="Two">Two</option>
                            <option value="Three">Three</option>
                        </select>
                        <label for="children">children</label>
                        <select id="children">
                            <option value="select">Open this to select menu</option>
                            <option value="one">One</option>
                            <option value="Two">Two</option>
                            <option value="Three">Three</option>
                        </select>
                    </div>
                    <div class="btn">
                        <a href="room.php" class="main-btn">Submit</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- service -->
        <section class="services" id="services">
            <h1 class="h-font">Rooms</h1>
            <div class="box-container">
                <div class="box">
                    <img src="room/1.jpg" class="card-img-top">
                    <h5>Normal Room</h5><br>
                    <h6>₹599 Per Night</h6>
                    <p>This Room Is Get 1 Hall,2 Room,<br>2 BathRoom,Free Wi-Fi </p>
                    <h3>Ratings</h3>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <br><br>
                    <a href="room.php" class="btn btn-primary">Book Now</a>
                </div>

                <div class="box">
                    <img src="room/2.png" class="card-img-top">
                    <h5>Delux Room</h5><br>
                    <h6>₹899 Per Night</h6>
                    <p>This Room Is Get 1 Hall,2 Room,<br>2 BathRoom,Free Wi-Fi </p>
                    <h3>Ratings</h3>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <br><br>
                    <a href="room.php" class="btn btn-primary">Book Now</a>
                </div>
                <div class="box">
                    <img src="room/3.png" class="card-img-top">
                    <h5>super Delux Room</h5><br>
                    <h6>₹1299 Per Night</h6>
                    <p>This Room Is Get 1 Hall,2 Room,<br>2 BathRoom,Free Wi-Fi </p>
                    <h3>Ratings</h3>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <br><br>
                    <a href="room.php" class="btn btn-primary">Book Now</a>
                </div>
            </div>
        </section>
        <!-- facilities -->
        <div id="facilities" class="facilities">
            <h1 class="h-font">Facilities</h1>
            <div class="facility-items">
                <div class="boxes">
                    <img src="facilities/3.svg" width="40px">
                    <h3>Wifi</h3>
                </div>
                <div class="boxes">
                    <div class="box-icon">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                    </div>
                    <h3>5 Star Rooms</h3>
                </div>
                <div class="boxes">
                    <img src="facilities/5.svg" width="40px">
                    <h3>Air-Conditioner</h3>
                </div>
                <div class="boxes">
                    <img src="facilities/6.svg" width="40px">
                    <h3>Heater</h3>
                </div>
                <div class="boxes">
                    <img src="facilities/1.svg" width="40px">
                    <h3>Water-Heater</h3>
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