<?php
session_start();
include('partials-front/menu.php');
include('config/constants.php');

// Get user session ID
$session_id = session_id();

// Fetch cart items
$sql = "SELECT * FROM tbl_cart WHERE user_session = '$session_id'";
$res = mysqli_query($conn, $sql);
$cart_count = mysqli_num_rows($res);
?>

<header class="main-header">
    <div class="container header-container">
        <div class="logo-container">
            <h1 class="logo">
                <img src="images/home/logo1.png" alt="Flowerworld Logo" style="height: 50px; vertical-align: middle;">
                Flowerworld
            </h1>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="categories.php">Occasions</a></li>
                <li><a href="flower.php">Bouquets</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="cart.php">🛒 (<?php echo $cart_count; ?>)</a></li>
            </ul>
        </nav>
    </div>
</header>

<div class="cart-container container">
    <?php if ($cart_count > 0): ?>
        <div class="cart-items">
            <div class="cart-header">
                <h2>Cart</h2>
                <div class="select-all">
                    <input type="checkbox" id="select-all" style="margin-right: 8px;">
                    <label for="select-all">SELECT ALL (<?php echo $cart_count; ?> ITEM(S))</label>
                </div>
            </div>

            <?php
            $grand_total = 0;
            while ($row = mysqli_fetch_assoc($res)):
                $item_total = $row['price'] * $row['qty'];
                $grand_total += $item_total;
                // Try to get image_name from tbl_flower if not present in tbl_cart
                $image_name = $row['image_name'];
                if (empty($image_name)) {
                    $fid = intval($row['flower_id']);
                    $img_res = mysqli_query($conn, "SELECT image_name FROM tbl_flower WHERE id = $fid LIMIT 1");
                    if ($img_res && mysqli_num_rows($img_res) > 0) {
                        $img_row = mysqli_fetch_assoc($img_res);
                        $image_name = $img_row['image_name'];
                    }
                }
                $image_file = !empty($image_name) && file_exists("images/flower/" . $image_name) ? $image_name : 'placeholder.jpg';
                $image_path = SITEURL . "images/flower/" . $image_file;
            ?>
                <div class="cart-item">
                    <div class="item-image">
                        <img src="<?php echo $image_path; ?>" alt="<?php echo $row['flower_name']; ?>" width="100" height="100">
                    </div>
                    <div class="item-details">
                        <div class="item-title"><?php echo htmlspecialchars($row['flower_name']); ?></div>
                        <div class="item-stock">Only 2 item(s) in stock</div>
                        <div class="item-price">Rs. <?php echo number_format($row['price'], 2); ?></div>
                        <div class="item-actions">
                            <form action="update-cart.php" method="POST" class="quantity-selector">
                                <input type="number" name="qty" value="<?php echo $row['qty']; ?>" min="1" onchange="this.form.submit()">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            </form>
                            <a href="remove-from-cart.php?id=<?php echo $row['id']; ?>" class="remove-btn">Remove</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>

        <div class="order-summary">
            <h3>Order Summary</h3>
            <div class="summary-row">
                <span>Subtotal (<?php echo $cart_count; ?> Items)</span>
                <span>Rs. <?php echo number_format($grand_total, 2); ?></span>
            </div>
            <div class="summary-row">
                <span>Delivery Charges</span>
                <span>Rs. 0.00</span>
            </div>
            <div class="summary-row total-row">
                <span>Total</span>
                <span>Rs. <?php echo number_format($grand_total, 2); ?></span>
            </div>
            <a href="checkout.php" class="checkout-btn">PROCEED TO CHECKOUT (<?php echo $cart_count; ?>)</a>
            <a href="flower.php" class="checkout-btn keep-shopping-btn">KEEP SHOPPING</a>
        </div>
    <?php else: ?>
        <div class="empty-cart">
            <div class="empty-cart-icon">🛒</div>
            <h3>Your cart is empty</h3>
            <p>Looks like you haven't added anything to your cart yet.</p>
            <a href="flower.php" class="button">Browse Products</a>
        </div>
    <?php endif; ?>
</div>

<?php include('partials-front/footer.php'); ?>
