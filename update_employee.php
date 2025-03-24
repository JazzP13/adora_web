<?php
include 'connect.php';

if(isset($_POST['update_employee'])){
    $id = $_POST['id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $b_date = $_POST['b_date'];
    $address = $_POST['address'];
    $comm_percent = $_POST['commission_percent'];
    $contact_no = $_POST['contact_no'];
    $date_started = $_POST['date_started'];

    $query = mysqli_query($conn, "UPDATE employees_list SET date_started = '$date_started', firstname = '$firstname', lastname = '$$lastname', birth_date = '$b_date', address = '$address', contact_number = '$contact_no', comm_percentage = '$comm_percent' WHERE id = '$id'");

    if($query){
        header("location:employees.php");
    }
}
?>