<?php
$id = $_GET["id"];
include 'connect.php';
$query = mysqli_query($conn, "DELETE FROM employees_list WHERE id = '$id'");
header('location:employees.php');
?>