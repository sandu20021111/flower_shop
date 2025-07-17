<?php
include('partials-front/menu.php');
?>

<style>
    body {
        background-color: #f9f9f9;
        color: #333;
        font-family: 'Poppins', sans-serif;
    }

    .contact-container {
        max-width: 1200px;
        margin: 100px auto 50px;
        display: flex;
        background-color: #ffffff;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        opacity: 0;
        transform: translateY(20px);
        animation: fadeInUp 0.8s ease-out forwards;
    }

    .contact-info {
        flex: 1;
        background-color: #ffd6d6;
        padding: 60px 40px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        position: relative;
        overflow: hidden;
    }

    .contact-info::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.2) 0%, rgba(255,255,255,0) 70%);
        animation: ripple 15s infinite linear;
    }

    .contact-form {
        flex: 2;
        padding: 60px 40px;
        background-color: #ffffff;
    }

    h2 {
        font-size: 32px;
        margin-bottom: 20px;
        color: #333;
        position: relative;
    }

    h2::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 0;
        width: 50px;
        height: 3px;
        background-color: #ff6b6b;
    }

    .info-text {
        font-size: 16px;
        margin-bottom: 30px;
        line-height: 1.6;
        color: #333;
    }

    .contact-details {
        margin-bottom: 30px;
    }

    .contact-details p {
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        font-size: 16px;
        color: #333;
    }

    .contact-details i {
        margin-right: 15px;
        color: #ff6b6b;
        font-size: 20px;
    }

    .social-icons {
        display: flex;
    }

    .social-icons a {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: #ff6b6b;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        color: #ffffff;
        text-decoration: none;
        font-size: 18px;
        transition: all 0.3s ease;
    }

    .social-icons a:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(255, 107, 107, 0.4);
    }
    .form-group {
        margin-bottom: 25px;
        width: 100%;
        box-sizing: border-box; /* Ensure padding doesn't affect width */
    }

    input,
    textarea {
        width: 100%;
        max-width: 100%;
        padding: 15px;
        background-color: #f5f5f5;
        border: none;
        border-radius: 8px;
        color: #333;
        font-size: 16px;
        transition: all 0.3s ease;
        box-sizing: border-box; /* Prevent overflow due to padding */
    }

    input:focus,
    textarea:focus {
        background-color: #ffffff;
        box-shadow: 0 0 0 2px #ff6b6b;
        outline: none;
    }

    textarea {
        height: 150px;
        resize: vertical;
    }


    .submit-btn {
        background-color: #ff6b6b;
        color: white;
        border: none;
        padding: 15px 30px;
        border-radius: 8px;
        cursor: pointer;
        font-size: 18px;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-block;
    }

    .submit-btn:hover {
        background-color: #ff5252;
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(255, 107, 107, 0.4);
    }

    @media (max-width: 768px) {
        .contact-container {
            flex-direction: column;
        }
        .contact-info, .contact-form {
            width: 100%;
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes ripple {
        0% {
            transform: translate(0, 0);
        }
        100% {
            transform: translate(-50%, -50%);
        }
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #333;
    }

    .input-animation {
        position: relative;
        overflow: hidden;
    }

    .input-animation::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 2px;
        background-color: #ff6b6b;
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }

    .input-animation input:focus ~ ::after,
    .input-animation textarea:focus ~ ::after {
        transform: scaleX(1);
    }

    .contact-map {
        width: 100%;
        margin-top: 10px;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }

    .visit-location-heading {
        margin-top: 40px;
        margin-bottom: 20px;
        color: #333;
        font-size: 28px;
        font-weight: 600;
        text-align: center;
        letter-spacing: 0.5px;
        position: relative;
    }

    .visit-location-heading::after {
        content: '';
        display: block;
        width: 60px;
        height: 3px;
        background-color: #ff6b6b; /* Accent underline color */
        margin: 10px auto 0;
        border-radius: 2px;
    }

    /* Styles for Success/Error Messages */
    .text-center {
        text-align: center;
    }
    .success {
        color: #28a745; /* Green */
        background-color: #d4edda; /* Light green background */
        border: 1px solid #c3e6cb;
        padding: 10px;
        margin-bottom: 20px;
        border-radius: 5px;
    }
    .error {
        color: #dc3545; /* Red */
        background-color: #f8d7da; /* Light red background */
        border: 1px solid #f5c6cb;
        padding: 10px;
        margin-bottom: 20px;
        border-radius: 5px;
    }
    .warning { /* For messages where one part succeeded but another failed */
        color: #ffc107; /* Amber/Yellow */
        background-color: #fff3cd; /* Light yellow background */
        border: 1px solid #ffeeba;
        padding: 10px;
        margin-bottom: 20px;
        border-radius: 5px;
    }


</style>

<header class="main-header">
    <div class="container header-container">
        <div class="logo-container">
            <h1 class="logo">
                <img src="images/home/logo1.png" alt="Flowerworld Logo" style="height: 50px; vertical-align: middle;"> Flowerworld
            </h1>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="categories.php">Occasions</a></li>
                <li><a href="flower.php">Bouquets</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="cart.php">🛒 (<?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>)</a></li>
            </ul>
        </nav>
    </div>
</header>

<div class="contact-container">
    <div class="contact-info">
        <div>
            <h2>Contact Us</h2>
            <p class="info-text">Get in touch with us for any questions or concerns. We're here to help!</p>
        </div>
        <div class="contact-details">
            <p><i class="fa fa-phone"></i> +94 111 222 555</p>
            <p><i class="fa fa-envelope"></i> info@FlowerWorld.com</p>
            <p><i class="fa fa-map-marker"></i> 77 A2, Sri Jayawardenepura Kotte, Colombo</p>
        </div>
        <div class="social-icons">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-linkedin-in"></i></a>
        </div>
    </div>
    <div class="contact-form">
        <h2>Send Us a Message</h2>

        <?php
            // Display session messages here
            if(isset($_SESSION['contact_message']))
            {
                echo $_SESSION['contact_message']; // Displaying Session Message
                unset($_SESSION['contact_message']); // Removing Session Message after display
            }
        ?>

        <form id="contactForm" action="process-contact.php" method="POST">
            <div class="form-group">
                <label for="name">Your Name</label>
                <div class="input-animation">
                    <input type="text" id="name" name="name" required>
                </div>
            </div>
            <div class="form-group">
                <label for="email">Your Email</label>
                <div class="input-animation">
                    <input type="email" id="email" name="email" required>
                </div>
            </div>
            <div class="form-group">
                <label for="message">Your Message</label>
                <div class="input-animation">
                    <textarea id="message" name="message" required></textarea>
                </div>
            </div>
            <button type="submit" class="submit-btn">Send Message</button>
        </form>
    </div>
</div>

<h3 class="visit-location-heading">Visit Our Flower Shop Location</h3>

<div class="contact-map">
    <iframe
    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.91698263592!2d79.9103565757917!3d6.899661293100371!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae2509172fec017%3A0x6b450702f3c7e7b5!2sSri%20Jayawardenepura%20Kotte!5e0!3m2!1sen!2slk!4v1700000000000!5m2!1sen!2slk"
    width="100%"
    height="300"
    style="border:0; border-radius: 12px; margin-top: 10px;"
    allowfullscreen=""
    loading="lazy"
    referrerpolicy="no-referrer-when-downgrade">
</iframe>
</div>
<?php include('partials-front/footer.php'); ?>