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
            <h1>Bite.</h1>
        </div>
        <nav>
            <a href="index.php"><i class="fas fa-home"></i> <span>Dashboard</span></a>
            <a href="manage-admin.php"><i class="fas fa-users-cog"></i> <span>Admin</span></a>
            <a href="manage-category.php" class="active"><i class="fas fa-list"></i> <span>Category</span></a>
            <a href="manage-flower.php"><i class="fas fa-utensils"></i> <span>flower</span></a>
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
            <span class="title-icon"><i class="fas fa-plus-circle"></i></span>
            Add Category
        </h1>

        <div class="category-form-container">
            <form action="" method="POST" enctype="multipart/form-data" class="category-form" id="categoryForm">
                <div class="form-group">
                    <label for="title">Title</label>
                    <div class="input-group">
                        <input type="text" id="title" name="title" placeholder="Category Title" required>
                        <i class="fas fa-tag"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label for="image">Select Image</label>
                    <div class="input-group file-input">
                        <input type="file" id="image" name="image" accept="image/*">
                        <label for="image"><i class="fas fa-upload"></i> Choose a file</label>
                    </div>
                </div>

                <div class="form-group">
                    <label>Featured</label>
                    <div class="radio-group">
                        <label><input type="radio" name="featured" value="Yes"> Yes</label>
                        <label><input type="radio" name="featured" value="No" checked> No</label>
                    </div>
                </div>

                <div class="form-group">
                    <label>Active</label>
                    <div class="radio-group">
                        <label><input type="radio" name="active" value="Yes"> Yes</label>
                        <label><input type="radio" name="active" value="No" checked> No</label>
                    </div>
                </div>

                <button type="submit" name="submit" class="btn-add-category">
                    <i class="fas fa-plus"></i> Add Category
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

    .category-form-container {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 2rem;
        max-width: 500px;
        margin: 0 auto;
    }

    .category-form {
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

    .input-group input[type="text"],
    .input-group input[type="file"] {
        width: 100%;
        padding: 0.75rem;
        padding-right: 35px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .input-group input[type="text"]:focus,
    .input-group input[type="file"]:focus {
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

    .file-input {
        position: relative;
        overflow: hidden;
    }

    .file-input input[type="file"] {
        position: absolute;
        left: 0;
        top: 0;
        opacity: 0;
        cursor: pointer;
        width: 100%;
        height: 100%;
    }

    .file-input label {
        display: inline-block;
        padding: 0.75rem 1.5rem;
        background-color: #3498db;
        color: #fff;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .file-input:hover label {
        background-color: #2980b9;
    }

    .radio-group {
        display: flex;
        gap: 1rem;
    }

    .radio-group label {
        display: flex;
        align-items: center;
        cursor: pointer;
    }

    .radio-group input[type="radio"] {
        margin-right: 0.5rem;
    }

    .btn-add-category {
        background-color: #2ecc71;
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

    .btn-add-category:hover {
        background-color: #27ae60;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .btn-add-category i {
        margin-right: 0.5rem;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .category-form-container {
        animation: fadeIn 0.5s ease-out;
    }

    .form-group {
        transition: all 0.3s ease;
    }

    .form-group:hover {
        transform: translateY(-2px);
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const categoryForm = document.getElementById('categoryForm');
    const inputs = categoryForm.querySelectorAll('input[type="text"], input[type="file"]');

    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('input-focus');
        });

        input.addEventListener('blur', function() {
            this.parentElement.classList.remove('input-focus');
        });
    });

    const fileInput = document.getElementById('image');
    const fileLabel = document.querySelector('.file-input label');
    fileInput.addEventListener('change', function() {
        if (this.files.length > 0) {
            fileLabel.textContent = this.files[0].name;
        } else {
            fileLabel.textContent = 'Choose a file';
        }
    });

    categoryForm.addEventListener('submit', function(e) {
       
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
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $featured = isset($_POST['featured']) ? $_POST['featured'] : 'No';
    $active = isset($_POST['active']) ? $_POST['active'] : 'No';

    if(isset($_FILES['image']['name']))
    {
        $image_name = $_FILES['image']['name'];
        if($image_name != "")
        {
            $ext = end(explode('.', $image_name));
            $image_name = "Flower_Category_".rand(000, 999).'.'.$ext;
            $source_path = $_FILES['image']['tmp_name'];
            $destination_path = "../images/category/".$image_name;
            $upload = move_uploaded_file($source_path, $destination_path);

            if($upload==false)
            {
                echo "<script>showMessage('Failed to Upload Image', 'error');</script>";
                die();
            }
        }
    }
    else
    {
        $image_name="";
    }

    $sql = "INSERT INTO tbl_category SET 
        title='$title',
        image_name='$image_name',
        featured='$featured',
        active='$active'  
    ";

    $res = mysqli_query($conn, $sql);

    if($res==true)
    {
        echo "<script>
                showMessage('Category Added Successfully');
                setTimeout(() => {
                    window.location.href = '".SITEURL."admin/manage-category.php';
                }, 3000);
              </script>";
    }
    else
    {
        echo "<script>showMessage('Failed to Add Category', 'error');</script>";
    }
}
?>  

<?php include('partials/footer.php'); ?>