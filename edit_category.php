<?php
include'connect.php';
$id = $_POST['id'];
$category = $_POST['category_name'];
if (isset($_POST['edit_save'])) {
    $query = mysqli_query($conn, "UPDATE service_category SET category_name = '$category' WHERE id = '$id'");
    if($query){
        header('location:service_category.php');
    }else{
        echo "Failed to update data";
    }
}
?>