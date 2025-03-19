<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports - Adora Billing System</title>
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

        .card-container {
            display: flex;
            /* Change from grid to flex */
            gap: 1.5rem;
            /* Maintain the spacing between cards */
        }

        .card {
            border-radius: 10px;
            padding: 1.5rem;
            color: #fff;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        .total-customers {
            background-color: #17a2b8;
        }

        .total-commission {
            background-color: #28a745;
        }

        .total-sales {
            background-color: #ffc107;
            color: #212529;
        }

        .total-profit {
            background-color: #dc3545;
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

        @media (max-width: 992px) {
            .card-container {
                grid-template-columns: repeat(2, 1fr);
                /* Two cards per row for medium screens */
            }
        }

        @media (max-width: 576px) {
            .card-container {
                grid-template-columns: 1fr;
                /* One card per row for small screens */
            }
        }
    </style>
</head>

<body>
    <div class="main-content">
        <div class="sidebar">
            <h4 class="text-center mb-4">Admin Panel</h4>
            <a href="admin.php">Dashboard</a>
            <a href="services.php">Services</a>
            <a href="employees.php">Employees</a>
            <a href="customers.php">Customers</a>
            <a href="commission.php">Commissions</a>
            <a href="transact_history.php">Transaction History</a>
            <a href="report.php" class="active">Reports</a>
            <a href="#">Accounts</a>
        </div>

        <div class="content-area">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Reports Overview</h2>
                <div class="text-end">
                    <h5 class="text-secondary">
                        <?php $date = date('D d, Y');
                        echo $date; ?> <!-- Displays the current date -->
                    </h5>
                </div>
            </div>


            <div class="card-container">
                <div class="card total-customers">
                    <h4>Total Customers Served</h4>
                    <p class="fs-3 fw-bold">
                        <?php
                        include 'connect.php';
                        $query = mysqli_query($conn, "SELECT COUNT(*) AS total_customers FROM customers_list");
                        $result = mysqli_fetch_assoc($query);
                        echo $result['total_customers'];
                        ?>
                    </p>
                </div>

                <div class="card total-commission">
                    <h4>Total Commission</h4>
                    <p class="fs-3 fw-bold">
                        ₱ <?php
                            $query = mysqli_query($conn, "SELECT SUM(commission) AS total_commission FROM transactiondetails");
                            $result = mysqli_fetch_assoc($query);
                            echo number_format($result['total_commission'], 2);
                            ?>
                    </p>
                </div>

                <div class="card total-sales">
                    <h4>Total Sales</h4>
                    <p class="fs-3 fw-bold">
                        ₱ <?php
                            $query = mysqli_query($conn, "SELECT SUM(total_amount) AS total_sales FROM transactions");
                            $result = mysqli_fetch_assoc($query);
                            echo number_format($result['total_sales'], 2);
                            ?>
                    </p>
                </div>

                <div class="card total-profit">
                    <h4>Total Profit</h4>
                    <p class="fs-3 fw-bold">
                        ₱ <?php
                            include'connect.php';
                            if (isset($_POST['submit'])) {
                                $selecteddate = mysqli_real_escape_string($conn, $_POST['selecteddate']); // Sanitize input
                            
                                // SQL query to calculate total profit
                                $query = "
                                    SELECT 
                                        IFNULL(SUM(t.total_amount) - SUM(td.total_commission), 0) AS total_profit
                                    FROM transactions t
                                    LEFT JOIN (
                                        SELECT 
                                            transaction_id, 
                                            SUM(commission) AS total_commission
                                        FROM transactiondetails
                                        GROUP BY transaction_id
                                    ) td ON td.transaction_id = t.transaction_id
                                    WHERE DATE(t.transaction_date) = '$selecteddate'
                                ";
                            
                                $result = mysqli_query($conn, $query);
                            
                                if ($result) {
                                    $row = mysqli_fetch_assoc($result);
                                    $total_profit = $row['total_profit'];
                                    echo "<script>alert('Total Profit for $selecteddate: PHP $total_profit');</script>";
                                } else {
                                    echo "<script>alert('Error calculating profit: " . mysqli_error($conn) . "');</script>";
                                }
                            }
                            ?>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>

</html>