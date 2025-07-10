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
        background-color: 	#ffd6d6;
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

</style>

<header class="main-header">
    <div class="container header-container">
        <div class="logo-container">
            <h1 class="logo">Bite.</h1>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="categories.php">Categories</a></li>
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
            <p><i class="fa fa-envelope"></i> Bite@gmail.com</p>
            <p><i class="fa fa-map-marker"></i> 77 A2, Malabe, Colombo</p>
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
        <form id="contactForm">
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
    src="https://maps.google.com/maps?q=6.886695720219892,79.8869851693149&z=15&output=embed" 
    width="100%" 
    height="300" 
    style="border:0; border-radius: 12px; margin-top: 10px;" 
    allowfullscreen="" 
    loading="lazy" 
    referrerpolicy="no-referrer-when-downgrade">
</iframe>
</div>


<script>
    document.getElementById('contactForm').addEventListener('submit', function(e) {
        e.preventDefault();
    
        alert('Thank you for your message. We will get back to you soon!');
        this.reset();
    });
</script>

<?php include('partials-front/footer.php'); ?>