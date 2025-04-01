<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Document</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: 'Poppins';
        }

        .container {
            padding: 40px;
            width: 50vw;
            text-align: center;
        }

        #button {
            border: none;
            height: 50px;
            width: 160px;
            text-align: center;
            border-radius: 10px;
        }

        img {
            width: 60px;
            height: 60px;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="content-container d-flex flex-column justify-content-center align-items-center">
            <div class="succes_text ">
                <div class="container-fluid d-flex justify-content-center align-items-center">
                    <img src="assets/img/Success.gif" alt="">
                </div>
                <h6>Congrats! account has been successfuly created🎉</h6>
            </div>
            <div class="button-container p-3">
                <form action="account_created.php" method="post">
                    <input type="submit" name="btn_OK" value="Login now" class="bg-primary text-white" id="button">
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<?php
if (isset($_POST['btn_OK'])) {
    header('Location:signin.php');
}
?>