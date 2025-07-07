<?php
include('config/constants.php');

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Check if username already exists
    $check_username = "SELECT * FROM tbl_admin WHERE username='$username'";
    $result = mysqli_query($conn, $check_username);
    if (mysqli_num_rows($result) > 0) {
        echo json_encode(['success' => false, 'message' => 'Username already exists']);
        exit();
    }

    
error_log("Received POST data: " . print_r($_POST, true));

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = isset($_POST['full_name']) ? mysqli_real_escape_string($conn, $_POST['full_name']) : '';
    $username = isset($_POST['username']) ? mysqli_real_escape_string($conn, $_POST['username']) : '';
    $password = isset($_POST['password']) ? mysqli_real_escape_string($conn, $_POST['password']) : '';

    // Log escaped data
    error_log("Escaped data - Full Name: $full_name, Username: $username, Password: [REDACTED]");

    if (empty($full_name) || empty($username) || empty($password)) {
        echo json_encode(['success' => false, 'message' => 'All fields are required']);
        exit();
    }
 
 
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO tbl_admin (full_name, username, password) VALUES ('$full_name', '$username', '$hashed_password')";

    $res = mysqli_query($conn, $sql);

    if ($res) {
        echo json_encode(['success' => true, 'message' => 'Admin added successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . mysqli_error($conn)]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}

if (mysqli_error($conn)) {
    error_log("MySQL Error: " . mysqli_error($conn));
}

mysqli_close($conn);
?>