<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Commissions - Adora Billing System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
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
            align-items: flex-start;
            margin-bottom: 1.5rem;
            gap: 1rem;
        }

        .action-buttons {
            display: flex;
            flex-direction: column;
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

        .logo {
            height: 120px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-self: center;
        }

        #salon-name {
            font-family: 'Dancing Script';
        }
    </style>
</head>

<body>
    <div class="main-content">
        <div class="sidebar">
            <div class="logo-container d-flex justify-content-center align-items-center mb-3">
                <img src="assets/img/adoralogo.jpg" alt="" class="logo">
            </div>
            <h4 class="text-center mb-4" id="salon-name">Adora Beauty Lounge</h4>
            <a href="admin.php">Dashboard</a>
            <a href="services.php">Services</a>
            <a href="employees.php">Employees</a>
            <a href="customers.php">Customers</a>
            <a href="commission.php">Commissions</a>
            <a href="transact_history.php" class="active">Transaction History</a>
            <a href="report.php">Reports</a>
            <a href="staff.php">Billing</a>
            <a href="#">Accounts</a>
        </div>

        <div class="content-area">
            <h2 class="mb-4">Transaction History</h2>

            <?php
            include 'connect.php';

            // Initialize $selected_date with today's date as a fallback
            $selected_date = date("Y-m-d");

            // Check if a date has been submitted via POST
            if (isset($_POST['selected_date']) && !empty($_POST['selected_date'])) {
                $selected_date = $_POST['selected_date'];
            }
            ?>

            <div class="top-bar">
                <form method="POST" action="">
                    <input type="date" class="form-control" name="selected_date" value="<?php echo $selected_date; ?>">
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>

                <div class="action-buttons">
                    <button class="btn btn-success btn-sm">Export</button>
                    <button class="btn btn-outline-primary btn-sm" id="refresh-btn">
                        <i class="bi bi-arrow-clockwise"></i>
                    </button>
                </div>
            </div>

            <div class="table-container">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th style="display:none;">ID</th>
                            <th>Date/Time</th>
                            <th>Customer name</th>
                            <th>Total Amount</th>
                            <th>Number of service/s</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        <?php
                        $query = mysqli_query($conn, "SELECT * FROM transactions ORDER BY transaction_date DESC");
                        if (!$query) {
                            echo "<tr><td colspan='4' class='text-danger text-center'>Error fetching data: " . mysqli_error($conn) . "</td></tr>";
                        } elseif (mysqli_num_rows($query) > 0) {
                            while ($row = mysqli_fetch_assoc($query)) { ?>
                                <tr>
                                    <td hidden><?php $row['transaction_id']?></td>
                                    <td><?php echo $row['transaction_date']; ?></td>
                                    <td><?php echo $row['customer_name']; ?></td>
                                    <td>₱ <?php echo $row['total_amount']; ?></td>
                                    <td class="text-center"><?php echo $row['num_services']; ?></td>
                                    <td><a href="transaction_details.php?transaction_id=<?php echo $row['transaction_id']; ?>" class="btn btn-sm btn-info"><i class="bi bi-eye"></i> View Details</a>
                                    </td>
                                </tr>
                        <?php
                            }
                        } else {
                            echo '<tr><td colspan="4" class="text-center">No records found for the selected date.</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!--- View Details Modal -->
    <div>
        
    </div>

    <?php include 'includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function openMyModal() {
            var modal = new bootstrap.Modal(document.getElementById('viewDetails'));
            modal.show();
        }
    </script>

</body>

</html>