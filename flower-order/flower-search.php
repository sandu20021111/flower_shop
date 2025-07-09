<?php 
include('partials-front/menu.php');


$search = '';
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}


if(isset($_POST['search'])) {
   
    $search = mysqli_real_escape_string($conn, $_POST['search']);
} elseif(isset($_GET['search'])) {
    
    $search = mysqli_real_escape_string($conn, $_GET['search']);
}


$count = 0;

if(!empty($search)) {
   
    $sql = "SELECT * FROM tbl_flower WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

    
    $res = mysqli_query($conn, $sql);

  
    $count = mysqli_num_rows($res);
}
?>

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


<section class="flower-search">
    <div class="container">
        <div class="search-results-container">
            <h2 class="search-title">Search Results</h2>
            <div class="search-info">
                <span class="search-term">"<?php echo htmlspecialchars($search); ?>"</span>
                <span class="search-count"><?php echo $count; ?></span>
                <span class="search-count-text"><?php echo $count != 1 ? 'results' : 'result'; ?> found</span>
            </div>
        </div>
    </div>
</section>



<section class="flower-menu">
    <div class="container">
        <h2 class="section-title">Flower Menu</h2>
        <div class="menu-grid">
            <?php 
            if($count > 0) {
                while($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $description = $row['description'];
                    $price = $row['price'];
                    $image_name = $row['image_name'];
            ?>
                <div class="flower-item" data-aos="fade-up" data-aos-delay="100">
                    <img src="<?php echo SITEURL; ?>images/flower/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="food-img">
                    <div class="flower-info">
                        <h3 class="flower-title"><?php echo $title; ?></h3>
                        <p class="flower-price">Rs.<?php echo $price; ?></p>
                        <p class="flower-description"><?php echo $description; ?></p>
                        <a href="<?php echo SITEURL; ?>order.php?flower_id=<?php echo $id; ?>" class="btn">Order Now</a>
                        <a href="<?php echo SITEURL; ?>add-to-cart.php?flower_id=<?php echo $id; ?>" class="btn btn-primary">Add to Cart</a>
                    </div>
                </div>
            <?php
                }
            } else {
                echo "<div class='error'>No flowers found matching your search.</div>";
            }
            ?>
        </div>
    </div>
</section>


<?php include('partials-front/footer.php'); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
    AOS.init({
        duration: 800,
        easing: 'ease-in-out',
        once: true,
        mirror: false
    });

document.addEventListener('DOMContentLoaded', function() {
    const searchCount = document.querySelector('.search-count');
    const finalCount = parseInt(searchCount.textContent);
    let currentCount = 0;

    function animateCount() {
        if (currentCount < finalCount) {
            currentCount++;
            searchCount.textContent = currentCount;
            requestAnimationFrame(animateCount);
        }
    }

    animateCount();


    const searchTerm = document.querySelector('.search-term');
    searchTerm.innerHTML = searchTerm.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

    anime.timeline({loop: false})
        .add({
            targets: '.search-term .letter',
            translateY: [100,0],
            translateZ: 0,
            opacity: [0,1],
            easing: "easeOutExpo",
            duration: 1400,
            delay: (el, i) => 300 + 30 * i
        });
});
</script>