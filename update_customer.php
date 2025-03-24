<?php
include 'connect.php';

if(isset($_POST['update_customer'])){
    $id = $_POST['id'];
    $fullname = $_POST['fullname'];
    $date_visited = $_POST['date_visited'];

    $query = "UPDATE customers_list SET fullname = '$fullname', date_visited = '$date_visited' WHERE id = '$id'";

    if(mysqli_query($conn, $query)){
        header("location: customers.php");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>
