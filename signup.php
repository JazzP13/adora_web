<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Adora Billing System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/style.css"> <!-- Custom CSS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins';
        }

        .main-content {
            background-color: white;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .signup-box {
            background-color: rgb(255, 255, 255);
            padding-left: 2rem;
            padding-right: 2rem;
            border-radius: 10px;
            width: 60%;
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
        }

        .form-control {
            width: 300px;
            padding: 0.5rem;
            border-radius: 5px;
        }

        .form-label {
            color: red;
        }

        .btn-primary {
            width: 270px;
            margin-top: 1rem;
        }

        a {
            color: rgb(21, 18, 243);
            text-decoration: none;
            font-style: italic;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <!-- Body Section with Background Image -->
    <div class="main-content">
        <div class="signup-box">
            <h2 class="text-center mb-4 mt-5">Sign Up</h2>
            <form action="signup.php" method="POST">
                <div class="top-field mb-4 d-flex flex-row justify-content-center align-items-center">
                    <div class="me-2">
                        <label for="firstname" class="form-label">*</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Firstname" required>
                    </div>
                    <div class="ms-2">
                        <label for="lastname" class="form-label">*</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Lastname" required>
                    </div>
                </div>

                <div class="bottom-field mb-2 d-flex flex-row justify-content-center align-items-center">
                    <div class="me-2">
                        <label for="firstname" class="form-label">*</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                    </div>
                    <div class="ms-2">
                        <label for="lastname" class="form-label">*</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                    </div>
                </div>
                <div class="container-fluid d-flex justify-content-center">
                    <input type="submit" name="btn-signup" id="signup" class="btn btn-primary d-flex justify-content-center align-items-center" value="Sign Up">
                </div>

                <p class="text-center mt-3">Already have an account? <a href="signin.php">Login</a></p>
            </form>
        </div>

    </div>
    <?php include 'includes/footer.php'; ?>
</body>

</html>

<?php
include 'connect.php';

if (isset($_POST['btn-signup'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password = password_hash($password, PASSWORD_DEFAULT); // Hash the password

    $query = "INSERT INTO users (firstname, lastname, username, password) VALUES ('$firstname', '$lastname', '$username', '$password')";
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo"<script>window.location.href='account_created.php';</script>";
        exit();
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
    $conn->close();
}
?>