<?php
include'connect.php';
$category = $_POST['category_name'];
$query = mysqli_query($conn, "INSERT INTO service_category (category_name) VALUE ('$category')");
if ($query) {
    header("location:service_category.php");
}
?>