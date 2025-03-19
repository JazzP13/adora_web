<?php
include 'connect.php'; // Database connection

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    // Check if username exists
    $query = "SELECT * FROM staff_account WHERE username = '$username'";
    $res = mysqli_query($conn, $query);

    if ($res && mysqli_num_rows($res) > 0) {
        $user = mysqli_fetch_assoc($res);

        // Verify password (assuming password is hashed)
        if (password_verify($password, $user['password'])) {
            // Successful login
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $user['role']; // If there's a role column for user types
            echo "<script>alert('Login successful!'); window.location.href='staff.php';</script>";
        } else {
            echo "<script>alert('Invalid password. Please try again.'); window.location.href='signin.php';</script>";
        }
    } else {
        echo "<script>alert('Username not found. Please try again.'); window.location.href='signin.php';</script>";
    }
}
?>
