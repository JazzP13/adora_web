<?php
include 'connect.php';

// Get today's date in 'YYYY-MM-DD' format
$current_date = date('Y-m-d');

// Check if a specific date is selected via form input
if (isset($_POST['selected_date']) && !empty($_POST['selected_date'])) {
    $current_date = $_POST['selected_date'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Commissions - Adora Billing System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/style.css"> <!-- Custom CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
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

        .table th,
        .table td {
            padding-left: 2rem;
            padding-right: 2rem;
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

        #refresh-btn {
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>
    <div class="main-content">
        <div class="sidebar">
            <div class="logo-container d-flex justify-content-center align-items-center mb-3">
                <img src="assets/img/adoralogo.jpg" alt="Adora Logo" class="logo">
            </div>
            <h4 class="text-center mb-4" id="salon-name">Adora Beauty Lounge</h4>
            <a href="admin.php">Dashboard</a>
            <a href="services.php">Services</a>
            <a href="employees.php">Employees</a>
            <a href="customers.php">Customers</a>
            <a href="commission.php" class="active">Commissions</a>
            <a href="transact_history.php">Transaction History</a>
            <a href="report.php">Reports</a>
            <a href="staff.php">Billing</a>
            <a href="#">Accounts</a>
        </div>

        <div class="content-area">
            <h2 class="mb-4">Manage Commissions</h2>

            <div class="top-bar">
                <form method="POST" action="" class="d-flex">
                    <input type="date" class="form-control w-25" name="selected_date" value="<?= $current_date ?>">
                    <button type="submit" class="btn btn-primary ms-2">Search</button>
                </form>
            </div>

            <div class="table-container mt-4">
                <button class="btn btn-outline-primary btn-sm" id="refresh-btn">
                    <i class="bi bi-arrow-clockwise"></i> Refresh
                </button>
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Date</th>
                            <th>Staff Name</th>
                            <th>Total Commission</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        <?php
                        // Fetch and group commissions by staff name, summing their total commissions for the selected date
                        $query = mysqli_query($conn, "SELECT staff_name, SUM(commission_per_transaction) AS total_commission, MAX(transaction_date_time) AS last_transaction 
                                                      FROM commissions 
                                                      WHERE DATE(transaction_date_time) = '$current_date' 
                                                      GROUP BY staff_name 
                                                      ORDER BY last_transaction DESC");

                        if (!$query) {
                            echo "<tr><td colspan='3' class='text-danger text-center'>Error fetching data: " . mysqli_error($conn) . "</td></tr>";
                        } elseif (mysqli_num_rows($query) > 0) {
                            while ($row = mysqli_fetch_assoc($query)) {
                                // Convert MySQL DATETIME to a readable format
                                $formatted_date = date("F j, Y", strtotime($row['last_transaction'])); 


                                echo "<tr>
                                    <td>{$formatted_date}</td>
                                    <td>{$row['staff_name']}</td>
                                    <td>₱ " . number_format($row['total_commission'], 2) . "</td>
                                </tr>";
                            }
                        } else {
                            echo '<tr><td colspan="3" class="text-center">No records found for the selected date.</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>

    <script>
        document.getElementById('refresh-btn').addEventListener('click', function() {
            let today = new Date().toISOString().split('T')[0]; // Get today's date in 'YYYY-MM-DD' format
            document.querySelector('input[name="selected_date"]').value = today; // Set the date input field
            document.querySelector('form').submit(); // Submit the form to reload data
        });
    </script>


</body>

</html>