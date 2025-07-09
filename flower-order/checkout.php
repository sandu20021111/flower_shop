<?php
session_start();
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
    <title>Checkout</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #fff5f5;;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 40px auto;
            background: #fff7f7;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #c0392b;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            margin-bottom: 40px;
            border-collapse: collapse;
        }

        table th {
            background:#ff6b6b;
            color: white;
            padding: 14px;
        }

        table td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }

        tr:nth-child(even) {
            background-color: #fff0f0;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            color:  #c0392b;
            margin-bottom: 8px;
        }

        input[type="text"], input[type="email"], textarea {
            width: 100%;
            padding: 12px;
            border-radius: 6px;
            border: 1px solid #ff8787;
            font-size: 15px;
            transition: border 0.3s;
        }

        input[type="text"]:focus, input[type="email"]:focus, textarea:focus {
            border-color: #38a169;
            outline: none;
        }

        textarea {
            resize: vertical;
        }

        button {
            background:#ff6b6b;
            color: white;
            padding: 14px 24px;
            font-size: 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background:  #e05353;
        }

        .form-group.center {
            text-align: center;
        }
    </style>
</head>
<body>

<div class="container">
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
            <button type="submit">✅ Place Order</button>
        </div>
    </form>
</div>

</body>
</html>
