<?php
    include'connect.php';
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    if(isset($_POST['submit'])){

        $query = mysqli_query($conn, "INSERT INTO staff_account (username, password) VALUES ('$username', '$password')");
        echo"<script>alert('Error: Succesfull!'); window.history.back();</script>";
        header('location:signin.php');
    }
?>