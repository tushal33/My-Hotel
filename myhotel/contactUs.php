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

        <div id="contact" class="container">
            <div class="facilities-section">
                <div class="box1">
                    <h2 class="title">Contact Us</h2>
                    <div class="line"></div>
                    <p class="description">
                        "At all hotels we take pride in offering a range of top-tier facilities designed to make your
                        stay exceptional.<br>
                        Whether you're here for business or leisure, our amenities cater to all your needs."
                    </p>
                </div>
                <div class="box2">
                    <div class="b1">
                        <div class="para1">
                            <p style="font-size:1.3rem;font-weight:500;">Address</p><br>
                            <p><i class="fa-solid fa-location-dot"></i>xyz,150ft ring Road,Rajkot,Gujarat.</p><br>
                        </div>
                        <div class="para2">
                            <p style="font-size:1.3rem;font-weight:500;">Contact Us</p><br>
                            <br>
                            <p>Email: info@yourhotel.com</p><br>
                            <br>
                            <p>Phone: +123 456 7890</p><br>
                            <br>
                            <p>Phone: +123 456 7890</p><br><br>
                        </div>
                        <div class="para3">
                            <p style="font-size:1.3rem;font-weight:500;">Follow us</p><br>
                            <p><i class="fa-brands fa-facebook"></i><a href="www.facebook.com">Facebook</a></p><br>
                            <p><i class="fa-brands fa-x-twitter"></i><a href="www.x.com">Twitter</a></p><br>
                            <p><i class="fa-brands fa-instagram"></i><a href="www.instagram.com">Instagram</a></p><br>
                        </div>
                    </div>
                    <div class="b2">
                        <h3>Send A Message</h3><br>
                        <form>
                            <br>
                            <div class="name">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" require>
                            </div>
                            <div class="email">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" require>
                            </div>
                            <div class="subject">
                                <label for="subject">Subject</label>
                                <input type="text" name="subject" id="subject">
                            </div>
                            <div class="message">
                                <label for="message">Message :</label><br>
                                <textarea class="range" name="message" id="message" cols="90" rows="4"></textarea>
                            </div>
                            <div class="conbtn">
                                <button type="submit">Send</button>
                            </div>
                        </form>
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