<?php
include 'connect.php';
$id = $_GET["id"];
$query = mysqli_query($conn, "DELETE FROM service_list WHERE id = '$id'");
$result = mysqli_query($conn, $query);
header('location:services.php');
?>