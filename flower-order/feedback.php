<?php 
include('partials-front/menu.php');
include('config/constants.php');
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
        :root {
            --primary-color: #f02397;
            --warning-color: #ffcc00;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
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
            color: #ddd;
            font-size: 24px;
            font-weight: 700;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        nav ul {
            list-style: none;
            display: flex;
            margin: 0;
            padding: 0;
        }

        nav ul li {
            margin-left: 20px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        nav ul li a:hover {
            color: var(--primary-color);
        }

        .feedback-header {
            text-align: center;
            padding: 100px 20px 40px;
            background: #fff;
            margin-top: 60px;
        }

        .feedback-header h1 {
            font-size: 2.5rem;
            color: #555;
        }

        .review-container {
            max-width: 1200px;
            margin: 40px auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            padding: 0 20px;
        }

        .review-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            text-align: center;
            padding: 20px;
        }

        .review-image {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid #000;
            margin-bottom: 20px;
        }

        .review-text {
            font-size: 0.95rem;
            color: #666;
            margin-bottom: 15px;
            position: relative;
            padding-left: 20px;
        }

        .review-text::before {
            content: "“";
            font-size: 3rem;
            color: var(--primary-color);
            position: absolute;
            left: 0;
            top: -20px;
        }

        .review-name {
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
        }

        .review-stars {
            color: #ffd700;
        }

        .feedback-float-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 14px 22px;
            border-radius: 30px;
            cursor: pointer;
            font-size: 16px;
            z-index: 999;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .feedback-modal {
            display: none;
            position: fixed;
            z-index: 1001;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
        }

        .modal-content {
            background: #fff;
            margin: 8% auto;
            padding: 30px;
            border-radius: 10px;
            max-width: 500px;
            position: relative;
        }

        .close-btn {
            position: absolute;
            top: 10px;
            right: 20px;
            font-size: 28px;
            color: #999;
            cursor: pointer;
        }

        .feedback-form input,
        .feedback-form textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }

        .feedback-form button {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 12px;
            border-radius: 8px;
            width: 100%;
            font-size: 16px;
            cursor: pointer;
        }

        .rating-stars {
            display: flex;
            flex-direction: row-reverse;
            justify-content: left;
            gap: 10px;
            margin-bottom: 15px;
        }

        .rating-stars input {
            display: none;
        }

        .rating-stars label {
            font-size: 24px;
            color: #ccc;
            cursor: pointer;
            transition: color 0.2s;
        }

        .rating-stars input:checked ~ label,
        .rating-stars label:hover,
        .rating-stars label:hover ~ label {
            color: var(--warning-color);
        }

        @media (max-width: 768px) {
            .review-container {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

<header class="main-header">
    <div class="header-container">
        <a href="<?php echo SITEURL; ?>" class="logo">
            <img src="images/home/logo1.png" alt="Flowerworld Logo" style="height: 50px;"> Flowerworld
        </a>
        <nav>
            <ul>
                <li><a href="<?php echo SITEURL; ?>">Home</a></li>
                <li><a href="<?php echo SITEURL; ?>categories.php">Occasions</a></li>
                <li><a href="<?php echo SITEURL; ?>flower.php">Bouquets</a></li>
                <li><a href="<?php echo SITEURL; ?>contact.php">Contact</a></li>
                <li><a href="cart.php">🛒</a></li>
            </ul>
        </nav>
    </div>
</header>

<div class="feedback-header">
    <h1>What Our Customers Say</h1>
</div>

<div class="review-container">
    <?php
    $sql = "SELECT * FROM tbl_feedback ORDER BY id DESC";
    $res = mysqli_query($conn, $sql);
    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            $img = !empty($row['image']) && file_exists("uploads/" . $row['image']) 
                ? 'uploads/' . $row['image'] 
                : 'images/default-user.png';
            echo '<div class="review-card">';
            echo '<img src="' . $img . '" alt="User" class="review-image">';
            echo '<div class="review-text">' . htmlspecialchars($row['text']) . '</div>';
            echo '<div class="review-name">' . htmlspecialchars($row['name']) . '</div>';
            echo '<div class="review-stars">';
            for ($i = 1; $i <= 5; $i++) {
                echo $i <= $row['stars'] ? '<i class="fas fa-star"></i>' : '<i class="far fa-star"></i>';
            }
            echo '</div></div>';
        }
    }
    ?>
</div>

<!-- Feedback Floating Button -->
<button id="feedbackBtn" class="feedback-float-btn">
    <i class="fas fa-comment-alt"></i> Give Feedback
</button>

<!-- Modal -->
<div id="feedbackModal" class="feedback-modal">
    <div class="modal-content">
        <span class="close-btn" id="closeModal">&times;</span>
        <h2>Share Your Feedback</h2>
        <form action="submit-feedback.php" method="POST" enctype="multipart/form-data" class="feedback-form">
            <input type="text" name="name" placeholder="Your Name" required>

            <label>Your Rating</label>
            <div class="rating-stars">
                <input type="radio" id="star5" name="stars" value="5" required><label for="star5">★</label>
                <input type="radio" id="star4" name="stars" value="4"><label for="star4">★</label>
                <input type="radio" id="star3" name="stars" value="3"><label for="star3">★</label>
                <input type="radio" id="star2" name="stars" value="2"><label for="star2">★</label>
                <input type="radio" id="star1" name="stars" value="1"><label for="star1">★</label>
            </div>

            <textarea name="text" rows="4" placeholder="Your Message" required></textarea>
            <input type="file" name="image" accept="image/*" required>
            <button type="submit">Submit Feedback</button>
        </form>
    </div>
</div>

<script>
    const feedbackBtn = document.getElementById('feedbackBtn');
    const feedbackModal = document.getElementById('feedbackModal');
    const closeModal = document.getElementById('closeModal');

    feedbackBtn.onclick = () => feedbackModal.style.display = 'block';
    closeModal.onclick = () => feedbackModal.style.display = 'none';
    window.onclick = (e) => {
        if (e.target === feedbackModal) feedbackModal.style.display = 'none';
    };
</script>

<?php include('partials-front/footer.php'); ?>
</body>
</html>
