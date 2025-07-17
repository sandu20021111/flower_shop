<?php
ob_start(); 
include('partials-front/menu.php');

// Check if flower_id is passed through GET method
if(isset($_GET['flower_id'])) {
    $flower_id = $_GET['flower_id'];
    $sql = "SELECT * FROM tbl_flower WHERE id=$flower_id";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);
    if($count==1) {
        $row = mysqli_fetch_assoc($res);
        $title = $row['title'];
        $price = $row['price'];
        $image_name = $row['image_name'];
    } else {
        header('location:'.SITEURL);
        exit();
    }
} else {
    header('location:'.SITEURL);
    exit();
}


if(isset($_POST['submit'])) {
    
    $flower = $_POST['flower'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];
    $total = $price * $qty;
    $order_date = date("Y-m-d h:i:sa");
    $status = "Ordered";
    $customer_name = $_POST['full-name'];
    $customer_contact = $_POST['contact'];
    $customer_email = $_POST['email'];
    $customer_address = $_POST['address'];

   
    $sql2 = "INSERT INTO tbl_order SET 
        flower = '$flower',
        price = $price,
        qty = $qty,
        total = $total,
        order_date = '$order_date',
        status = '$status',
        customer_name = '$customer_name',
        customer_contact = '$customer_contact',
        customer_email = '$customer_email',
        customer_address = '$customer_address'
    ";

    $res2 = mysqli_query($conn, $sql2);

    if($res2==true) {
        $_SESSION['order'] = "<div class='success text-center'>flower Ordered Successfully.</div>";
        header('location:'.SITEURL);
        exit();
    } else {
        $_SESSION['order'] = "<div class='error text-center'>Failed to Order flower.</div>";
        header('location:'.SITEURL);
        exit();
    }
}

if(isset($_POST['submit'])) {

    $res2 = mysqli_query($conn, $sql2);

    if($res2==true) {
        $_SESSION['order'] = "<div class='success text-center'>Food Ordered Successfully.</div>";
        echo "<script>var orderSuccess = true;</script>"; 
    } else {
        $_SESSION['order'] = "<div class='error text-center'>Failed to Order Food.</div>";
        echo "<script>var orderSuccess = false;</script>"; 
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order flower</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
</head>
<body>

<header class="main-header">
    <div class="container header-container">
        <div class="logo-container">
            <h1 class="logo">
                 <img src="images/home/logo1.png" alt="Flowerworld Logo" style="height: 50px; vertical-align: middle;"> Flowerworld
            </h1>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="categories.php">Occasions</a></li>
                <li><a href="flower.php">Bouquets</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="cart.php">🛒 (<?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>)</a></li>
            </ul>
        </nav>
    </div>
</header>

   <section class="order-section">
    <div class="container">
        <h2 class="section-title">Confirm Your Order</h2>
        <div class="order-container">
            <div class="flower-image" data-aos="fade-right">
                <?php 
                if($image_name == "") {
                    echo "<div class='error'>Image not Available.</div>";
                } else {
                    ?>
                    <img src="<?php echo SITEURL; ?>images/flower/<?php echo $image_name; ?>" alt="<?php echo $title; ?>">
                    <?php
                }
                ?>
            </div>
            <div class="order-details" data-aos="fade-left">
                <h3><?php echo $title; ?></h3>
                <p class="flower-price">Rs.<?php echo $price; ?></p>
                
                <form action="" method="POST" class="order-form">
                    <div class="form-group">
                        <label for="qty">Quantity</label>
                        <input type="number" id="qty" name="qty" value="1" min="1" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="full-name">Full Name</label>
                        <input type="text" id="full-name" name="full-name" placeholder="Enter your name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="contact">Phone Number</label>
                        <input type="tel" id="contact" name="contact" placeholder="Enter your phone number" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea id="address" name="address" rows="3" placeholder="Enter your address" required></textarea>
                    </div>
                    
                    <input type="hidden" name="flower" value="<?php echo $title; ?>">
                    <input type="hidden" name="price" value="<?php echo $price; ?>">
                    
                    <button type="submit" name="submit" class="btn btn-primary">Confirm Order</button>
                </form>
            </div>
        </div>
    </div>
</section>

    <?php include('partials-front/footer.php'); ?>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    
    
    <script>
        function showOrderConfirmation() {
    const popup = document.getElementById('orderConfirmationPopup');
    popup.classList.add('show');
}

function showOrderError() {
    const popup = document.getElementById('orderErrorPopup');
    popup.classList.add('show');
}

function closePopup() {
    const popups = document.querySelectorAll('.popup');
    popups.forEach(popup => {
        popup.classList.remove('show');
    });
}


window.onclick = function(event) {
    const popups = document.querySelectorAll('.popup');
    popups.forEach(popup => {
        if (event.target == popup) {
            popup.classList.remove('show');
        }
    });
}

    AOS.init({
        duration: 800,
        easing: 'ease-in-out',
        once: true,
        mirror: false
    });

    function showPopup(message) {
    document.getElementById('popupMessage').innerText = message;
    document.getElementById('orderPopup').style.display = 'block';
}

function closePopup() {
    document.getElementById('orderPopup').style.display = 'none';
}


document.addEventListener('DOMContentLoaded', function() {
    if (typeof orderSuccess !== 'undefined') {
        if (orderSuccess) {
            showPopup("The order has been successfully placed!");
        } else {
            showPopup("There was an error placing your order. Please try again.");
        }
    }
});


    </script>

<div id="orderPopup" class="popup">
    <div class="popup-content">
        <h3>Order Status</h3>
        <p id="popupMessage"></p>
        <button onclick="closePopup()">Close</button>
    </div>
</div>
</body>
</html>
<?php
ob_end_flush(); 
?>