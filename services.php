<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Services - Adora Billing System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/style.css"> <!-- Custom CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">


    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
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
            /* Ensures it sticks at the bottom */
            font-size: 12px;
            box-shadow: 0px -4px 10px rgba(0, 0, 0, 0.3);
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="main-content">
        <!-- Sidebar Navigation -->
        <div class="sidebar">
            <h4 class="text-center mb-4">Admin Panel</h4>
            <a href="admin.php">Dashboard</a>
            <a href="services.php" class="active">Services</a>
            <a href="employees.php">Employees</a>
            <a href="customers.php">Customers</a>
            <a href="commission.php">Commissions</a>
            <a href="transact_history.php">Transaction History</a>
            <a href="report.php">Reports</a>
            <a href="#">Accounts</a>
        </div>

        <!-- Main Content Area -->
        <div class="content-area">
            <h2 class="mb-4">Manage Services</h2>

            <!-- Search Bar & Action Buttons -->
            <div class="top-bar">
                <!-- Search Bar -->
                <div class="search-bar">
                    <input type="text" class="form-control" placeholder="Search service...">
                    <button class="btn btn-primary">Search</button>
                </div>

                <!-- Action Buttons -->
                <div class="btn-actions">
                    <button class="btn btn-warning">Manage Categories</button>
                    <button class="btn btn-success">Add Service</button>
                </div>
            </div>

            <!-- Services Table -->
            <div class="table-container">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Service Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>

                            <!-- this is the php code for fetching data from database -->
                            <?php
                            include 'connect.php';
                            $query = mysqli_query($conn, "SELECT * FROM service_list");
                            while ($row = mysqli_fetch_assoc($query)) {
                            ?>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['description']; ?></td>
                            <td><?php echo $row['amount']; ?></td>
                            <td><?php echo $row['category']; ?></td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-primary">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
                                    <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i> Delete
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>



            </div>
        </div>
    </div>

    <!-- Include Footer -->
    <?php include 'includes/footer.php'; ?>
</body>

</html>