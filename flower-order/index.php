<?php
include('partials-front/menu.php');
?>

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

<section id="home" class="hero">
    <div class="hero-bg">
        <video autoplay muted loop class="background-video">
            <source src="images/home/home.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>

    <div class="hero-content">
        <h2>Delivery fresh flowers to your Doorstep</h2>
        <p>Explore our wide range of blooms and order now!</p>
        <div class="search-container">
            <form action="<?php echo SITEURL; ?>flower-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for flowers..." class="search-input" required>
                <button type="submit" name="submit" class="search-btn"><i class="fas fa-search"></i></button>
            </form>
        </div>
    </div>
</section>

<section id="categories" class="categories">
    <div class="container">
        <h2 class="section-title">Explore Flowers</h2>
        <div class="category-grid">
            <?php
            $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";
            $res = mysqli_query($conn, $sql);
            if ($res == TRUE) {
                $count = mysqli_num_rows($res);
                if ($count > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>
                        <a href="<?php echo SITEURL; ?>category-flower.php?category_id=<?php echo $id; ?>" class="category-item">
                            <?php
                            if ($image_name == "") {
                                echo "<div class='error'>Image not Available</div>";
                            } else {
                                ?>
                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="<?php echo $title; ?>"
                                     class="category-img">
                                <?php
                            }
                            ?>
                            <h3 class="category-title"><?php echo $title; ?></h3>
                        </a>
                        <?php
                    }
                } else {
                    echo "<div class='error'>Category not Added.</div>";
                }
            }
            ?>
        </div>
    </div>
</section>

<section id="menu" class="flower-menu">
    <div class="container">
        <h2 class="section-title">Flower Gallery</h2>
        <div class="menu-grid">
            <?php
            $sql2 = "SELECT * FROM tbl_flower WHERE active='Yes' AND featured='Yes' LIMIT 6";
            $res2 = mysqli_query($conn, $sql2);
            $count2 = mysqli_num_rows($res2);
            if ($count2 > 0) {
                while ($row = mysqli_fetch_assoc($res2)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
                    ?>
                    <div class="flower-item">
                        <?php
                        if ($image_name == "") {
                            echo "<div class='error'>Image not available.</div>";
                        } else {
                            ?>
                            <img src="<?php echo SITEURL; ?>images/flower/<?php echo $image_name; ?>" alt="<?php echo $title; ?>"
                                 class="flower-img">
                            <?php
                        }
                        ?>
                        <h3 class="flower-title"><?php echo $title; ?></h3>
                        <p class="flower-price">Rs.<?php echo $price; ?></p>
                        <p class="flower-description"><?php echo $description; ?></p>
                        <a href="<?php echo SITEURL; ?>order.php?flower_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                        <a href="<?php echo SITEURL; ?>add-to-cart.php?flower_id=<?php echo $id; ?>" class="btn btn-primary">Add to Cart</a>
                    </div>
                    <?php
                }
            } else {
                echo "<div class='error'>Flowers not available.</div>";
            }
            ?>
        </div>
        <p class="text-center">
            <a href="<?php echo SITEURL; ?>flower.php" class="btn btn-primary">See All Flowers</a>
        </p>
    </div>
</section>

<?php include('partials-front/footer.php'); ?>
