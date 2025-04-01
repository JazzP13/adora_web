<?php
session_start();
include 'connect.php'; // Database connection

$username = $_POST['username'];
$password = $_POST['password']; // Entered password

// Debug: Print entered password
echo "Entered Password: " . htmlspecialchars($password) . "<br>";

// Prepare and execute query
$query = "SELECT * FROM users WHERE username = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
    $hashed_password = $user['password']; // Get stored hashed password

    // Debug: Print hashed password from DB
    echo "Hashed Password from DB: " . $hashed_password . "<br>";

    // Verify password
    if (password_verify($password, $hashed_password)) {
        echo "✅ Password Match! Redirecting...";
        $_SESSION['username'] = $username;
        header("Location: admin.php");
        exit();
    } else {
        echo "❌ Invalid password!";
    }
} else {
    echo "❌ Username not found!";
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
