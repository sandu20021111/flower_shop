<?php
session_start();
include('config/constants.php'); 


$session_id = session_id();

// Fetch cart items
$sql = "SELECT * FROM tbl_cart WHERE user_session = '$session_id'";
$res = mysqli_query($conn, $sql);

// Get cart count for icon
$cart_count = mysqli_num_rows($res);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Cart</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            color: #333;
            margin: 0;
            padding-top: 80px;
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
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 90%;
            max-width: 1000px;
            margin: auto;
        }

        .logo-container {
            display: flex;
            align-items: center;
        }

        .logo {
            color: #ffd166;
            font-size: 24px;
            font-weight: 700;
            letter-spacing: 1px;
            margin: 0;
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
            padding: 5px 10px;
            border-radius: 5px;
        }

        nav ul li a:hover {
            color: #ffd166;
            background-color: rgba(255, 255, 255, 0.1);
        }

            .container {
            width: 90%;
            max-width: 1000px;
            margin: 20px auto;
            background: #ffeaea;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            display: flex;
            flex-wrap: nowrap; 
            gap: 20px; 
        }
         .button {
            display: inline-block;
             padding: 12px 20px;
            background: #1e90ff;
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
            border: none;
            cursor: pointer;
            margin-top: 15px;
            }

    .button:hover {
    background: #187bcd;
}
        .empty-cart {
        text-align: center;
         width: 100%;
        padding: 80px 20px;
        color: #333;
         background: #ffeaea; 
        border-radius: 8px;
        box-shadow: 0 2px 15px rgba(0,0,0,0.05);
         margin-top: 20px;
}

.empty-cart-icon {
    font-size: 60px;
    color: #3498db; 
    margin-bottom: 20px;
}

.empty-cart h3 {
    font-size: 24px;
    color: #444;
    margin-bottom: 10px;
}

.empty-cart p {
    font-size: 16px;
    color: gray;
    margin-bottom: 30px;
}

.button {
    display: inline-block;
    padding: 12px 25px;
    background:#ff6b6b;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    font-weight: bold;
    font-size: 16px;
    transition: background 0.3s ease;
}

.button:hover {
    background: #e05353;
}


     .cart-items {
    flex: 2; 
    overflow-y: auto;
    max-height: 600px;
}

    .order-summary {
    flex: 1; 
    background: #f9f9f9;
    padding: 20px;
    border-radius: 8px;
}

        .cart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        .cart-header h2 {
            margin: 0;
            font-size: 20px;
        }

        .select-all {
            display: flex;
            align-items: center;
            font-size: 14px;
            color: #666;
        }

        .cart-item {
            display: flex;
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }

        .item-image {
            width: 100px;
            height: 100px;
            background: #f5f5f5;
            margin-right: 15px;
            border-radius: 4px;
        }

        .item-details {
            flex: 1;
        }

        .item-title {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .item-stock {
            color: #e53935;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .item-price {
            font-weight: bold;
            font-size: 18px;
            margin-bottom: 10px;
        }

        .item-actions {
            display: flex;
            align-items: center;
        }

        .quantity-selector {
            display: flex;
            align-items: center;
            margin-right: 15px;
        }

        .quantity-selector input {
            width: 40px;
            text-align: center;
            padding: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .remove-btn {
            color: #666;
            text-decoration: none;
            font-size: 14px;
        }

        .remove-btn:hover {
            color: #e53935;
        }

        .order-summary h3 {
            margin-top: 0;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-size: 14px;
        }

        .total-row {
            font-weight: bold;
            font-size: 16px;
            margin: 15px 0;
            padding-top: 15px;
            border-top: 1px solid #eee;
        }

        .checkout-btn {
            display: block;
            width: 100%;
            padding: 12px;
            background-color: #ff6b6b;
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
            border: none;
            cursor: pointer;
            margin-bottom: 10px;
        }

        .checkout-btn:hover {
            background-color: #ff5252;
        }

        .keep-shopping-btn {
            background: #fbc02d;
        }

        .keep-shopping-btn:hover {
            background: #f9a825;
        }

        .empty-cart {
            text-align: center;
            width: 100%;
            padding: 50px 0;
            color: #666;
        }

        .empty-cart-icon {
            font-size: 50px;
            margin-bottom: 20px;
        }

        .category-link {
            color: #666;
            text-decoration: none;
            font-size: 14px;
        }

        .category-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<!-- HEADER -->
<header class="main-header">
    <div class="header-container">
        <div class="logo-container">
            <h1 class="logo">Bite.</h1>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="categories.php">Categories</a></li>
                <li><a href="flower.php">Bouquets</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="cart.php">🛒 (<?php echo $cart_count; ?>)</a></li>
            </ul>
        </nav>
    </div>
</header>

<!-- MAIN CART SECTION -->
<div class="container">
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
</body>
</html>
