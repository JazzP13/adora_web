<?php include 'includes/header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Adora Billing System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/style.css"> <!-- Custom CSS -->

    <style>
        .main-content {
            background: url('assets/img/adorahome.png') no-repeat center center/cover;
            height: 100vh; 
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .signup-box {
            background-color: rgba(0, 0, 0, 0.7); 
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
    </style>
</head>
<body>
    <!-- Body Section with Background Image -->
    <div class="main-content">
        <div class="signup-box">
            <h2 class="text-center mb-4">Sign Up</h2>
            <form action="process_signup.php" method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" id="username" name="username" class="form-control" placeholder="Enter your username" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
                </div>

                <button type="submit" name="submit" class="btn btn-primary">Sign Up</button>
            </form>

            <div class="text-center mt-3">
                <a href="signin.php">Already have an account? Sign In</a>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
