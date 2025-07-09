<?php 
    
    include('../config/constants.php');

    
    if(isset($_GET['id']) && isset($_GET['image_name'])) 
    {
        
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

    
        if($image_name != "")
        {
           
            $path = "../images/flower/".$image_name;

           
            $remove = unlink($path);

            
            if($remove==false)
            {
              
                $_SESSION['upload'] = "<div class='error'>Failed to Remove Image File.</div>";
               
                header('location:'.SITEURL.'admin/manage-flower.php');
                
                die();
            }

        }

        
        $sql = "DELETE FROM tbl_flower WHERE id=$id";
        
        $res = mysqli_query($conn, $sql);

        
        if($res==true)
        {
            
            $_SESSION['delete'] = "<div class='success'>flower Deleted Successfully.</div>";
            header('location:'.SITEURL.'admin/manage-flower.php');
        }
        else
        {
           
            $_SESSION['delete'] = "<div class='error'>Failed to Delete flower.</div>";
            header('location:'.SITEURL.'admin/manage-flower.php');
        }

        

    }
    else
    {
        
        $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access.</div>";
        header('location:'.SITEURL.'admin/manage-flower.php');
    }

?>