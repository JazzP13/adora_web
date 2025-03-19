<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Employees - Adora Billing System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/style.css">
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

        .btn-actions {
            display: flex;
            gap: 0.5rem;
        }

        .table-container {
            background: #fff;
            padding: 1rem;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
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
            <h4 class="text-center mb-4">Admin Panel</h4>
            <a href="admin.php">Dashboard</a>
            <a href="services.php">Services</a>
            <a href="employees.php" class="active">Employees</a>
            <a href="customers.php">Customers</a>
            <a href="commission.php">Commissions</a>
            <a href="transact_history.php">Transaction History</a>
            <a href="report.php">Reports</a>
            <a href="#">Accounts</a>
        </div>

        <div class="content-area">
            <h2 class="mb-4">Manage Employees</h2>

            <div class="top-bar">
                <div class="search-bar">
                    <input type="text" class="form-control" placeholder="Search employee...">
                    <button class="btn btn-primary">Search</button>
                </div>

                <div class="btn-actions">
                    <button class="btn btn-success">
                        <i class="bi bi-plus-lg"></i> New Employee
                    </button>
                </div>
            </div>

            <div class="table-container">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Date Started</th>
                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th>Birthdate</th>
                            <th>Address</th>
                            <th>Commission %</th>
                            <th colspan="2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include 'connect.php';
                        $query = mysqli_query($conn, "SELECT * FROM employees");
                        while ($row = mysqli_fetch_assoc($query)) {
                        ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['date']; ?></td>
                            <td><?php echo $row['firsname']; ?></td>
                            <td><?php echo $row['lastnsame']; ?></td>
                            <td><?php echo $row['birthdate']; ?></td>
                            <td><?php echo $row['address']; ?></td>
                            <td><?php echo intval($row['comm_percentage']);?>%</td>
                            <td>
                                <a href="edit_employee.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-primary">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                            </td>
                            <td>
                                <a href="delete_employee.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash"></i> Delete
                                </a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>

</html>