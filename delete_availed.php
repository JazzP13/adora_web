<?php
include 'connect.php';
$id = $_GET["id"];
$query = mysqli_query($conn, "DELETE FROM availed_service WHERE id = '$id'");
$result = mysqli_query($conn, $query);
header('location:billing.php');
?>