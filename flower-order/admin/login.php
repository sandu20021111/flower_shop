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
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - FlowerWorld. Flower Order System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }
        
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(135deg, #f18930, #ff6b6b);
            overflow: hidden;
            position: relative;
            }
        
        .login-container {
            background: rgba(255, 255, 255, 0.9);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            width: 400px;
            text-align: center;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            position: relative;
            overflow: hidden;
        }
        
        .login-container:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }
        
        .login-container::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(
                to bottom right,
                rgba(255, 255, 255, 0.3),
                rgba(255, 255, 255, 0.1)
            );
            transform: rotate(45deg);
            pointer-events: none;
        }
        
        .login-icon {
            font-size: 64px;
            color: #f18930;
            margin-bottom: 30px;
            animation: bounce 2s infinite;
        }
        
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-20px);
            }
            60% {
                transform: translateY(-10px);
            }
        }
        
        h1 {
            color: #333;
            margin-bottom: 30px;
            font-size: 28px;
            font-weight: bold;
        }
        
        .input-group {
            margin-bottom: 30px;
            position: relative;
        }
        
        .input-group input {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 25px;
            background-color: #f0f0f0;
            outline: none;
            font-size: 16px;
            transition: all 0.3s;
        }
        
        .input-group input:focus {
            background-color: #fff;
            box-shadow: 0 0 10px rgba(241, 137, 48, 0.3);
        }
        
        .input-group label {
            position: absolute;
            top: 50%;
            left: 20px;
            transform: translateY(-50%);
            color: #999;
            pointer-events: none;
            transition: 0.3s;
        }
        
        .input-group input:focus + label,
        .input-group input:valid + label {
            top: 0;
            left: 15px;
            font-size: 12px;
            color: #f18930;
            background-color: #fff;
            padding: 0 5px;
        }
        
        .btn-login {
            background-color: #f18930;
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 25px;
            cursor: pointer;
            font-size: 18px;
            font-weight: bold;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }
        
        .btn-login:hover {
            background-color: #e67e22;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(230, 126, 34, 0.4);
        }
        
        .btn-login::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background-color: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: all 0.5s;
        }
        
        .btn-login:active::after {
            width: 300px;
            height: 300px;
            opacity: 0;
        }
        
        .error-message, .success-message {
            margin-top: 20px;
            padding: 10px;
            border-radius: 5px;
            font-weight: bold;
            animation: fadeIn 0.5s;
        }
        
        .error-message {
            background-color: #ffecec;
            color: #ff4757;
        }
        
        .success-message {
            background-color: #e8f5e9;
            color: #2ed573;
        }
        

.animated-background {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: -1;
    opacity: 0.5;
}

.animated-background span {
    position: absolute;
    width: 20px;
    height: 20px;
    background: rgba(255, 255, 255, 0.2);
    animation: move 3s linear infinite;
    border-radius: 50%;
}

@keyframes move {
    0% {
        transform: translateY(0) rotate(0deg);
        opacity: 1;
        border-radius: 0;
    }
    100% {
        transform: translateY(-1000px) rotate(720deg);
        opacity: 0;
        border-radius: 50%;
    }
}

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
<div class="animated-background">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>
    <div class="login-container">
        <img src="../images/home/logo1.png" alt="Flowerworld Logo" style="height: 60px; vertical-align: middle;"><br><br>
        <h1>Admin Login</h1>
        <?php 
            if($login_message != '') {
                echo '<p class="' . (strpos($login_message, 'Success') !== false ? 'success-message' : 'error-message') . '">' . $login_message . '</p>';
            }
            if($no_login_message != '') {
                echo '<p class="error-message">' . $no_login_message . '</p>';
            }
        ?>
        <form action="" method="POST">
        <div class="input-group">
                <input type="text" name="username" required>
                <label>Username</label>
            </div>
            <div class="input-group">
                <input type="password" name="password" required>
                <label>Password</label>
            </div>
            <button type="submit" name="submit" class="btn-login">Login</button>
        </form>
    </div>

    <script>
       
       const inputs = document.querySelectorAll('.input-group input');
        inputs.forEach(input => {
            input.addEventListener('focus', () => {
                input.parentNode.classList.add('focus');
            });
            input.addEventListener('blur', () => {
                if (input.value === '') {
                    input.parentNode.classList.remove('focus');
                }
            });
        });

        
        const loginBtn = document.querySelector('.btn-login');
        loginBtn.addEventListener('click', function(e) {
            let x = e.clientX - e.target.offsetLeft;
            let y = e.clientY - e.target.offsetTop;
            
            let ripple = document.createElement('span');
            ripple.style.left = `${x}px`;
            ripple.style.top = `${y}px`;
            this.appendChild(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 600);
        });

        document.addEventListener('DOMContentLoaded', function() {
    const background = document.querySelector('.animated-background');
    const spans = background.querySelectorAll('span');

    spans.forEach(span => {
        const size = Math.random() * 50 + 10; 
        span.style.width = `${size}px`;
        span.style.height = `${size}px`; 
        span.style.top = `${Math.random() * 100}%`;
        span.style.left = `${Math.random() * 100}%`;
        span.style.animationDuration = `${Math.random() * 2 + 2}s`; 
        span.style.animationDelay = `${Math.random() * 2}s`;
    });
});
    </script>
</body>
</html>