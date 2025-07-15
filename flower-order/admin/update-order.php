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
            <span class="title-icon"><i class="fas fa-edit"></i></span>
            Update Order
        </h1>

        <div id="messagePopup" class="message-popup"></div>

        <div class="order-form-container">
            <?php 
            if(isset($_GET['id']))
            {
                $id = $_GET['id'];
                $sql = "SELECT * FROM tbl_order WHERE id=$id";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);

                if($count == 1)
                {
                    $row = mysqli_fetch_assoc($res);
                    $flower = $row['flower'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_email = $row['customer_email'];
                    $customer_address = $row['customer_address'];
                }
                else
                {
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
            }
            else
            {
                header('location:'.SITEURL.'admin/manage-order.php');
            }
            ?>

            <form action="" method="POST" class="order-form" id="orderForm">
                <div class="form-group">
                    <label for="flower">flower Name</label>
                    <div class="input-group">
                        <input type="text" id="flower" name="flower" value="<?php echo $flower; ?>" readonly>
                        <i class="fas fa-spa"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label for="price">Price</label>
                    <div class="input-group">
                        <input type="text" id="price" name="price" value="Rs.<?php echo $price; ?>" readonly>
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label for="qty">Quantity</label>
                    <div class="input-group">
                        <input type="number" id="qty" name="qty" value="<?php echo $qty; ?>" required>
                        <i class="fas fa-sort-numeric-up"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <div class="input-group">
                        <select name="status" id="status">
                            <option <?php if($status=="Ordered"){echo "selected";} ?> value="Ordered">Ordered</option>
                            <option <?php if($status=="On Delivery"){echo "selected";} ?> value="On Delivery">On Delivery</option>
                            <option <?php if($status=="Delivered"){echo "selected";} ?> value="Delivered">Delivered</option>
                            <option <?php if($status=="Cancelled"){echo "selected";} ?> value="Cancelled">Cancelled</option>
                        </select>
                        <i class="fas fa-tasks"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label for="customer_name">Customer Name</label>
                    <div class="input-group">
                        <input type="text" id="customer_name" name="customer_name" value="<?php echo $customer_name; ?>" required>
                        <i class="fas fa-user"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label for="customer_contact">Customer Contact</label>
                    <div class="input-group">
                        <input type="text" id="customer_contact" name="customer_contact" value="<?php echo $customer_contact; ?>" required>
                        <i class="fas fa-phone"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label for="customer_email">Customer Email</label>
                    <div class="input-group">
                        <input type="email" id="customer_email" name="customer_email" value="<?php echo $customer_email; ?>" required>
                        <i class="fas fa-envelope"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label for="customer_address">Customer Address</label>
                    <div class="input-group">
                        <textarea id="customer_address" name="customer_address" rows="5" required><?php echo $customer_address; ?></textarea>
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                </div>

                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="hidden" name="price" value="<?php echo $price; ?>">

                <button type="submit" name="submit" class="btn-update-order">
                    <i class="fas fa-sync-alt"></i> Update Order
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

    .order-form-container {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 2rem;
        max-width: 600px;
        margin: 0 auto;
    }

    .order-form {
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

    .input-group input,
    .input-group select,
    .input-group textarea {
        width: 100%;
        padding: 0.75rem;
        padding-right: 35px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 1rem;
        transition: border-color 0.3s ease;
    }

    .input-group input:focus,
    .input-group select:focus,
    .input-group textarea:focus {
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

    .btn-update-order {
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

    .btn-update-order:hover {
        background-color: #2980b9;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .btn-update-order i {
        margin-right: 0.5rem;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .order-form-container {
        animation: fadeIn 0.5s ease-out;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const orderForm = document.getElementById('orderForm');
    const inputs = orderForm.querySelectorAll('input, select, textarea');

    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('input-focus');
        });

        input.addEventListener('blur', function() {
            this.parentElement.classList.remove('input-focus');
        });
    });

    orderForm.addEventListener('submit', function(e) {
        // Form validation can be added here if needed
        console.log('Form submitted');
    });
});

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

<?php
if(isset($_POST['submit']))
{
    $id = $_POST['id'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];
    $total = $price * $qty;
    $status = $_POST['status'];
    $customer_name = mysqli_real_escape_string($conn, $_POST['customer_name']);
    $customer_contact = mysqli_real_escape_string($conn, $_POST['customer_contact']);
    $customer_email = mysqli_real_escape_string($conn, $_POST['customer_email']);
    $customer_address = mysqli_real_escape_string($conn, $_POST['customer_address']);

    $sql2 = "UPDATE tbl_order SET 
        qty = $qty,
        total = $total,
        status = '$status',
        customer_name = '$customer_name',
        customer_contact = '$customer_contact',
        customer_email = '$customer_email',
        customer_address = '$customer_address'
        WHERE id=$id
    ";

    $res2 = mysqli_query($conn, $sql2);

    if($res2==true)
    {
        echo "<script>
                showMessage('Order Updated Successfully');
                setTimeout(() => {
                    window.location.href = '".SITEURL."admin/manage-order.php';
                }, 3000);
              </script>";
    }
    else
    {
        echo "<script>showMessage('Failed to Update Order', 'error');</script>";
    }
}
?>

<?php include('partials/footer.php'); ?>