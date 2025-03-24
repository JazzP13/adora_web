<?php 
include 'connect.php';

// Form submission logic should be placed BEFORE the HTML form
if(isset($_POST['save'])){
    $service = isset($_POST['service_name']) ? $_POST['service_name'] : '';
    $price = isset($_POST['price']) ? $_POST['price'] : '';
    $category = isset($_POST['category']) ? $_POST['category'] : '';

    if (!is_numeric($price)) {
        echo "<span>Invalid price</span>";
    } else {
        $save = "INSERT INTO service_list (service_name, amount, category) VALUES('$service', '$price', '$category')";
        $execute = mysqli_query($conn, $save);

        if (!$execute) {
            die("Insert failed: " . mysqli_error($conn)); // Debugging insert issues
        } else {
            header("location:services.php");
            exit(); // Important to stop further code execution
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration - Adora Billing System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins';
            background-image: url(assets/img/adorahome.png);
            background-attachment: fixed;
            background-size: cover;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container d-flex align-items-center justify-content-center vh-100">
        <div class="card p-4 shadow-lg w-100" style="max-width: 400px;">
            <h3 class="text-center text-primary mb-4">Register</h3>

            <form action="add_service.php" method="POST">
                <div class="mb-3">
                    <label for="service_name" class="form-label">Service name</label>
                    <input type="text" id="service_name" name="service_name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" id="price" name="price" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <select name="category" class="form-control" required>
                        <option value="">Select Category</option>
                        <?php
                        $query = "SELECT * FROM service_category";
                        $result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_array($result)) {
                            echo "<option value='" . $row['category_name'] . "'>" . $row['category_name'] . "</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="d-grid">
                    <input type="submit" value="Save" name="save" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
