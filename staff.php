<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff - Adora Billing System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/style.css">

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

        .card-container {
            display: flex; /* Ensures cards are in one row */
            gap: 1.5rem; /* Spacing between cards */
        }

        .card {
            border-radius: 12px;
            flex: 1;
            transition: transform 0.3s ease-in-out;
        }

        .card:hover {
            transform: scale(1.05);
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
            <a href="staff.php" class="active">Dashboard</a>
            <a href="billing.php">Billing</a>
            <a href="S_customers.php">Customers</a>
            <a href="s_transaction_history.php">Transaction History</a>
            <a href="#">Accounts</a>
        </div>

        <div class="content-area">
            <h2 class="mb-4">Staff Overview</h2>

            <div class="card-container">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center">
                        <h5 class="card-title">Total Employees</h5>
                        <p class="display-4 fw-bold text-success">8</p>
                        <p class="text-muted">Active Employees</p>
                    </div>
                </div>

                <div class="card shadow-sm border-0">
                    <div class="card-body text-center">
                        <h5 class="card-title">New Hires</h5>
                        <p class="display-4 fw-bold text-primary">2</p>
                        <p class="text-muted">Recently Added</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
