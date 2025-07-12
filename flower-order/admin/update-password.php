<?php
include('../config/constants.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user'])) {
    $_SESSION['no-login-message'] = "<div class='error text-center'>Please login to access Admin Panel.</div>";
    header('location:' . SITEURL . 'admin/login.php'); // ✅ Correct page
    exit();
}
?>

<?php include('partials/menu.php'); ?>

<div class="dashboard-container">
    <div class="sidebar">
        <div class="logo">
            <h1>Flowerworld</h1>
        </div>
        <nav>
            <a href="index.php"><i class="fas fa-home"></i> <span>Dashboard</span></a>
            <a href="manage-admin.php"><i class="fas fa-users-cog"></i> <span>Admin</span></a>
            <a href="manage-category.php"><i class="fas fa-gift"></i> <span>Occasions</span></a>
            <a href="manage-flower.php"><i class="fas fa-spa"></i> <span>Flowers</span></a>
            <a href="manage-order.php"><i class="fas fa-shopping-cart"></i> <span>Order</span></a>
        </nav>
        <div class="sidebar-footer">
            <div class="user-profile">
                <i class="fas fa-user"></i>
                <span><?php echo $_SESSION['user']; ?></span>
            </div>
            <a href="logout.php" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </div>

    <div class="main-content">
        <h1 class="dashboard-title">
            <span class="title-icon"><i class="fas fa-key"></i></span>
            Change Password
        </h1>

        <div class="password-form-container">
            <?php 
                if(isset($_GET['id']))
                {
                    $id=$_GET['id'];
                }
            ?>

            <form action="" method="POST" class="password-form" id="passwordForm">
                <div class="form-group">
                    <label for="current_password">Current Password</label>
                    <div class="password-input-group">
                        <input type="password" id="current_password" name="current_password" placeholder="Enter current password" required>
                        <i class="fas fa-eye toggle-password"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label for="new_password">New Password</label>
                    <div class="password-input-group">
                        <input type="password" id="new_password" name="new_password" placeholder="Enter new password" required>
                        <i class="fas fa-eye toggle-password"></i>
                    </div>
                    <div class="password-strength-meter">
                        <div class="meter-bar"></div>
                    </div>
                    <p class="password-strength-text"></p>
                </div>

                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <div class="password-input-group">
                        <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm new password" required>
                        <i class="fas fa-eye toggle-password"></i>
                    </div>
                </div>

                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <button type="submit" name="submit" class="btn-change-password">
                    <i class="fas fa-sync-alt"></i> Change Password
                </button>
            </form>
        </div>

<?php 

            
            if(isset($_POST['submit']))
            {
               
                $id=$_POST['id'];
                $current_password = md5($_POST['current_password']);
                $new_password = md5($_POST['new_password']);
                $confirm_password = md5($_POST['confirm_password']);


                
                $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

              
                $res = mysqli_query($conn, $sql);

                if($res==true)
                {
                    
                    $count=mysqli_num_rows($res);

                    if($count==1)
                    {
                        

                        
                        if($new_password==$confirm_password)
                        {
                            
                            $sql2 = "UPDATE tbl_admin SET 
                                password='$new_password' 
                                WHERE id=$id
                            ";

                            
                            $res2 = mysqli_query($conn, $sql2);

                            
                            if($res2==true)
                            {
                                
                                $_SESSION['change-pwd'] = "<div class='success'>Password Changed Successfully. </div>";
                                
                                header('location:'.SITEURL.'admin/manage-admin.php');
                            }
                            else
                            {
                                
                                $_SESSION['change-pwd'] = "<div class='error'>Failed to Change Password. </div>";
                                
                                header('location:'.SITEURL.'admin/manage-admin.php');
                            }
                        }
                        else
                        {
                            
                            $_SESSION['pwd-not-match'] = "<div class='error'>Password Did not Patch. </div>";
                            
                            header('location:'.SITEURL.'admin/manage-admin.php');

                        }
                    }
                    else
                    {
                        
                        $_SESSION['user-not-found'] = "<div class='error'>User Not Found. </div>";
                        
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                }

                
            }

?>

</div>
</div>

<style>
    .dashboard-container {
        display: flex;
        background-color: #f4f7fa;
        min-height: 100vh;
    }

    .sidebar {
        width: 250px;
        background-color: #2c3e50;
        color: #ecf0f1;
        padding: 20px;
        display: flex;
        flex-direction: column;
    }

    .logo h1 {
        font-size: 2rem;
        margin-bottom: 30px;
    }

    .sidebar nav {
        flex-grow: 1;
    }

    .sidebar nav a {
        display: flex;
        align-items: center;
        padding: 10px;
        color: #ecf0f1;
        text-decoration: none;
        transition: background-color 0.3s;
    }

    .sidebar nav a:hover, .sidebar nav a.active {
        background-color: #34495e;
    }

    .sidebar nav a i {
        margin-right: 10px;
    }

    .sidebar-footer {
        margin-top: auto;
    }

    .user-profile {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }

    .user-profile i {
        margin-right: 10px;
    }

    .logout-btn {
        display: flex;
        align-items: center;
        color: #ecf0f1;
        text-decoration: none;
    }

    .logout-btn i {
        margin-right: 10px;
    }

    .main-content {
        flex: 1;
        padding: 2rem;
    }

    .dashboard-title {
        font-size: 2rem;
        color: #333;
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
    }

    .title-icon {
        margin-right: 1rem;
        color: #3498db;
    }

    .password-form-container {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 2rem;
        max-width: 500px;
        margin: 0 auto;
    }

    .password-form {
        display: flex;
        flex-direction: column;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        display: block;
        margin-bottom: 0.5rem;
        color: #555;
        font-weight: 600;
    }

    .password-input-group {
        position: relative;
    }

    .password-input-group input {
        width: 100%;
        padding: 0.75rem;
        padding-right: 35px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 1rem;
        transition: border-color 0.3s ease;
    }

    .password-input-group input:focus {
        border-color: #3498db;
        outline: none;
    }

    .toggle-password {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #777;
    }

    .password-strength-meter {
        height: 5px;
        background-color: #ddd;
        margin-top: 10px;
        border-radius: 2px;
        overflow: hidden;
    }

    .meter-bar {
        height: 100%;
        width: 0;
        transition: width 0.3s, background-color 0.3s;
    }

    .password-strength-text {
        font-size: 0.8rem;
        margin-top: 5px;
        color: #777;
    }

    .btn-change-password {
        background-color: #3498db;
        color: #fff;
        border: none;
        padding: 0.75rem 1.5rem;
        font-size: 1rem;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-change-password:hover {
        background-color: #2980b9;
    }

    .btn-change-password i {
        margin-right: 0.5rem;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .password-form-container {
        animation: fadeIn 0.5s ease-out;
    }

    .form-group input {
        transition: all 0.3s ease;
    }

    .form-group input:focus {
        transform: scale(1.02);
    }

    .btn-change-password {
        transition: all 0.3s ease;
    }

    .btn-change-password:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const togglePasswordButtons = document.querySelectorAll('.toggle-password');
    const newPasswordInput = document.getElementById('new_password');
    const confirmPasswordInput = document.getElementById('confirm_password');
    const passwordStrengthMeter = document.querySelector('.meter-bar');
    const passwordStrengthText = document.querySelector('.password-strength-text');
    const passwordForm = document.getElementById('passwordForm');

   
    togglePasswordButtons.forEach(button => {
        button.addEventListener('click', function() {
            const input = this.previousElementSibling;
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    });

    
    newPasswordInput.addEventListener('input', function() {
        const password = this.value;
        const strength = checkPasswordStrength(password);
        updatePasswordStrengthMeter(strength);
    });

    
    confirmPasswordInput.addEventListener('input', function() {
        if (this.value !== newPasswordInput.value) {
            this.setCustomValidity("Passwords don't match");
        } else {
            this.setCustomValidity('');
        }
    });

    
    passwordForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        console.log('Form submitted');
    });

    function checkPasswordStrength(password) {
        let strength = 0;
        if (password.length >= 8) strength++;
        if (password.match(/[a-z]+/)) strength++;
        if (password.match(/[A-Z]+/)) strength++;
        if (password.match(/[0-9]+/)) strength++;
        if (password.match(/[$@#&!]+/)) strength++;
        return strength;
    }

    function updatePasswordStrengthMeter(strength) {
        const width = (strength / 5) * 100;
        passwordStrengthMeter.style.width = `${width}%`;
        
        let color, text;
        switch(strength) {
            case 1:
                color = '#ff4d4d';
                text = 'Weak';
                break;
            case 2:
                color = '#ffa64d';
                text = 'Fair';
                break;
            case 3:
                color = '#ffff4d';
                text = 'Good';
                break;
            case 4:
                color = '#4dff4d';
                text = 'Strong';
                break;
            case 5:
                color = '#4dffff';
                text = 'Very Strong';
                break;
            default:
                color = '#ddd';  
                text = '';
        }
        
        passwordStrengthMeter.style.backgroundColor = color;
        passwordStrengthText.textContent = text;
    }
});
</script>

<?php include('partials/footer.php'); ?>