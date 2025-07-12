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
        <h1 class="dashboard-title">
            <span class="title-icon"><i class="fas fa-user-edit"></i></span>
            Update Admin
        </h1>

        <div class="admin-form-container">
            <?php 
                if(isset($_GET['id']))
                {
                    $id = $_GET['id'];
                    $sql = "SELECT * FROM tbl_admin WHERE id=$id";
                    $res = mysqli_query($conn, $sql);

                    if($res == true)
                    {
                        $count = mysqli_num_rows($res);
                        if($count == 1)
                        {
                            $row = mysqli_fetch_assoc($res);
                            $full_name = $row['full_name'];
                            $username = $row['username'];
                        }
                        else
                        {
                            $_SESSION['admin-not-found'] = "<div class='error'>Admin not found.</div>";
                            header('location:'.SITEURL.'admin/manage-admin.php');
                            exit();
                        }
                    }
                }
                else
                {
                    header('location:'.SITEURL.'admin/manage-admin.php');
                    exit();
                }
            ?>

            <form action="" method="POST" class="admin-form" id="adminForm">
                <div class="form-group">
                    <label for="full_name">Full Name</label>
                    <div class="input-group">
                        <input type="text" id="full_name" name="full_name" value="<?php echo $full_name; ?>" required>
                        <i class="fas fa-user"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label for="username">Username</label>
                    <div class="input-group">
                        <input type="text" id="username" name="username" value="<?php echo $username; ?>" required>
                        <i class="fas fa-at"></i>
                    </div>
                </div>

                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <button type="submit" name="submit" class="btn-update-admin">
                    <i class="fas fa-sync-alt"></i> Update Admin
                </button>
            </form>
        </div>

        <?php 
            if(isset($_POST['submit']))
            {
                $id = mysqli_real_escape_string($conn, $_POST['id']);
                $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
                $username = mysqli_real_escape_string($conn, $_POST['username']);

                $sql = "UPDATE tbl_admin SET
                full_name = '$full_name',
                username = '$username' 
                WHERE id='$id'
                ";

                $res = mysqli_query($conn, $sql);

                if($res == true)
                {
                    $_SESSION['update'] = "<div class='success'>Admin Updated Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-admin.php');
                    exit();
                }
                else
                {
                    $_SESSION['update'] = "<div class='error'>Failed to Update Admin. " . mysqli_error($conn) . "</div>";
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

    .admin-form-container {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 2rem;
        max-width: 500px;
        margin: 0 auto;
    }

    .admin-form {
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
        transition: border-color 0.3s ease;
    }

    .input-group input:focus {
        border-color: #3498db;
        outline: none;
    }

    .input-group i {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        color: #777;
    }

    .btn-update-admin {
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

    .btn-update-admin:hover {
        background-color: #2980b9;
    }

    .btn-update-admin i {
        margin-right: 0.5rem;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .admin-form-container {
        animation: fadeIn 0.5s ease-out;
    }

    .form-group input {
        transition: all 0.3s ease;
    }

    .form-group input:focus {
        transform: scale(1.02);
    }

    .btn-update-admin {
        transition: all 0.3s ease;
    }

    .btn-update-admin:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
</style>


<script>
document.addEventListener('DOMContentLoaded', function() {
    const adminForm = document.getElementById('adminForm');
    const inputs = adminForm.querySelectorAll('input[type="text"]');

    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('input-focus');
        });

        input.addEventListener('blur', function() {
            this.parentElement.classList.remove('input-focus');
        });
    });

   
    adminForm.addEventListener('submit', function(e) {
       
        console.log('Form submitted');
    });
});           
</script>

<?php include('partials/footer.php'); ?>