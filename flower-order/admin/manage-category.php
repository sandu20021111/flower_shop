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
            <span class="title-icon"><i class="fas fa-list"></i></span>
            Manage Categories
        </h1>

        <?php 
            if(isset($_SESSION['add']))
            {
                echo '<div class="alert alert-success">' . $_SESSION['add'] . '</div>';
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['remove']))
            {
                echo '<div class="alert alert-danger">' . $_SESSION['remove'] . '</div>';
                unset($_SESSION['remove']);
            }

            if(isset($_SESSION['delete']))
            {
                echo '<div class="alert alert-danger">' . $_SESSION['delete'] . '</div>';
                unset($_SESSION['delete']);
            }

            if(isset($_SESSION['no-category-found']))
            {
                echo '<div class="alert alert-warning">' . $_SESSION['no-category-found'] . '</div>';
                unset($_SESSION['no-category-found']);
            }

            if(isset($_SESSION['update']))
            {
                echo '<div class="alert alert-info">' . $_SESSION['update'] . '</div>';
                unset($_SESSION['update']);
            }

            if(isset($_SESSION['upload']))
            {
                echo '<div class="alert alert-info">' . $_SESSION['upload'] . '</div>';
                unset($_SESSION['upload']);
            }

            if(isset($_SESSION['failed-remove']))
            {
                echo '<div class="alert alert-danger">' . $_SESSION['failed-remove'] . '</div>';
                unset($_SESSION['failed-remove']);
            }
        ?>

        <div class="admin-actions">
            <a href="add-category.php" class="btn-primary" id="addadmin-btn">
                <i class="fas fa-plus"></i> Add Category
            </a>
        </div>


        <div class="category-grid">
            <?php 
                $sql = "SELECT * FROM tbl_category";
                $res = mysqli_query($conn, $sql);

                if($res == TRUE)
                {
                    $count = mysqli_num_rows($res);

                    if($count > 0)
                    {
                        while($rows = mysqli_fetch_assoc($res))
                        {
                            $id = $rows['id'];
                            $title = $rows['title'];
                            $image_name = $rows['image_name'];
                            $featured = $rows['featured'];
                            $active = $rows['active'];
                            ?>
                            
                            <div class="category-card">
                                <div class="category-image">
                                    <?php 
                                        if($image_name!="")
                                        {
                                            ?>
                                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="<?php echo $title; ?>">
                                            <?php
                                        }
                                        else
                                        {
                                            echo "<div class='no-image'>No Image</div>";
                                        }
                                    ?>
                                </div>
                                <div class="category-info">
                                    <h3><?php echo $title; ?></h3>
                                    <p>

                                        <span class="badge <?php echo $featured == 'Yes' ? 'badge-featured' : ''; ?>">
                                            <?php echo $featured == 'Yes' ? 'Featured' : 'Not Featured'; ?>
                                        </span>
                                        <span class="badge <?php echo $active == 'Yes' ? 'badge-active' : ''; ?>">
                                            <?php echo $active == 'Yes' ? 'Active' : 'Inactive'; ?>
                                        </span>
                                    </p>
                                </div>
                                <div class="category-actions">
                                    <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-update"><i class="fas fa-edit"></i> Update</a>
                                    <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-delete"><i class="fas fa-trash-alt"></i> Delete</a>
                                </div>
                            </div>

                            <?php
                        }
                    }
                    else
                    {
                        echo "<p class='no-categories'>No categories found.</p>";
                    }
                }  
            ?>
        </div>
    </div>
</div>

<script src="js/admin.js"></script>

<?php include('partials/footer.php'); ?>