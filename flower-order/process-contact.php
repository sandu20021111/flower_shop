<?php
// Enable error reporting for debugging (remove in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//database connection and constants file
include('config/constants.php');

// Ensure session is started if not already in constants.php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if the form is submitted via POST method and expected fields are set
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['message'])) {

    // 1. Get the data from the form
    $full_name = trim($_POST['name']);
    $user_email = trim($_POST['email']);
    $user_message = trim($_POST['message']);

    // 2. Sanitize and Validate the data
    // Escape special characters to prevent SQL Injection
    // Using mysqli_real_escape_string requires an active database connection.
    if (isset($conn)) {
        $full_name_db = mysqli_real_escape_string($conn, $full_name);
        $user_email_db = mysqli_real_escape_string($conn, $user_email);
        $user_message_db = mysqli_real_escape_string($conn, $user_message);
    } else {
        // Handle case where $conn is not set (database connection failed)
        $_SESSION['contact_message'] = "<div class='error text-center'>Database connection error. Message could not be saved.</div>";
        header("location:" . SITEURL . 'contact.php');
        exit();
    }


    // Basic Validation
    if (empty($full_name) || empty($user_email) || empty($user_message)) {
        $_SESSION['contact_message'] = "<div class='error text-center'>Please fill in all fields.</div>";
        header("location:" . SITEURL . 'contact.php');
        exit();
    }
    if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['contact_message'] = "<div class='error text-center'>Please enter a valid email address.</div>";
        header("location:" . SITEURL . 'contact.php');
        exit();
    }

    $message_status = "error"; // Default status

    //Part A: Save to Database
    $db_save_success = false;
    if (isset($conn)) {
        $sql = "INSERT INTO tbl_contact_messages SET
                full_name = '$full_name_db',
                email = '$user_email_db',
                message = '$user_message_db'"; // submission_date defaults to CURRENT_TIMESTAMP
        
        $res = mysqli_query($conn, $sql);

        if ($res == TRUE) {
            $db_save_success = true;
        } else {
            error_log("Database save failed: " . mysqli_error($conn));
            $_SESSION['contact_message'] = "<div class='error text-center'>Failed to save message to database.</div>";
        }
    } else {
        error_log("Database connection variable \$conn not found.");
        $_SESSION['contact_message'] = "<div class='error text-center'>Database connection not established. Message not saved.</div>";
    }

    //Part B: Send Email
    $email_send_success = false;
    $to_email = 'managerkmartsuper@gmail.com'; // The recipient email address
    $subject = 'New Contact Message from Flowerworld Website';

    $message_body = "You have received a new message from your Flowerworld website contact form:\n\n";
    $message_body .= "Name: " . $full_name . "\n";
    $message_body .= "Email: " . $user_email . "\n\n";
    $message_body .= "Message:\n" . $user_message;

    $headers = "From: managerkmartsuper@gmail.com\r\n"; // IMPORTANT: Replace with a real domain email
    $headers .= "Reply-To: " . $user_email . "\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
    $headers .= "Content-type: text/plain; charset=UTF-8\r\n";

    $mail_sent = mail($to_email, $subject, $message_body, $headers);

    if ($mail_sent) {
        $email_send_success = true;
    } else {
        $error_message = error_get_last()['message'] ?? 'Unknown mail error';
        error_log("Email send failed: " . $error_message . " To: " . $to_email . ", From: " . $user_email);
    }

    //Final User Feedback
    if ($db_save_success && $email_send_success) {
        $_SESSION['contact_message'] = "<div class='success text-center'>Thank you! Your message has been saved and sent. We will get back to you soon.</div>";
    } elseif ($db_save_success && !$email_send_success) {
        $_SESSION['contact_message'] = "<div class='warning text-center'>Message saved to database, but email failed to send. We will still get back to you!</div>";
    } elseif (!$db_save_success && $email_send_success) {
        $_SESSION['contact_message'] = "<div class='warning text-center'>Email sent successfully, but message could not be saved to database.</div>";
    } else {
        $_SESSION['contact_message'] = "<div class='error text-center'>Failed to send message and save to database. Please try again.</div>";
    }

    header("location:" . SITEURL . 'contact.php');
    exit();

} else {
    // If the form was not submitted via POST or fields are missing
    $_SESSION['contact_message'] = "<div class='error text-center'>Invalid request. Please submit the form.</div>";
    header("location:" . SITEURL . 'contact.php');
    exit();
}
?>