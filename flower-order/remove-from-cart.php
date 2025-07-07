<?php
session_start();
include('config/constants.php');

if (isset($_GET['id'])) {
    $cart_item_id = $_GET['id'];

    // Delete the cart item
    $sql = "DELETE FROM tbl_cart WHERE id = $cart_item_id AND user_session = '" . session_id() . "'";
    $res = mysqli_query($conn, $sql);

}

// Redirect back to cart page
header('Location: cart.php');
exit();
?>
