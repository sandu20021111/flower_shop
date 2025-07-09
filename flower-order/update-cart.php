<?php
session_start();
include('config/constants.php');

if (isset($_POST['id']) && isset($_POST['qty'])) {
    $id = $_POST['id'];
    $qty = $_POST['qty'];

    if ($qty < 1) $qty = 1;

    $sql = "UPDATE tbl_cart SET qty = $qty WHERE id = $id AND user_session = '" . session_id() . "'";
    mysqli_query($conn, $sql);
}

header("Location: cart.php");
exit();
