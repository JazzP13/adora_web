<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adora Billing System</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- Google Fonts - Poppins -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="/assets/css/style.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .main-content {
            background: url('assets/img/adorahome.png') no-repeat center center/cover;
            height: 100vh;
            /* Full screen height */
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .content-box h1 {
            margin-bottom: 1.5rem;
            color: white;
            font-weight: bold;
        }

        .btn-custom {
            width: 300px;
            margin-top: 1rem;
        }
        footer{
            font-size: 9px;
            height: auto;
        }
    </style>
</head>

<body>
    <!-- Header Section -->
    <nav class="navbar navbar-dark bg-primary">
        <div class="container d-flex align-items-center w-100">
            <div class="mx-auto text-center flex-grow-1">
                <span class="navbar-text fs-4 fw-bold text-white">
                    Adora Beauty Lounge
                </span>
            </div>
        </div>
    </nav>

    <!-- Body Section with Background Image -->
    <div class="main-content">
        <div class="content-box">
            <h1>Welcome to Adora Beauty Lounge</h1>
            <div class="d-flex flex-column align-items-center gap-2">
                <a href="signin.php" class="btn btn-primary btn-custom">Sign In</a>
                <a href="signup.php" class="btn btn-primary btn-custom">Sign Up</a>
            </div>

        </div>
    </div>

    <!-- Footer Section -->
    <footer class="bg-dark text-white text-center py-3">
        © <?php echo date("Y"); ?> Jazze Pagtalunan. All Rights Reserved.
    </footer>
</body>

</html>