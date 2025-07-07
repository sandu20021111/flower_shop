<?php
session_start();
include('config/constants.php');

if (isset($_GET['flower_id'])) {
    $flower_id = intval($_GET['flower_id']); // Changed from $food_id to $flower_id
    $session_id = session_id();

    // Check if this flower is already in the cart
    $check_sql = "SELECT * FROM tbl_cart WHERE flower_id = $flower_id AND user_session = '$session_id'";
    $check_res = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($check_res) > 0) {
        // If item exists, just increase the quantity
        $update_sql = "UPDATE tbl_cart SET qty = qty + 1 WHERE flower_id = $flower_id AND user_session = '$session_id'";
        mysqli_query($conn, $update_sql);
    } else {
        // Fetch flower details
        $flower_sql = "SELECT * FROM tbl_flower WHERE id = $flower_id AND active='Yes'";
        $flower_res = mysqli_query($conn, $flower_sql);

        if (mysqli_num_rows($flower_res) > 0) {
            $flower = mysqli_fetch_assoc($flower_res);
            $flower_name = mysqli_real_escape_string($conn, $flower['title']);
            $price = floatval($flower['price']);

            // Insert into tbl_cart
            $insert_sql = "INSERT INTO tbl_cart (flower_id, flower_name, price, qty, user_session) 
                           VALUES ($flower_id, '$flower_name', $price, 1, '$session_id')";
            mysqli_query($conn, $insert_sql);
        }
    }

    // Redirect to cart page
    header('Location: cart.php');
    exit();
} else {
    // Redirect back to home if no flower_id
    header('Location: index.php');
    exit();
}
