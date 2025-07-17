<?php 
session_start();
include('../config/constants.php');


$login_message = '';
$no_login_message = '';


if(isset($_POST['submit']))
{
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $raw_password = md5($_POST['password']);
    $password = mysqli_real_escape_string($conn, $raw_password);

    $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);

    if($count==1)
    {
        $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
        $_SESSION['user'] = $username;
        header('location:'.SITEURL.'admin/index.php');
        exit(); 
    }
    else
    {
        $login_message = "<div class='error text-center'>Username or Password did not match.</div>";
    }
}

if(isset($_SESSION['login']))
{
    $login_message = $_SESSION['login'];
    unset($_SESSION['login']);
}

if(isset($_SESSION['no-login-message']))
{
    $no_login_message = $_SESSION['no-login-message'];
    unset($_SESSION['no-login-message']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Login - FlowerWorld</title>
  <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Quicksand', sans-serif;
    }

    body {
      height: 100vh;
      background: linear-gradient(to right, #2c3e50, #a685d1, #ed2884);
      overflow: hidden;
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
    }

    .floating-flowers img {
      position: absolute;
      animation: float 14s linear infinite;
      opacity: 0.5;
    }

    @keyframes float {
      0% {
        transform: translateY(100vh) rotate(0deg);
        opacity: 0.8;
      }
      100% {
        transform: translateY(-100vh) rotate(360deg);
        opacity: 0;
      }
    }

    .login-card {
      background: white;
      border-radius: 25px;
      box-shadow: 0 8px 24px rgba(255, 255, 255, 0.15);
      padding: 40px;
      width: 380px;
      position: relative;
      z-index: 2;
      text-align: center;
    }

    .login-card img.logo {
      width: 60px;
      margin-bottom: 15px;
    }

    .login-card h2 {
      margin-bottom: 25px;
      font-size: 24px;
      color: #c44569;
    }

    .input-box {
      margin-bottom: 20px;
      position: relative;
    }

    .input-box input {
      width: 100%;
      padding: 14px 15px;
      border: 1px solid #ddd;
      border-radius: 10px;
      font-size: 16px;
      outline: none;
      transition: all 0.3s;
    }

    .input-box input:focus {
      border-color: #c44569;
      box-shadow: 0 0 5px rgba(196, 69, 105, 0.4);
    }

    .btn-submit {
      padding: 14px 30px;
      border: none;
      background-color: #c44569;
      color: white;
      font-size: 16px;
      border-radius: 10px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .btn-submit:hover {
      background-color: #b3395d;
    }

    .message {
      margin-top: 15px;
      font-weight: bold;
    }

    .error-message {
      color: #d63031;
    }

    .success-message {
      color: #2ecc71;
    }
  </style>
</head>
<body>

<!-- Floating flowers -->
<div class="floating-flowers">
  <img src="../images/home/flower3.png" style="left: 5%; width: 50px; animation-delay: 3s;">
  <img src="../images/home/flower1.png" style="left: 15%; width: 50px; animation-delay: 2s;">
  <img src="../images/home/flower3.png" style="left: 30%; width: 60px; animation-delay: 4s;">
  <img src="../images/home/flower1.png" style="left: 55%; width: 55px; animation-delay: 6s;">
  <img src="../images/home/flower3.png" style="left: 65%; width: 40px; animation-delay: 3s;">
  <img src="../images/home/flower1.png" style="left: 80%; width: 65px; animation-delay: 5s;">
  <img src="../images/home/flower3.png" style="left: 40%; width: 75px; animation-delay: 7s;">
  <img src="../images/home/flower1.png" style="left: 95%; width: 50px; animation-delay: 1s;">
</div>

<!-- Login Card -->
<div class="login-card">
  <img src="../images/home/logo1.png" alt="FlowerWorld Logo" class="logo" />
  <h2>Admin Login</h2>

  <?php 
    if($login_message != '') {
        echo '<p class="message ' . (strpos($login_message, 'Success') !== false ? 'success-message' : 'error-message') . '">' . $login_message . '</p>';
    }
    if($no_login_message != '') {
        echo '<p class="message error-message">' . $no_login_message . '</p>';
    }
  ?>

  <form action="" method="POST">
    <div class="input-box">
      <input type="text" name="username" placeholder="Username" required />
    </div>
    <div class="input-box">
      <input type="password" name="password" placeholder="Password" required />
    </div>
    <button type="submit" name="submit" class="btn-submit">Login</button>
  </form>
</div>

</body>
</html>