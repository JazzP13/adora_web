<?php 
include 'connect.php'; 

// Check database connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Category</title>
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
            background-repeat: no-repeat;
            background-size: cover;
            background-color: rgba(0, 0, 0, 0.8);
        }

        .table-container {
            background: #fff;
            padding: 1rem;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
        a{
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="conten-area">
            <div class="d-flex flex-row align-items-center justify-content-center top-contenet">
                <div class="d-flex flex-row button-container" >
                    <a href="services.php" class="d-flex flex-row btn text-white gap-1"><i class="bi bi-arrow-left"></i>Back</a>
                </div>
                <h1 class="d-flex align-items-center justify-content-center p-2 text-lg-center text-white w-100 mb-4">Service Categories</h1>
            </div>
    

        <div class="d-flex align-items-center justify-content-center mt-5 vh-80">
            <div class="table-container">
                <div class="d-flex btn-container align-items-end justify-content-center mb-3">
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addCategoryModal">Add Category</button><!-- Ope the Add modal --->
                </div>

                <table class="table table-hover table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th hidden>id</th>
                            <th>Category Name</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = mysqli_query($conn, "SELECT * FROM service_category");
                        if (!$query) {
                            echo "<tr><td colspan='3' class='text-center text-danger'>Error fetching data: " . mysqli_error($conn) . "</td></tr>";
                        } else {
                            while ($row = mysqli_fetch_assoc($query)) {
                        ?>
                            <tr>
                                <td hidden><?php echo $row['id']; ?></td>
                                <td><?php echo $row['category_name']; ?></td>
                                <td>
                                    <div class="d-flex flex-row gap-1">
                                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editCategoryModal<?php echo $row['id']; ?>">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </button><!-- Open the edit modal -->

                                        <a href="delete_category.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm"><!-- redirect to delete_category.php -->
                                            <i class="bi bi-trash"></i> Delete
                                        </a>
                                    </div>
                                </td>
                            </tr>

                            <!-- Edit Category Modal -->
                            <div class="modal fade" id="editCategoryModal<?php echo $row['id']; ?>" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Category</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="edit_category.php" method="POST">
                                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                                <div class="mb-3">
                                                    <label class="form-label">Category Name</label>
                                                    <input type="text" name="category_name" class="form-control" value="<?php echo $row['category_name']; ?>">
                                                </div>
                                                <div class="text-end">
                                                    <button type="submit" name="edit_save" class="btn btn-primary">Save Changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Category Modal -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="add_category.php" method="POST">
                        <div class="mb-3">
                            <label class="form-label">Category Name</label>
                            <input type="text" name="category_name" class="form-control" required>
                        </div>
                        <div class="text-end">
                            <button type="submit" name="add_category" class="btn btn-success">Add Category</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
