<?php 
include('partials-front/menu.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedbacks - Bite</title>
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
            color: #ffd166;
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
            background-color: #ffd166;
            color: white;
            text-align: center;
            padding:80px 0 40px;
            position: relative;
            overflow: hidden;
        }

        .feedback-header h1 {
            font-size: 3.5rem;
            margin: 0;
            position: relative;
            z-index: 1;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
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
        }

        .review-card:hover {
            transform: translateY(-10px) rotate(2deg);
            box-shadow: 0 15px 30px rgba(0,0,0,0.2);
        }

        .review-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .review-content {
            padding: 20px;
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
        <a href="<?php echo SITEURL; ?>" class="logo">Bite.</a>
        <nav>
            <ul>
                <li><a href="<?php echo SITEURL; ?>">Home</a></li>
                <li><a href="<?php echo SITEURL; ?>categories.php">Categories</a></li>
                <li><a href="<?php echo SITEURL; ?>flower.php">Menu</a></li>
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
                "text" => "The mojito received rave reviews for its refreshing taste and perfect balance of mint and lime. Customers loved its sweetness and fresh mint, with minor suggestions for more lime or stronger mint. It was praised as a great drink for hot days.",
                "name" => "Buwanika Anthony",
                "stars" => 4.5
            ],
            [
                "img" => "imgg/pubudu_chathuranga.jfif",
                "text" => "The Crispy Chicken Submarine excels with crunchy chicken and balanced flavors. Fresh veggies contrast well with the tangy sauce. Improvements could include softer bread and more sauce for extra flavor.",
                "name" => "Pubudu Chathuranga",
                "stars" => 4.5
            ],
            [
                "img" => "imgg/anusha_damayanthi.jpg",
                "text" => "The Signature Seafood Treat Pizza delivers a delicious experience with fresh seafood and a cheese-tomato base. Enhancing it with more seafood variety and a crispier crust would elevate the flavor and texture.",
                "name" => "Anusha Damayanthi",
                "stars" => 4
            ],
            [
                "img" => "imgg/nayanathara_wickramaarachchi.jpg",
                "text" => "The Classic Hot and Spicy Chicken Pizza impresses with balanced heat and juicy chicken. For improvement, a thicker crust and a cooling drizzle of ranch or blue cheese could enhance the experience.",
                "name" => "Nayanathara Wickramaarachchi",
                "stars" => 5
            ],
            [
                "img" => "imgg/saranaga_dissasekara.jfif",
                "text" => "The Cheeseburger offers a satisfying mix of juicy beef, melted cheese, and fresh toppings. Toasting the bun more and adding a signature sauce could enhance texture and flavor, making each bite better.",
                "name" => "Saranga Disasekara",
                "stars" => 4.5
            ],
            [
                "img" => "imgg/nethmi_roshel.jpg",
                "text" => "The Hamburger shines with its classic flavors and balanced ingredients. To improve it, add more seasoning to the patty and offer extras like bacon or avocado for extra variety and richness.",
                "name" => "Nethmi Roshel",
                "stars" => 5
            ],
            [
                "img" => "imgg/akila_danuddara.jfif",
                "text" => "The Beef Submarine is hearty and satisfying, featuring tender, well-seasoned beef. To enhance it, add a touch more seasoning or a complementary sauce to boost the beef’s richness and flavor.",
                "name" => "Akila Dhanuddara",
                "stars" => 3.5
            ],
            [
                "img" => "imgg/shanudri_priyasad.jpg",
                "text" => "The Classic Hot and Spicy Chicken Pizza excels with balanced spiciness and juicy chicken. To improve, try a thicker crust for better support and add a cooling ranch or blue cheese drizzle.",
                "name" => "Shanudri Priyasad",
                "stars" => 4.5
            ],
            [
                "img" => "imgg/WhatsApp Image 2024-08-06 at 11.04.23.jpeg",
                "text" => "The Shallow Fried Prawn Momos are delightful with succulent prawns and a crispy texture. To improve, add more spice or seasoning to the filling and offer a zesty dipping sauce for enhancement.",
                "name" => "Sonali Jayakodi",
                "stars" => 4.5
            ],
            [
                "img" => "imgg/WhatsApp Image 2024-08-06 at 11.37.32.jpeg",
                "text" => "The Wok Fried Chicken Momos shine with tender chicken and a crispy exterior. To enhance them, add more wok flavor with stir-fried veggies or a robust sauce for a deeper, more complex taste.",
                "name" => "Inuka Mapa",
                "stars" => 4.5
            ],
            [
                "img" => "imgg/WhatsApp Image 2024-06-01 at 15.34.39.jpeg",
                "text" => "The mac and cheese submarine is rich, creamy, and indulgent, with a great mix of textures and appealing presentation. Generous portion size, with potential for additional toppings and a half-size option.",
                "name" => "Sashika Dilmina",
                "stars" => 5
            ],
            [
                "img" => "imgg/dilmin_ekanayake.png",
                "text" => "The delight chili chicken pizza combines spicy, savory flavors with a crispy crust and tender toppings. Visually vibrant and well-portioned, it’s a satisfying meal, enhanced by fresh vegetables and melted cheese.",
                "name" => "Dilmin Ekanayaka",
                "stars" => 5
            ]
    ];

    foreach ($reviews as $review) {
        echo '<div class="review-card">';
        echo '<img src="' . $review['img'] . '" alt="' . $review['name'] . '" class="review-image">';
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