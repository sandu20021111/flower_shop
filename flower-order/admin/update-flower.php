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
            <a href="manage-category.php"><i class="fas fa-list"></i> <span>Occasions</span></a>
            <a href="manage-flower.php" class="active"><i class="fas fa-spa"></i> <span>Flowers</span></a>
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
            <span class="title-icon"><i class="fas fa-edit"></i></span>
            Update flower
        </h1>

        <div id="messagePopup" class="message-popup"></div>

        <div class="flower-form-container">
            <?php 
                if(isset($_GET['id']))
                {
                    $id = $_GET['id'];
                    $sql2 = "SELECT * FROM tbl_flower WHERE id=$id";
                    $res2 = mysqli_query($conn, $sql2);
                    $row2 = mysqli_fetch_assoc($res2);

                    $title = $row2['title'];
                    $description = $row2['description'];
                    $price = $row2['price'];
                    $current_image = $row2['image_name'];
                    $current_category = $row2['category_id'];
                    $featured = $row2['featured'];
                    $active = $row2['active'];
                }
                else
                {
                    header('location:'.SITEURL.'admin/manage-flower.php');
                }
            ?>

            <form action="" method="POST" enctype="multipart/form-data" class="flower-form" id="flowerForm">
                <div class="form-group">
                    <label for="title">Title</label>
                    <div class="input-group">
                        <input type="text" id="title" name="title" value="<?php echo $title; ?>" required>
                        <i class="fas fa-utensils"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" cols="30" rows="5" required><?php echo $description; ?></textarea>
                </div>

                <div class="form-group">
                    <label for="price">Price</label>
                    <div class="input-group">
                        <input type="number" id="price" name="price" value="<?php echo $price; ?>" required>
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label>Current Image</label>
                    <div class="current-image">
                        <?php 
                            if($current_image == "")
                            {
                                echo "<div class='error'>Image not Available.</div>";
                            }
                            else
                            {
                                ?>
                                <img src="<?php echo SITEURL; ?>images/flower/<?php echo $current_image; ?>" width="150px">
                                <?php
                            }
                        ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="image">Select New Image</label>
                    <div class="input-group file-input">
                        <input type="file" id="image" name="image" accept="image/*">
                        <label for="image"><i class="fas fa-upload"></i> Choose a file</label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="category">Category</label>
                    <select name="category" id="category">
                        <?php 
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                            $res = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($res);

                            if($count>0)
                            {
                                while($row=mysqli_fetch_assoc($res))
                                {
                                    $category_title = $row['title'];
                                    $category_id = $row['id'];
                                    
                                    echo "<option ".($current_category==$category_id ? "selected" : "")." value='$category_id'>$category_title</option>";
                                }
                            }
                            else
                            {
                                echo "<option value='0'>Category Not Available.</option>";
                            }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Featured</label>
                    <div class="radio-group">
                        <label><input type="radio" name="featured" value="Yes" <?php if($featured=="Yes"){echo "checked";} ?>> Yes</label>
                        <label><input type="radio" name="featured" value="No" <?php if($featured=="No"){echo "checked";} ?>> No</label>
                    </div>
                </div>

                <div class="form-group">
                    <label>Active</label>
                    <div class="radio-group">
                        <label><input type="radio" name="active" value="Yes" <?php if($active=="Yes"){echo "checked";} ?>> Yes</label>
                        <label><input type="radio" name="active" value="No" <?php if($active=="No"){echo "checked";} ?>> No</label>
                    </div>
                </div>

                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                <button type="submit" name="submit" class="btn-update-flower">
                    <i class="fas fa-sync-alt"></i> Update flower
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

    .input-group input[type="text"] {
        width: 100%;
        padding: 0.75rem;
        padding-right: 35px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 1rem;
        transition: border-color 0.3s ease;
    }

    .input-group input[type="text"]:focus {
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
        transition: background-color 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-add-category:hover {
        background-color: #27ae60;
    }

    .btn-add-category i {
        margin-right: 0.5rem;
    }

    .message {
        padding: 10px;
        margin-bottom: 1rem;
        border-radius: 4px;
        font-weight: bold;
    }

    .success {
        background-color: #d4edda;
        color: #155724;
    }

    .error {
        background-color: #f8d7da;
        color: #721c24;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .category-form-container {
        animation: fadeIn 0.5s ease-out;
    }

    .form-group input, .form-group select {
        transition: all 0.3s ease;
    }

    .form-group input:focus, .form-group select:focus {
        transform: scale(1.02);
    }

    .btn-add-category {
        transition: all 0.3s ease;
    }

    .btn-add-category:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .current-image {
        margin-top: 10px;
    }

    .current-image img {
        max-width: 150px;
        border-radius: 4px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    .btn-update-category {
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

    .btn-update-category:hover {
        background-color: #2980b9;
    }

    .btn-update-category i {
        margin-right: 0.5rem;
    }

    .flower-form-container {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 2rem;
        max-width: 600px;
        margin: 0 auto;
    }

    .flower-form textarea {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 1rem;
        transition: border-color 0.3s ease;
        resize: vertical;
    }

    .flower-form textarea:focus {
        border-color: #3498db;
        outline: none;
    }

    .btn-update-flower {
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

    .btn-update-flower:hover {
        background-color: #2980b9;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .btn-update-flower i {
        margin-right: 0.5rem;
    }

  
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const flowerForm = document.getElementById('flowerForm');
    const inputs = flowerForm.querySelectorAll('input[type="text"], input[type="number"], input[type="file"], textarea, select');

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

    foodForm.addEventListener('submit', function(e) {
        
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
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $price = $_POST['price'];
    $current_image = $_POST['current_image'];
    $category = $_POST['category'];
    $featured = $_POST['featured'];
    $active = $_POST['active'];

    if(isset($_FILES['image']['name']))
    {
        $image_name = $_FILES['image']['name'];
        if($image_name != "")
        {
            $ext = end(explode('.', $image_name));
            $image_name = "Flower-Name-".rand(0000,9999).".".$ext;
            $src_path = $_FILES['image']['tmp_name'];
            $dest_path = "../images/flower/".$image_name;
            $upload = move_uploaded_file($src_path, $dest_path);

            if($upload==false)
            {
                echo "<script>showMessage('Failed to Upload new Image.', 'error');</script>";
                die();
            }

            if($current_image!="")
            {
                $remove_path = "../images/flower/".$current_image;
                $remove = unlink($remove_path);
                if($remove==false)
                {
                    echo "<script>showMessage('Failed to remove current image.', 'error');</script>";
                }
            }
        }
        else
        {
            $image_name = $current_image;
        }
    }
    else
    {
        $image_name = $current_image;
    }

    $sql3 = "UPDATE tbl_flower SET 
        title = '$title',
        description = '$description',
        price = $price,
        image_name = '$image_name',
        category_id = '$category',
        featured = '$featured',
        active = '$active'
        WHERE id=$id
    ";

    $res3 = mysqli_query($conn, $sql3);

    if($res3==true)
    {
        echo "<script>
                showMessage('flower Updated Successfully');
                setTimeout(() => {
                    window.location.href = '".SITEURL."admin/manage-flower.php';
                }, 3000);
              </script>";
    }
    else  
    {
        echo "<script>showMessage('Failed to Update flower', 'error');</script>";
    }
}
?>

<?php include('partials/footer.php'); ?>