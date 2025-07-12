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
            <a href="manage-category.php"><i class="fas fa-list"></i> <span>Occasions</span></a>
            <a href="manage-flower.php"><i class="fas fa-spa"></i> <span>Flowers</span></a>
            <a href="manage-order.php" class="active"><i class="fas fa-shopping-cart"></i> <span>Order</span></a>
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
            <span class="title-icon"><i class="fas fa-shopping-cart"></i></span>
            Manage Orders
        </h1>

        <?php 
            if(isset($_SESSION['update']))
            {
                echo '<div class="alert alert-info">' . $_SESSION['update'] . '</div>';
                unset($_SESSION['update']);
            }
        ?>

        <div class="admin-actions">
            
        </div>

        <div class="order-grid">
            <?php 
                $sql = "SELECT * FROM tbl_order ORDER BY id DESC";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);

                if($count > 0)
                {
                    while($row = mysqli_fetch_assoc($res))
                    {
                        $id = $row['id'];
                        $flower = $row['flower'];
                        $price = $row['price'];
                        $qty = $row['qty'];
                        $total = $row['total'];
                        $order_date = $row['order_date'];
                        $status = $row['status'];
                        $customer_name = $row['customer_name'];
                        $customer_contact = $row['customer_contact'];
                        $customer_email = $row['customer_email'];
                        $customer_address = $row['customer_address'];
                        ?>
                        
                        <div class="order-card">
                            <div class="order-info">
                                <h3><?php echo $flower; ?></h3>
                                <p>Price: Rs.<?php echo $price; ?></p>
                                <p>Quantity: <?php echo $qty; ?></p>
                                <p>Total: Rs.<?php echo $total; ?></p>
                                <p>Order Date: <?php echo $order_date; ?></p>
                                <p>
    <span class="badge badge-<?php echo strtolower(str_replace(' ', '-', $status)); ?>">
        <?php echo $status; ?>
    </span>
</p>
                            </div>
                            <div class="customer-info">
                                <h4>Customer Details</h4>
                                <p>Name: <?php echo $customer_name; ?></p>
                                <p>Contact: <?php echo $customer_contact; ?></p>
                                <p>Email: <?php echo $customer_email; ?></p>
                                <p>Address: <?php echo $customer_address; ?></p>
                            </div>
                            <div class="order-actions">
                                <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-update"><i class="fas fa-edit"></i> Update</a>
                            </div>
                        </div>

                        <?php
                    }
                }
                else
                {
                    echo "<p class='no-orders'>No orders found.</p>";
                }
            ?>
        </div>
    </div>  
</div>

<script src="js/admin.js"></script>

<?php include('partials/footer.php'); ?>  