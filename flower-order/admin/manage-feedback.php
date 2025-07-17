<?php
// Start session if not already started 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include('../config/constants.php'); 
include('partials/menu.php');       

// Check if admin is logged in
if (!isset($_SESSION['user'])) {
    $_SESSION['no-login-message'] = "<div class='error text-center'>Please login to access Admin Panel.</div>";
    header('location:' . SITEURL . 'admin/login.php'); 
    exit();
}
?>

<style>

/* Main content and cards styling */

.main-content {
    padding: 40px 50px;
    background-color: #f7f7f7;
    min-height: 100vh;
}

.dashboard-title {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: #333;
    margin-bottom: 30px;
}

.feedback-cards {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 25px;
}

.feedback-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 5px 18px rgba(0,0,0,0.1);
    padding: 20px;
    display: flex;
    flex-direction: column;
    gap: 15px;
    transition: transform 0.2s ease;
}

.feedback-card:hover {
    transform: translateY(-5px);
}

.feedback-card img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
            margin: 0 auto 18px auto;
            border: 3px solid black;
        }

.feedback-info {
    font-family: Arial, sans-serif;
    color: #444;
}

.feedback-info strong {
    color: #222;
}

.feedback-stars {
    color: #f39c12;
    font-weight: bold;
}   


.feedback-message {
    font-style: italic;
    white-space: pre-wrap; /* preserve line breaks */
    color: #555;
}
</style>

<div class="dashboard-container">
    <div class="sidebar">
        <div class="logo">
            <h1>Flowerworld</h1>
        </div>
        <nav>
            <a href="index.php" class="active"><i class="fas fa-home"></i> <span>Dashboard</span></a>
            <a href="manage-admin.php"><i class="fas fa-users-cog"></i> <span>Admin</span></a>
            <a href="manage-category.php"><i class="fas fa-gift"></i> <span>Occasions</span></a>
            <a href="manage-flower.php"><i class="fas fa-spa"></i> <span>Flowers</span></a>
            <a href="manage-order.php"><i class="fas fa-shopping-cart"></i> <span>Order</span></a>
            <a href="feedback.php"><i class="fas fa-comments"></i> <span>Feedback</span></a>
        </nav>
        <div class="sidebar-footer">
            <div class="user-profile">
                <i class="fas fa-user"></i>
                <span><?php echo $_SESSION['user']; ?></span>
            </div>
            <a href="logout.php" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </div>

    <div class="main-content">
        <h1 class="dashboard-title">
            <span class="title-icon"><i class="fas fa-comments"></i></span>
            Feedback
        </h1>

    <?php
    $sql = "SELECT * FROM tbl_feedback ORDER BY id DESC";
    $res = mysqli_query($conn, $sql);

    if ($res && mysqli_num_rows($res) > 0) {
        echo '<div class="feedback-cards">';
        while ($row = mysqli_fetch_assoc($res)) {
            echo '<div class="feedback-card">';
            echo '<img src="../uploads/' . htmlspecialchars($row['image']) . '" alt="Feedback Image">';
            echo '<div class="feedback-info"><strong>Name:</strong> ' . htmlspecialchars($row['name']) . '</div>';
            echo '<div class="feedback-info feedback-stars"><strong>Stars:</strong> ' . htmlspecialchars($row['stars']) . ' ★</div>';
            echo '<div class="feedback-message">' . nl2br(htmlspecialchars($row['text'])) . '</div>';
            echo '</div>';
        }
        echo '</div>';
    } else {
        echo "<p>No feedbacks found.</p>";
    }
    ?>
</div>

<?php include('partials/footer.php'); ?>
