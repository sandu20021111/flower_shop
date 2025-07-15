<?php
include('config/constants.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $stars = (float) $_POST['stars'];
    $text = mysqli_real_escape_string($conn, $_POST['text']);

    // Handle image upload
    $image_name = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];

    // Rename image to avoid conflicts
    $target_dir = "uploads/";
    $new_image_name = time() . "_" . basename($image_name);
    $target_path = $target_dir . $new_image_name;

    // Ensure uploads folder exists
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    // Move the file to uploads/
    if (move_uploaded_file($image_tmp, $target_path)) {
        $sql = "INSERT INTO tbl_feedback (name, stars, text, image) VALUES ('$name', $stars, '$text', '$new_image_name')";
        $res = mysqli_query($conn, $sql);

        if ($res) {
            header("Location: feedback.php?success=1");
            exit();
        } else {
            echo "Database error: " . mysqli_error($conn);
        }
    } else {
        echo "Image upload failed.";
    }
}
?>
