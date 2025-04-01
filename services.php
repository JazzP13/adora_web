<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Services - Adora Billing System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/style.css"> <!-- Custom CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&display=swap" rel="stylesheet">

    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
            font-family: 'Poppins';
        }

        .main-content {
            display: flex;
            flex: 1;
        }

        /* Sidebar Styling */
        .sidebar {
            width: 250px;
            background-color: #343a40;
            color: #fff;
            padding: 1rem;
            box-shadow: 4px 0 10px rgba(0, 0, 0, 0.3);
        }

        .sidebar a {
            color: #fff;
            text-decoration: none;
            display: block;
            padding: 0.75rem 1rem;
            border-radius: 5px;
            transition: background 0.3s ease-in-out;
        }

        .sidebar a:hover {
            background-color: #495057;
        }

        .active {
            background-color: #007bff;
        }

        /* Content Area */
        .content-area {
            flex: 1;
            padding: 2rem;
            background-color: #f8f9fa;
        }
        /* Search Bar & Buttons */
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .search-bar {
            display: flex;
            gap: 0.5rem;
        }

        .btn-actions {
            display: flex;
            gap: 0.5rem;
        }

        /* Table Styling */
        .table-container {
            background: #fff;
            padding: 1rem;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Footer Styling */
        footer {
            background-color: #343a40;
            color: #fff;
            text-align: center;
            padding: 0.75rem;
            margin-top: auto;
            /* Ensures it sticks to the bottom */
            font-size: 12px;
            width: 100%;
            box-shadow: 0px -4px 10px rgba(0, 0, 0, 0.3);
        }
        .logo {
            height: 120px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-self: center;
        }
        #salon-name{
            font-family: 'Dancing Script';
        }
    </style>
</head>

<body>
    <div class="main-content">
        <!-- Sidebar Navigation -->
        <div class="sidebar">
            <div class="logo-container d-flex justify-content-center align-items-center mb-3">
                <img src="assets/img/adoralogo.jpg" alt="" class="logo">
            </div>
            <h4 class="text-center mb-4" id="salon-name">Adora Beauty Lounge</h4>
            <a href="admin.php">Dashboard</a>
            <a href="services.php" class="active">Services</a>
            <a href="employees.php">Employees</a>
            <a href="customers.php">Customers</a>
            <a href="commission.php">Commissions</a>
            <a href="transact_history.php">Transaction History</a>
            <a href="report.php">Reports</a>
            <a href="staff.php">Billing</a>
            <a href="#">Accounts</a>
        </div>
        <!-- Main Content Area -->
        <div class="content-area">
            <form action="services.php" method="POST">
                <h2 class="mb-4">Manage Services</h2>

                <!-- Search Bar & Action Buttons -->
                <div class="top-bar">
                    <!-- Search Bar -->
                    <div class="search-bar">
                        <input type="text" id="searchInput" class="form-control" placeholder="Search service...">
                        <button id="btnSearch" class="btn btn-primary">Search</button>
                    </div>


                    <!-- Action Buttons -->
                    <div class="btn-actions">
                        <a href="service_category.php" class="btn btn-warning">Manage Categoties</a>
                        <a href="add_service.php" class="btn btn-success">Add Services</a>
                    </div>
                </div>

                <!-- Services Table -->
                <div class="table-container">
                    <?php
                    include 'connect.php';

                    $searchKey = ""; // Initialize search key
                    $query = "SELECT * FROM service_list ORDER BY id DESC"; // Default query

                    // Check if the search button is clicked
                    if (isset($_POST['btn_search'])) {
                        $searchKey = mysqli_real_escape_string($conn, $_POST['search_key']);

                        if (!empty($searchKey)) {
                            $query = "SELECT * FROM service_list 
                  WHERE service_name LIKE '%$searchKey%' 
                  OR category LIKE '%$searchKey%'";
                        }
                    }

                    $result = mysqli_query($conn, $query);

                    if (!$result) {
                        die("Search query failed: " . mysqli_error($conn)); // For debugging
                    }
                    ?>

                    <table class="table table-hover table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th hidden>ID</th>
                                <th>Service Name</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                    <tr>
                                        <td hidden><?php echo $row['id']; ?></td>
                                        <td><?php echo $row['service_name']; ?></td>
                                        <td><?php echo $row['amount']; ?></td>
                                        <td><?php echo $row['category']; ?></td>
                                        <td>
                                            <div class="d-flex gap-1">
                                                <a href="edit_service.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">
                                                    <i class="bi bi-pencil-square"></i> Edit
                                                </a>
                                                <a href="delete_service.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">
                                                    <i class="bi bi-trash"></i> Delete
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                            <?php
                                }
                            } else {
                                echo "<tr><td colspan='5' class='text-center text-danger'>No matching services found.</td></tr>";
                            }
                            ?>
                        </tbody>




                </div>
            </form>
        </div>

    </div>
    <!-- Include Footer -->
    <?php //include 'includes/footer.php'; 
    ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#btnSearch").click(function(e) {
                e.preventDefault(); // Prevent form submission

                var searchKey = $("#searchInput").val();

                $.ajax({
                    url: "search_service.php",
                    method: "POST",
                    data: {
                        search_key: searchKey
                    },
                    success: function(response) {
                        $("tbody").html(response); // Update table without refreshing
                    }
                });
            });

            // Optional: Live search when typing
            $("#searchInput").on("keyup", function() {
                var searchKey = $(this).val();

                $.ajax({
                    url: "search_service.php",
                    method: "POST",
                    data: {
                        search_key: searchKey
                    },
                    success: function(response) {
                        $("tbody").html(response);
                    }
                });
            });
        });
    </script>

</body>

</html>