<?php
// Only define constants if not already defined (avoids duplicate define errors)
if (!defined('SITEURL'))     define('SITEURL', 'http://localhost/flower_shop/flower-order/');
if (!defined('LOCALHOST'))   define('LOCALHOST', 'localhost');
if (!defined('DB_USERNAME')) define('DB_USERNAME', 'root');
if (!defined('DB_PASSWORD')) define('DB_PASSWORD', '');
if (!defined('DB_NAME'))     define('DB_NAME', 'flower-order');

// Create Database Connection
$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($conn));

// Select Database
$db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error($conn));
?>
