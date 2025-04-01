<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in - Adora Billing System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/style.css"> <!-- Custom CSS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Poppins';
            height: 100vh;
        }

        .main-content {
            background-color: white;
            height: 60%;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            width: 40%;
            box-shadow: rgba(0, 0, 0, 0.35) 0px 0px 10px;
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
            font-style: italic;
        }

        a:hover {
            text-decoration: underline;
        }

        h1 {
            font-family: 'Montserrat';
            font-weight: 700;
        }
        .left-container{
            width: 35%;
        }
    </style>
</head>

<body>
    <!-- Body Section with Background Image -->
    <div class="container main-content">



        <!-- right side -->
        <div class="right">
            <div class="signup-box">
                <h1 class="text-center mb-4 mt-5 text-primary">Login</h1>
                <form action="process_signin.php" method="POST">
                    <div class="bottom-field mb-2 d-flex flex-column justify-content-center align-items-center">
                        <div class="ms-2">
                            <label for="firstname" class="form-label">*</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                        </div>
                        <div class="ms-2">
                            <label for="lastname" class="form-label">*</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="container-fluid d-flex justify-content-center">
                        <input type="submit" name="btn-signin" id="signin" class="btn btn-primary d-flex justify-content-center align-items-center" value="Login">
                    </div>

                    <p class="text-center mt-3"><a href="signup.php">Create account</a></p>
                </form>
            </div>
        </div>
</body>

</html>