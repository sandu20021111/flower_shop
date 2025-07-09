<?php 
include('partials-front/menu.php');
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

<section class="categories">
    <div class="container">
        <h2 class="section-title">Explore Flowers</h2>
        
        <div class="sort-controls">
            <button class="sort-btn" data-sort="name-asc">Name (A-Z)</button>
            <button class="sort-btn" data-sort="name-desc">Name (Z-A)</button>
            <button class="sort-btn" data-sort="date-asc">Oldest</button>
            <button class="sort-btn" data-sort="date-desc">Newest</button>
        </div>

        <div class="category-grid">
            <?php 
            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);

            if($count > 0) {
                while($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    $date_modified = $row['date_modified']; 
            ?>
                    <div class="category-item" data-name="<?php echo $title; ?>" data-date="<?php echo $date_modified; ?>">
                        <a href="<?php echo SITEURL; ?>category-flower.php?category_id=<?php echo $id; ?>">
                            <?php 
                            if($image_name == "") {
                                echo "<div class='error'>Image not found.</div>";
                            } else {
                            ?>
                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="category-img">
                            <?php
                            }
                            ?>
                            <h3 class="category-title"><?php echo $title; ?></h3>
                        </a>
                    </div>
            <?php
                }
            } else {
                echo "<div class='error'>No categories found.</div>";
            }
            ?>
        </div>
    </div>
</section>

<?php include('partials-front/footer.php'); ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const grid = document.querySelector('.category-grid');
    const sortBtns = document.querySelectorAll('.sort-btn');

    sortBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const sortType = btn.getAttribute('data-sort');
            sortCategories(sortType);
        });
    });

    function sortCategories(sortType) {
        const items = Array.from(grid.children);
        items.sort((a, b) => {
            if (sortType === 'name-asc') {
                return a.getAttribute('data-name').localeCompare(b.getAttribute('data-name'));
            } else if (sortType === 'name-desc') {
                return b.getAttribute('data-name').localeCompare(a.getAttribute('data-name'));
            } else if (sortType === 'date-asc') {
                return new Date(a.getAttribute('data-date')) - new Date(b.getAttribute('data-date'));
            } else if (sortType === 'date-desc') {
                return new Date(b.getAttribute('data-date')) - new Date(a.getAttribute('data-date'));
            }
        });
        items.forEach(item => grid.appendChild(item));
    }
});
</script>