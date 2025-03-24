<?php
include 'connect.php';

if (isset($_POST['save_employee'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $b_date = $_POST['b_date'];
    $address = $_POST['address'];
    $comm_percent = $_POST['commission_percent'];
    $contact_no = $_POST['contact_no'];
    $date_started = date('Y-m-d'); // Use proper date format for MySQL

    // Corrected SQL Query
    $query = mysqli_query($conn, "INSERT INTO employees_list (date_started, firstname, lastname, birth_date, address, contact_number, comm_percentage)  
        VALUES ('$date_started', '$firstname', '$lastname', '$b_date', '$address', '$contact_no', '$comm_percent')");

    if ($query) {
        header("location: employees.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
