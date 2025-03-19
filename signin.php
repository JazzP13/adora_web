<?php include 'includes/header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - Adora Billing System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/style.css"> <!-- Custom CSS -->

    <style>
        .main-content {
            background: url('assets/img/adorahome.png') no-repeat center center/cover;
            height: 100vh; /* Full screen height */
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .signin-box {
            background-color: rgba(0, 0, 0, 0.7); /* Dark overlay for readability */
            color: #fff;
            border-radius: 15px;
            padding: 3rem;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
        }

        .form-control {
            background-color: transparent; 
            border: 1px solid #fff; 
            color: #fff;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .btn-primary {
            width: 100%;
            margin-top: 1rem;
        }

        a {
            color: #fff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
        footer{
            height: 5px
        }
    </style>
</head>
<body>
    <!-- Body Section with Background Image -->
    <div class="main-content">
        <div class="signin-box">
            <h2 class="text-center mb-4">Sign In</h2>
            <form action="process_signin.php" method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" id="username" name="username" class="form-control" placeholder="Enter your username" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
                </div>

                <button type="submit" name="submit" class="btn btn-primary">Sign In</button>
            </form>

            <div class="text-center mt-3">
                <a href="signup.php">Don't have an account? Sign Up</a>
            </div>
        </div>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
