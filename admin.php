<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Adora Billing System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/style.css"> <!-- Custom CSS -->

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

        /* Card Styling */
        .card {
            border-radius: 12px;
            transition: transform 0.3s ease-in-out;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card-body {
            padding: 2rem;
        }

        /* Footer Styling */
        footer {
            background-color: #343a40;
            color: #fff;
            text-align: center;
            padding: 0.75rem;
            margin-top: auto; /* Ensures it sticks at the bottom */
            font-size: 12px;
            box-shadow: 0px -4px 10px rgba(0, 0, 0, 0.3); /* Footer shadow */
            width: 100%;
        }
    </style>
</head>
<body style="display: flex; flex-direction: column; min-height: 100vh; margin: 0;">
    <div class="main-content" style="flex: 1;">
        <!-- Sidebar Navigation -->
        <div class="sidebar">
            <h4 class="text-center mb-4">Admin Panel</h4>
            <a href="admin.php" class="active">Dashboard</a>
            <a href="services.php">Services</a>
            <a href="employees.php">Employees</a>
            <a href="customers.php">Customers</a>
            <a href="commission.php">Commissions</a>
            <a href="transact_history.php">Transaction History</a>
            <a href="report.php">Reports</a>
            <a href="#">Accounts</a>
        </div>

        <!-- Main Content Area -->
        <div class="content-area">
            <h2 class="mb-4">Dashboard</h2>

            <div class="row g-4">
                <!-- Total Services Card -->
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-body text-center">
                            <h5 class="card-title">Total Services</h5>
                            <p class="display-4 fw-bold text-primary">15</p>
                            <p class="text-muted">Services Available</p>
                        </div>
                    </div>
                </div>

                <!-- Total Employees Card -->
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-body text-center">
                            <h5 class="card-title">Total Employees</h5>
                            <p class="display-4 fw-bold text-success">8</p>
                            <p class="text-muted">Active Employees</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Footer -->
    <?php include 'includes/footer.php'; ?>
</body>
</html>
