<?php
session_start();
include('partials-front/menu.php');
include('config/constants.php');
?>
<header class="main-header">
    <div class="container header-container">
        <div class="logo-container">
            <h1 class="logo">
                <i class="fas fa-spa"></i>
                Flowerworld.
            </h1>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="categories.php">Categories</a></li>
                <li><a href="flower.php">Menu</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="cart.php">🛒 (<?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>)</a></li>
            </ul>
        </nav>
    </div>
</header>
<?php
$session_id = session_id();
// Fetch cart items
$sql = "SELECT * FROM tbl_cart WHERE user_session = '$session_id'";
$res = mysqli_query($conn, $sql);
$cart_count = mysqli_num_rows($res);
?>

<div class="cart-container container">
    <?php
    if (mysqli_num_rows($res) > 0) {
        $grand_total = 0;
        ?>
        <div class="cart-items">
            <div class="cart-header">
                <h2>Categories</h2>
                <div class="select-all">
                    <input type="checkbox" id="select-all" style="margin-right: 8px;">
                    <label for="select-all">SELECT ALL (<?php echo $cart_count; ?> ITEM(S))</label>
                </div>
            </div>
            <?php
            while ($row = mysqli_fetch_assoc($res)) {
                $item_total = $row['price'] * $row['qty'];
                $grand_total += $item_total;
                ?>
                <div class="cart-item">
                    <div class="item-image">
                        <img src="images/placeholder.jpg" alt="<?php echo $row['flower_name']; ?>" width="100" height="100">
                    </div>
                    <div class="item-details">
                        <div class="item-title"><?php echo $row['flower_name']; ?></div>
                        <div class="item-stock">Only 2 items(s) in stock</div>
                        <div class="item-price">Rs. <?php echo $row['price']; ?></div>
                        <div class="item-actions">
                            <form action="update-cart.php" method="POST" class="quantity-selector">
                                <input type="number" name="qty" value="<?php echo $row['qty']; ?>" min="1" onchange="this.form.submit()">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            </form>
                            <a href="remove-from-cart.php?id=<?php echo $row['id']; ?>" class="remove-btn">Remove</a>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
        <div class="order-summary">
            <h3>Order Summary</h3>
            <div class="summary-row">
                <span>Subtotal (<?php echo $cart_count; ?> Items)</span>
                <span>Rs. <?php echo $grand_total; ?></span>
            </div>
            <div class="summary-row">
                <span>Delivery charges</span>
                <span>Rs. 0</span>
            </div>
            <div class="summary-row total-row">
                <span>Total</span>
                <span>Rs. <?php echo $grand_total; ?></span>
            </div>
            <a href="checkout.php" class="checkout-btn">PROCEED TO CHECKOUT (<?php echo $cart_count; ?>)</a>
            <a href="flower.php" class="checkout-btn keep-shopping-btn">KEEP SHOPPING</a>
        </div>
        <?php
    } else {
        ?>
        <div class="empty-cart">
            <div class="empty-cart-icon">🛒</div>
            <h3>Your cart is empty</h3>
            <p>Looks like you haven't added anything to your cart yet</p>
           <a href="flower.php" class="button">Browse Products</a>
        </div>
        <?php
    }
    ?>
</div>
<?php include('partials-front/footer.php'); ?>
