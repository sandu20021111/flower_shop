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
            color: #f02397;
        }

        .feedback-header {
            background-color: white;
            text-align: center;
            padding:80px 0 40px;
            margin-top: 60px;
        }

        .feedback-header h1 {
            font-size: 3rem;
            margin: 0;
            color: #807d7f;
            letter-spacing: 1px;
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
            display: flex;
            flex-direction: column;
        }

        .review-image {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
            margin: 0 auto 18px auto;
            border: 3px solid black;
        }

        .review-content {
            padding: 0 20px 20px 20px;
            text-align: center;
        }

        .review-text {
            font-size: 0.9rem;
            color: #555;
            margin-bottom: 15px;
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

        .review-name {
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
        }

        .review-stars {
            color: #ffd700;
            font-size: 1.2rem;
        }

        .feedback-float-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background-color: #f02397;
            color: white;
            border: none;
            padding: 20px 30px;
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
            overflow: auto;
            background-color: rgba(0,0,0,0.5);
        }

        .modal-content {
            background-color: #fff;
            margin: 8% auto;
            padding: 30px;
            border-radius: 10px;
            width: 90%;
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
        .feedback-form select,
        .feedback-form textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
        }

        .feedback-form button {
            width: 100%;
            padding: 12px;
            background-color: #f02397;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
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
        <a href="<?php echo SITEURL; ?>" class="logo"><img src="images/home/logo1.png" alt="Flowerworld Logo" style="height: 50px;"> Flowerworld</a>
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
            $img = !empty($row['image']) ? 'uploads/' . $row['image'] : 'images/default-user.png';
            echo '<div class="review-card">';
            echo '<img src="' . $img . '" alt="User" class="review-image">';
            echo '<div class="review-content">';
            echo '<p class="review-text">' . htmlspecialchars($row['text']) . '</p>';
            echo '<h3 class="review-name">' . htmlspecialchars($row['name']) . '</h3>';
            echo '<div class="review-stars">';
            for ($i = 0; $i < floor($row['stars']); $i++) {
                echo '<i class="fas fa-star"></i>';
            }
            if ($row['stars'] - floor($row['stars']) > 0) {
                echo '<i class="fas fa-star-half-alt"></i>';
            }
            echo '</div></div></div>';
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
            <select name="stars" required>
                <option value="">Rate Us</option>
                <option value="5">★★★★★ - Excellent</option>
                <option value="4">★★★★☆ - Very Good</option>
                <option value="3">★★★☆☆ - Good</option>
                <option value="2">★★☆☆☆ - Fair</option>
                <option value="1">★☆☆☆☆ - Poor</option>
            </select>
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
    window.onclick = (e) => { if (e.target == feedbackModal) feedbackModal.style.display = 'none'; }
</script>

<?php include('partials-front/footer.php'); ?>
</body>
</html>
