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
            <a href="index.php" class="active"><i class="fas fa-home"></i> <span>Dashboard</span></a>
            <a href="manage-admin.php"><i class="fas fa-users-cog"></i> <span>Admin</span></a>
            <a href="manage-category.php"><i class="fas fa-gift"></i> <span>Occasions</span></a>
            <a href="manage-flower.php"><i class="fas fa-spa"></i> <span>Flowers</span></a>
            <a href="manage-order.php"><i class="fas fa-shopping-cart"></i> <span>Order</span></a>
            <a href="manage-feedback.php"><i class="fas fa-comments"></i> <span>Feedback</span></a>
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
            <span class="title-icon"><i class="fas fa-users-cog"></i></span>
            Manage Admins
        </h1>

        <?php 
            if(isset($_SESSION['add']))
            {
                echo '<div class="alert alert-success">' . $_SESSION['add'] . '</div>';
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['delete']))
            {
                echo '<div class="alert alert-danger">' . $_SESSION['delete'] . '</div>';
                unset($_SESSION['delete']);
            }
            
            if(isset($_SESSION['update']))
            {
                echo '<div class="alert alert-info">' . $_SESSION['update'] . '</div>';
                unset($_SESSION['update']);
            }

            if(isset($_SESSION['user-not-found']))
            {
                echo '<div class="alert alert-warning">' . $_SESSION['user-not-found'] . '</div>';
                unset($_SESSION['user-not-found']);
            }

            if(isset($_SESSION['pwd-not-match']))
            {
                echo '<div class="alert alert-warning">' . $_SESSION['pwd-not-match'] . '</div>';
                unset($_SESSION['pwd-not-match']);
            }

            if(isset($_SESSION['change-pwd']))
            {
                echo '<div class="alert alert-success">' . $_SESSION['change-pwd'] . '</div>';
                unset($_SESSION['change-pwd']);
            }
        ?>

        <div class="admin-actions">
            <a href="add-admin.php" class="btn-primary" id="addadmin-btn">
                <i class="fas fa-plus"></i> Add Admin
            </a>
        </div>

        <div class="admin-grid">
            <?php 
                $sql = "SELECT * FROM tbl_admin";
                $res = mysqli_query($conn, $sql);

                if($res == TRUE)
                {
                    $count = mysqli_num_rows($res);

                    if($count > 0)
                    {
                        while($rows = mysqli_fetch_assoc($res))
                        {
                            $id = $rows['id'];
                            $full_name = $rows['full_name'];
                            $username = $rows['username'];
                            ?>
                            
                            <div class="admin-card">
    <div class="admin-info">
        <div class="admin-avatar">
            <i class="fas fa-user-circle"></i>
        </div>
        <h3><?php echo $full_name; ?></h3>
        <p>@<?php echo $username; ?></p>
    </div>
    <div class="admin-actions">
        <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-password">
            <i class="fas fa-key"></i> Change Password
        </a>
        <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-update">
            <i class="fas fa-edit"></i> Update Admin
        </a>
        <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-delete">
            <i class="fas fa-trash-alt"></i> Delete Admin
        </a>
    </div>
</div>
                            <?php
                        }
                    }               
                    else
                    {
                        echo "<p class='no-admins'>No admins found.</p>";
                    }
                }
            ?>  
        </div>
    </div>
</div>

<script src="js/admin.js"></script>

<?php include('partials/footer.php'); ?>