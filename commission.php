<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Commissions - Adora Billing System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/style.css"> <!-- Custom CSS -->
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
            align-items: flex-start;
            margin-bottom: 1.5rem;
            gap: 1rem;
        }

        .search-fields {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .search-group {
            display: flex;
            gap: 0.5rem;
            align-items: center;
        }

        .search-fields input {
            width: 200px;
        }

        .today-date {
            font-weight: bold;
            font-family: 'Poppins', sans-serif;
            font-size: 40px;
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
            <a href="commission.php" class="active">Commissions</a>
            <a href="transact_history.php">Transaction History</a>
            <a href="report.php">Reports</a>
            <a href="#">Accounts</a>
        </div>

        <div class="content-area">
            <h2 class="mb-4">Manage Commissions</h2>

            <div class="top-bar">
                <div class="search-fields">
                    <div class="search-group">
                        <input type="text" class="form-control" placeholder="Search...">
                        <button class="btn btn-primary">Search</button>
                    </div>

                    <?php
                    include 'connect.php';

                    $selected_date = date("Y-m-d");
                    if (isset($_POST['selected_date']) && !empty($_POST['selected_date'])) {
                        $selected_date = $_POST['selected_date'];
                    }
                    ?>

                    <div class="search-group">
                        <form method="POST" action="">
                            <input type="date" class="form-control" name="selected_date" value="<?php echo $selected_date; ?>">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </form>
                    </div>
                </div>

                <div class="today-date d-flex align-items-center gap-2">
                    <span id="current-date"><?php echo date("F j, Y", strtotime($selected_date)); ?></span>
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
                            <th>Date</th>
                            <th>Fullname</th>
                            <th>Amount Earned</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        <?php
                        $query = mysqli_query($conn, "SELECT * FROM dailycommissions WHERE `transaction_date` = '$selected_date'");
                        if (!$query) {
                            echo "<tr><td colspan='4' class='text-danger text-center'>Error fetching data: " . mysqli_error($conn) . "</td></tr>";
                        } elseif (mysqli_num_rows($query) > 0) {
                            while ($row = mysqli_fetch_assoc($query)) {
                                echo "<tr>
                                    <td style='display:none;'>{$row['id']}</td>
                                    <td>{$row['transaction_date']}</td>
                                    <td>{$row['staff_name']}</td>
                                    <td>₱ {$row['total_commission']}</td>
                                </tr>";
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

    <?php include 'includes/footer.php'; ?>

    <script>
        document.getElementById('refresh-btn').addEventListener('click', function () {
            const currentDate = new Date();
            const formattedDate = currentDate.toLocaleDateString('en-US', {
                month: 'long',
                day: 'numeric',
                year: 'numeric'
            });

            document.getElementById('current-date').textContent = formattedDate;

            const xhr = new XMLHttpRequest();
            xhr.open('GET', 'fetch_commissions.php?date=' + currentDate.toISOString().split('T')[0], true);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    document.getElementById('table-body').innerHTML = xhr.responseText;
                }
            };
            xhr.send();
        });
    </script>

</body>

</html>
