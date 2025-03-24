<?php
$id = $_GET["id"];
include 'connect.php';
$query = mysqli_query($conn, "DELETE FROM customers_list WHERE id = '$id'");
header('location:customers.php');
?>