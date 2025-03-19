<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Customers - Adora Billing System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

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

        .content-area {
            flex: 1;
            padding: 2rem;
            background-color: #f8f9fa;
        }

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

        .table-container {
            background: #fff;
            padding: 1rem;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            max-height: 400px; /* Adjust height as desired */
            overflow-y: auto; /* Enables vertical scrollbar */
        }

        footer {
            background-color: #343a40;
            color: #fff;
            text-align: center;
            padding: 0.75rem;
            margin-top: auto;
            font-size: 12px;
            box-shadow: 0px -4px 10px rgba(0, 0, 0, 0.3);
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="main-content">
        <div class="sidebar">
            <h4 class="text-center mb-4">Staff Panel</h4>
            <a href="staff.php">Dashboard</a>
            <a href="billing.php">Billing</a>
            <a href="S_customers.php" class="active">Customers</a>
            <a href="s_transaction_history.php">Transaction History</a>
            <a href="#">Account</a>
        </div>

        <div class="content-area">
            <h2 class="mb-4">Customers List</h2>

            <div class="top-bar">
                <div class="search-bar">
                    <input type="text" class="form-control" placeholder="Search customer...">
                    <button class="btn btn-primary">Search</button>
                </div>
            </div>

            <div class="table-container">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th hidden>ID</th>
                            <th>Fullname</th>
                            <th>Date Visited</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include 'connect.php';

                        $sql = "SELECT id, MAX(date_visited) AS last_visited, full_name 
                        FROM customers_list 
                        GROUP BY full_name 
                        ORDER BY last_visited DESC";
                        $result = $conn->query($sql);

                        // Display data
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                        ?>
                                <tr>
                                    <td hidden><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['full_name']; ?></td>
                                    <td><?php echo $row['last_visited']; ?></td>
                                    <td>
                                        <a href="view_details.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">
                                            <i class="bi bi-eye"></i> View Details
                                        </a>
                                    </td>
                                    <!-- <td>
                            <div class="d-flex gap-1">
                                <a href="edit_customer.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-primary">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <a href="delete_customer.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash"></i> Delete
                                </a>
                            </div>
                        </td>-->
                                </tr>
                        <?php
                            }
                        } else {
                            echo "<tr><td colspan='3'>No records found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>

</html>