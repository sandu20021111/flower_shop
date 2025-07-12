<?php 
include('partials-front/menu.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedbacks - Flowerworld</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .main-header {
            background-color: #333;
            padding: 10px 0;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .header-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }

        .logo {
            color: rgb(221, 210, 210);
            font-size: 24px;
            font-weight: 700;
            text-decoration: none;
        }

        nav ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex;
        }

        nav ul li {
            margin-left: 20px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
            font-size: 16px;
        }

        nav ul li a:hover {
            color: #ffd166;
        }


        .feedback-header {
            background-color: white;
            color: white;
            text-align: center;
            padding:80px 0 40px;
            position: relative;
            overflow: hidden;
        }

        .feedback-header h1 {
            font-size: 3rem;
            margin: 0;
            position: relative;
            margin-top: 30px;
            z-index: 1;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
            color: #807d7f;
            letter-spacing: 1px;
        }


        .feedback-header::before {
            content: "";
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.2) 0%, rgba(255,255,255,0) 70%);
            animation: rotate 20s linear infinite;
        }

        @keyframes rotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .review-container {
            max-width: 1200px;
            margin: 50px auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            padding: 0 20px;
        }

        .review-card {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            display: flex;
            flex-direction: column;
        }

        .review-image {
            width: 100px;
            height: 100px;
            aspect-ratio: 1/1;
            object-fit: cover;
            object-position: center;
            display: block;
            border-radius: 50%;
            margin: 0 auto 18px auto;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            border: 3px solid black;
            background: #f3f3f3;
        }
        .review-content {
            padding: 0 20px 20px 20px;
            text-align: center;
        }

        .review-text {
            font-size: 0.9rem;
            color: #555;
            margin-bottom: 15px;
            line-height: 1.6;
            position: relative;
            padding-left: 25px;
        }

        .review-text::before {
            content: '\201C';
            font-size: 3rem;
            color: #ff6b6b;
            position: absolute;
            left: -10px;
            top: -20px;
        }

        .review-text::after {
    content: '\201D';
    font-size: 3rem;
    color: #ff6b6b;
    position: absolute;
    right: -10px;
    bottom: -40px;
}


        .review-name {
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
        }

        .review-stars {
            color: #ffd700;
            font-size: 1.2rem;
        }

        @media (max-width: 768px) {
            .review-container {
                grid-template-columns: 1fr;
            }
            
            .header-container {
                flex-direction: column;
                align-items: center;
            }

            nav ul {
                margin-top: 20px;
            }

            nav ul li {
                margin: 0 10px;
            }
        }
    </style>
</head>
<body>

<header class="main-header">
    <div class="header-container">
        <a href="<?php echo SITEURL; ?>" class="logo"><img src="images/home/logo1.png" alt="Flowerworld Logo" style="height: 50px; vertical-align: middle;"> Flowerworld
            </a>
        <nav>
            <ul>
                <li><a href="<?php echo SITEURL; ?>">Home</a></li>
                <li><a href="<?php echo SITEURL; ?>categories.php">Occasions</a></li>
                <li><a href="<?php echo SITEURL; ?>flower.php">Bouquets</a></li>
                <li><a href="<?php echo SITEURL; ?>contact.php">Contact</a></li>
                <li><a href="cart.php">🛒 (<?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>)</a></li>
            </ul>
        </nav>
    </div>
</header>

<div class="feedback-header">
    <h1>What Our Customers Say</h1>
</div>


<div class="review-container">
<?php
    $reviews = [
        [
                "img" => "imgg/buwanika_anthoney.jpg",
                "text" => "Absolutely beautiful bouquet! The flowers were fresh and the arrangement was stunning. Great for any special occasion.",                "name" => "Buwanika Anthony",
                "stars" => 4.5
            ],
            [
                "img" => "imgg/pubudu_chathuranga.jfif",
                "text" => "The roses were vibrant and fragrant. Delivered on time and exactly as shown on the website.",                "name" => "Pubudu Chathuranga",
                "stars" => 4.5
            ],
            [
                "img" => "imgg/anusha_damayanthi.jpg",
                "text" => "Perfect flowers for my anniversary. The colors were lovely and the packaging was elegant.",                "name" => "Anusha Damayanthi",
                "stars" => 4
            ],
            [
                "img" => "imgg/nayanathara_wickramaarachchi.jpg",
                "text" => "The flower delivery was prompt and the bouquet was gorgeous. The lilies were particularly fresh and fragrant.",
                "name" => "Nayanathara Wickramaarachchi",
                "stars" => 5
            ],
            [
                "img" => "imgg/saranaga_dissasekara.jfif",
                "text" => "The flower arrangement was stunning and made my birthday extra special. The delivery was on time and the flowers were fresh.",
                "name" => "Saranga Disasekara",
                "stars" => 4.5
            ],
            [
                "img" => "imgg/nethmi_roshel.jpg",
                "text" => "Ordered for a graduation gift. Great quality, stylish arrangement, and timely delivery!",
                "name" => "Nethmi Roshel",
                "stars" => 5
            ],
            [
                "img" => "imgg/akila_danuddara.jfif",
                "text" => "The sympathy flowers were elegant and respectful. Could use more fragrance though.",
                "name" => "Akila Dhanuddara",
                "stars" => 3.5
            ],
            [
                "img" => "imgg/shanudri_priyasad.jpg",
                "text" => "Loved the mixed bouquet for Mother's Birthday. Fresh lilies and roses were a wonderful combo.",
                "name" => "Shanudri Priyasad",
                "stars" => 4.5
            ],
            [
                "img" => "imgg/WhatsApp Image 2024-08-06 at 11.04.23.jpeg",
                "text" => "Impressed by the exotic flower arrangement. The orchids were fresh and lasted long. Perfect for my sister's birthday.",
                "name" => "Sonali Jayakodi",
                "stars" => 4.5
            ],
            [
                "img" => "imgg/WhatsApp Image 2024-08-06 at 11.37.32.jpeg",
                "text" => "Gorgeous floral basket for a housewarming gift. Loved the combination of colors and scents.",
                "name" => "Inuka Mapa",
                "stars" => 4.5
            ],
            [
                "img" => "imgg/WhatsApp Image 2024-06-01 at 15.34.39.jpeg",
                "text" => "Macarons and flower combo was creative and delightful. Great presentation and fresh blooms.",
                "name" => "Sashika Dilmina",
                "stars" => 5
            ],
            [
                "img" => "imgg/dilmin_ekanayake.png",
                "text" => "Bright and cheerful flower box with fresh tulips and carnations. Perfect for a thank you gift!",
                "name" => "Dilmin Ekanayaka",
                "stars" => 5
            ]
    ];

    foreach ($reviews as $review) {
        echo '<div class="review-card">';
        echo '<div class="review-image-wrapper"><img src="' . $review['img'] . '" alt="' . $review['name'] . '" class="review-image"></div>';
        echo '<div class="review-content">';
        echo '<p class="review-text">' . $review['text'] . '</p>';
        echo '<h3 class="review-name">' . $review['name'] . '</h3>';
        echo '<div class="review-stars">';
        for ($i = 0; $i < floor($review['stars']); $i++) {
            echo '<i class="fas fa-star"></i>';
        }
        if ($review['stars'] - floor($review['stars']) > 0) {
            echo '<i class="fas fa-star-half-alt"></i>';
        }
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
    ?>
</div>

<script>
    const reviewCards = document.querySelectorAll('.review-card');
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = 1;
                entry.target.style.transform = 'translateY(0) rotate(0)';
            }
        });
    }, { threshold: 0.1 });

    reviewCards.forEach((card, index) => {
        card.style.opacity = 0;
        card.style.transform = `translateY(50px) rotate(${index % 2 === 0 ? -5 : 5}deg)`;
        card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
        observer.observe(card);
    });

    // Add hover effect
    reviewCards.forEach(card => {
        card.addEventListener('mouseenter', () => {
            card.style.transform = 'translateY(-10px) rotate(2deg) scale(1.05)';
        });
        card.addEventListener('mouseleave', () => {
            card.style.transform = 'translateY(0) rotate(0) scale(1)';
        });
    });
</script>

<?php include('partials-front/footer.php'); ?>
</body>
</html>