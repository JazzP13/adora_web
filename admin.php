<?php include 'connect.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Adora Billing System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/style.css"> <!-- Custom CSS -->
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
            background-color: rgb(255, 255, 255);
            color: rgb(0, 0, 0);
            padding: 1rem;
            box-shadow: 4px 0 10px rgba(0, 0, 0, 0.3);
        }

        .sidebar a {
            color: rgb(0, 0, 0);
            text-decoration: none;
            display: block;
            padding: 0.75rem 1rem;
            border-radius: 5px;
            transition: background 0.3s ease-in-out;
        }

        .sidebar a:hover {
            background-color: #495057;
            color: white;
        }

        .active {
            background-color: #007bff;
            color: #fff;
        }

        /* Content Area */
        .content-area {
            flex: 1;
            padding: 2rem;
            /*background-color: #f8f9fa;*/
            background: url(assets/img/adorahome.png);
            background-repeat: no-repeat;
            background-size: cover;
        }

        .content-area h2 {
            color: white;
            font-family: 'Dancing Script';
            font-size: 80px;
        }

        /* Card Styling */
        .card {
            border-radius: 12px;
            transition: transform 0.3s ease-in-out;
            background-color: rgb(230, 237, 248);
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
            margin-top: auto;
            /* Ensures it sticks at the bottom */
            font-size: 12px;
            box-shadow: 0px -4px 10px rgba(0, 0, 0, 0.3);
            /* Footer shadow */
            width: 100%;
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

<body style="display: flex; flex-direction: column; min-height: 100vh; margin: 0;">
    <div class="main-content" style="flex: 1;">
        <!-- Sidebar Navigation -->
        <div class="sidebar">
            <div class="logo-container d-flex justify-content-center align-items-center mb-3">
                <img src="assets/img/adoralogo.jpg" alt="" class="logo">
            </div>
            <h4 class="text-center mb-4" id="salon-name">Adora Beauty Lounge</h4>
            <a href="admin.php" class="active text-white">Dashboard</a>
            <a href="services.php">Services</a>
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
            <div class="header d-flex justify-content-center align-items-center">
                <h2 class="mb-4">Adora Beauty Lounge</h2>
            </div>
            <div class="g-4 row">
                <!-- Total Services Card -->
                <div class="col-lg-4 col-md-6">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body text-center">
                            <h5 class="card-title">Total Services</h5>
                            <!-- calculate total services available -->
                            <?php
                            $Query = "SELECT * FROM service_list";
                            $res = mysqli_query($conn, $Query);
                            $total_services_available = mysqli_num_rows($res);
                            ?>
                            <p class="display-4 text-primary fw-bold"><?php
                                                                        if (mysqli_num_rows($res) > 0) {
                                                                            echo $total_services_available;
                                                                        } else {
                                                                            echo "Noe service available";
                                                                        }
                                                                        ?></p>
                            <p class="text-muted">Services Available</p>
                        </div>
                    </div>
                </div>

                <!-- Calculate total employees -->
                <?php
                $query = "SELECT * FROM employees_list";
                $result = mysqli_query($conn, $query);
                $total_employees = mysqli_num_rows($result);
                ?>
                <!-- Total Employees Card -->
                <div class="col-lg-4 col-md-6">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body text-center">
                            <h5 class="card-title">Total Employees</h5>
                            <p class="display-4 text-success fw-bold">
                                <?php
                                if (mysqli_num_rows($result) > 0) {
                                    echo $total_employees;
                                } else {
                                    echo "No active employees";
                                }
                                ?></p>
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