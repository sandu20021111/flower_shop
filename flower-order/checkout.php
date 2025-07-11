<?php 
session_start();
include('partials-front/menu.php');
include('config/constants.php');

$session_id = session_id();

// Fetch cart items
$sql = "SELECT * FROM tbl_cart WHERE user_session = '$session_id'";
$res = mysqli_query($conn, $sql);
$cart_items = [];

if (mysqli_num_rows($res) > 0) {
    while ($row = mysqli_fetch_assoc($res)) {
        $cart_items[] = $row;
    }
} else {
    header("Location: index.php");
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_name = mysqli_real_escape_string($conn, $_POST['name']);
    $customer_contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $customer_email = mysqli_real_escape_string($conn, $_POST['email']);
    $customer_address = mysqli_real_escape_string($conn, $_POST['address']);
    $order_date = date("Y-m-d H:i:s");
    $status = "Ordered";

    foreach ($cart_items as $item) {
        $flower = mysqli_real_escape_string($conn, $item['flower_name']);
        $price = $item['price'];
        $qty = $item['qty'];
        $total = $price * $qty;

        $sql_order = "INSERT INTO tbl_order (flower, price, qty, total, order_date, status, customer_name, customer_contact, customer_email, customer_address)
                      VALUES ('$flower', $price, $qty, $total, '$order_date', '$status', '$customer_name', '$customer_contact', '$customer_email', '$customer_address')";
        mysqli_query($conn, $sql_order);
    }

    mysqli_query($conn, "DELETE FROM tbl_cart WHERE user_session = '$session_id'");
    header("Location: cart.php?success=1");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout | Flowerworld</title>
    <link rel="stylesheet" href="checkout.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" rel="stylesheet">
</head>
<body>

<header class="main-header">
    <div class="container header-container">
        <div class="logo-container">
            <h1 class="logo">
                <i class="fas fa-spa"></i> Flowerworld.
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

<div class="container-checkout">
    <h2>🛍️ Checkout</h2>
  

    <table>
        <tr><th>Flower</th><th>Price</th><th>Qty</th><th>Total</th></tr>
        <?php
        $grand_total = 0;
        foreach ($cart_items as $item) {
            $total = $item['price'] * $item['qty'];
            $grand_total += $total;
            echo "<tr>
                    <td>{$item['flower_name']}</td>
                    <td>Rs. {$item['price']}</td>
                    <td>{$item['qty']}</td>
                    <td>Rs. $total</td>
                  </tr>";
        }
        echo "<tr>
                <td colspan='3'><strong>Grand Total</strong></td>
                <td><strong>Rs. $grand_total</strong></td>
              </tr>";
        ?>
    </table>

    <form method="POST" action="">
        <div class="form-group">
            <label>Your Name:</label>
            <input type="text" name="name" required>
        </div>

        <div class="form-group">
            <label>Contact Number:</label>
            <input type="text" name="contact" required>
        </div>

        <div class="form-group">
            <label>Email Address:</label>
            <input type="email" name="email" required>
        </div>

        <div class="form-group">
            <label>Delivery Address:</label>
            <textarea name="address" rows="4" required></textarea>
        </div>

        <div class="form-group center">
            <button type="submit"><i class="fas fa-check-circle"></i> Place Order</button>
        </div>
    </form>
</div>

<?php include('partials-front/footer.php'); ?>
</body>
</html>
