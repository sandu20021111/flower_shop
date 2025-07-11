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
            <h1>Flowerworld.</h1>
        </div>
        <nav>
            <a href="index.php"><i class="fas fa-home"></i> <span>Dashboard</span></a>
            <a href="manage-admin.php" class="active"><i class="fas fa-users-cog"></i> <span>Admin</span></a>
            <a href="manage-category.php"><i class="fas fa-list"></i> <span>Occasions</span></a>
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
        <div id="messagePopup" class="message-popup"></div>
        <h1 class="dashboard-title">
            <span class="title-icon"><i class="fas fa-user-plus"></i></span>
            Add Admin
        </h1>

        <div class="admin-form-container">
            <form action="" method="POST" class="admin-form" id="addAdminForm">
                <div class="form-group">
                    <label for="full_name">Full Name</label>
                    <div class="input-group">
                        <input type="text" id="full_name" name="full_name" placeholder="Enter full name" required>
                        <i class="fas fa-user"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label for="username">Username</label>
                    <div class="input-group">
                        <input type="text" id="username" name="username" placeholder="Enter username" required>
                        <i class="fas fa-user-tag"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-group">
                        <input type="password" id="password" name="password" placeholder="Enter password" required>
                        <i class="fas fa-eye toggle-password"></i>
                    </div>
                    <div class="password-strength-meter">
                        <div class="meter-bar"></div>
                    </div>
                    <p class="password-strength-text"></p>
                </div>

                <button type="submit" name="submit" class="btn-add-admin">
                    <i class="fas fa-user-plus"></i> Add Admin
                </button>
            </form>
        </div>
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

    .message-popup {
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 15px 20px;
        background-color: #2ecc71;
        color: white;
        border-radius: 5px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        transform: translateY(-100px);
        opacity: 0;
        transition: all 0.3s ease;
        z-index: 1000;
    }

    .message-popup.show {
        transform: translateY(0);
        opacity: 1;
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

    .admin-form-container {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 2rem;
        max-width: 500px;
        margin: 0 auto;
        animation: fadeIn 0.5s ease-out;
    }

    .admin-form {
        display: flex;
        flex-direction: column;
    }

    .form-group {
        margin-bottom: 1.5rem;
        transition: all 0.3s ease;
    }

    .form-group:hover {
        transform: translateY(-2px);
    }

    .form-group label {
        display: block;
        margin-bottom: 0.5rem;
        color: #555;
        font-weight: 600;
    }

    .input-group {
        position: relative;
    }

    .input-group input {
        width: 100%;
        padding: 0.75rem;
        padding-right: 35px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .input-group input:focus {
        border-color: #3498db;
        outline: none;
        box-shadow: 0 0 0 2px rgba(52, 152, 219, 0.2);
    }

    .input-group i {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        color: #777;
    }

    .toggle-password {
        cursor: pointer;
    }

    .password-strength-meter {
        height: 4px;
        background-color: #ddd;
        margin-top: 0.5rem;
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
        margin-top: 0.25rem;
        color: #777;
    }

    .btn-add-admin {
        background-color: #3498db;
        color: #fff;
        border: none;
        padding: 0.75rem 1.5rem;
        font-size: 1rem;
        border-radius: 4px;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-add-admin:hover {
        background-color: #2980b9;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .btn-add-admin i {
        margin-right: 0.5rem;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const addAdminForm = document.getElementById('addAdminForm');
    const inputs = addAdminForm.querySelectorAll('input');
    const togglePasswordButton = document.querySelector('.toggle-password');
    const passwordInput = document.getElementById('password');
    const passwordStrengthMeter = document.querySelector('.meter-bar');
    const passwordStrengthText = document.querySelector('.password-strength-text');

    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('input-focus');
        });

        input.addEventListener('blur', function() {
            this.parentElement.classList.remove('input-focus');
        });
    });

    togglePasswordButton.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });

    passwordInput.addEventListener('input', function() {
        const password = this.value;
        const strength = checkPasswordStrength(password);
        updatePasswordStrengthMeter(strength);
    });

    addAdminForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);

        fetch('add-admin-process.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showMessage('Admin added successfully!', 'success');
                addAdminForm.reset();
            } else {
                showMessage(data.message || 'Failed to add admin.', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showMessage('An error occurred. Please try again.', 'error');
        });
    });
});

function checkPasswordStrength(password) {
    let strength = 0;
    if (!password) return 0;
    if (password.length >= 8) strength += 30;
    if (/[A-Z]/.test(password)) strength += 20;
    if (/[a-z]/.test(password)) strength += 20;
    if (/[0-9]/.test(password)) strength += 15;
    if (/[^A-Za-z0-9]/.test(password)) strength += 15;
    if (strength > 100) strength = 100;
    return strength;
}

function updatePasswordStrengthMeter(strength) {
    const meterBar = document.querySelector('.meter-bar');
    const strengthText = document.querySelector('.password-strength-text');

    meterBar.style.width = strength + '%';

    if (strength < 30) {
        meterBar.style.backgroundColor = '#ff4757';
        strengthText.textContent = 'Weak';
    } else if (strength < 60) {
        meterBar.style.backgroundColor = '#ffa502';
        strengthText.textContent = 'Moderate';
    } else {
        meterBar.style.backgroundColor = '#2ed573';
        strengthText.textContent = 'Strong';
    }
} 

function showMessage(message, type = 'success') {
    const popup = document.getElementById('messagePopup');
    popup.textContent = message;
    popup.style.backgroundColor = type === 'success' ? '#2ecc71' : '#e74c3c';
    popup.classList.add('show');

    setTimeout(() => {
        popup.classList.remove('show');
    }, 3000);
}
</script>

<?php include('partials/footer.php'); ?>