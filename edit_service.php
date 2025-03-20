<?php
$id = $_GET["id"];
include'connect.php';
$query = mysqli_query($conn, "SELECT * FROM service_list WHERE id = '$id'");
$row = mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration - Adora Billing System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container d-flex align-items-center justify-content-center vh-100">
        <div class="card p-4 shadow-lg w-100" style="max-width: 400px;">
            <h3 class="text-center text-primary mb-4">Register</h3>

            <form action="edit_service.php?id=<?php echo $row['id'];?>" method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label">Service name</label>
                    <input type="text" id="service_name" name="id" value="<?php echo $row['id'];?>" hidden>
                    <input type="text" id="service_name" name="service_name" value="<?php echo $row['service_name'];?>" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Price</label>
                    <input type="number" id="price" name="price" class="form-control" value="<?php echo $row['amount'];?>" required>
                </div>

                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Category</label>
                    <select name="category" class="form-control" required>
                        <option>Select Categty</option>
                        <?php
                        $query = "SELECT * FROM service_category";
                        $result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_array($result)) {
                            $category = $row["category_name"];
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

<!-- Saving Data -->
<?php
$id = $_POST['id'];
$service = $_POST['service_name'];
$price = $_POST['price'];
$category = $_POST['category'];

if(isset($_POST['save'])){
    if(!is_numeric($price)){
        echo"<span>Invalid price</span>";
    }
    $save = "UPDATE service_list SET service_name = '$service', amount = '$price', category = '$category' WHERE id = '$id'";
    $execute = mysqli_query($conn, $save);

    if (!$execute) {
        die("Insert failed: " . mysqli_error($conn)); // Debugging insert issues
    }else{
        header("location:services.php");
    }
}
?>