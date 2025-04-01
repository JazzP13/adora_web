<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports - Adora Billing System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
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

        .card-container {
            display: flex;
            /* Change from grid to flex */
            gap: 1.5rem;
            /* Maintain the spacing between cards */
            font-family: 'Poppins';
        }

        .card {
            border-radius: 10px;
            padding: 1.5rem;
            color: #fff;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            font-family: 'Poppins';
        }

        .total-customers {
            background-color: #17a2b8;
            line-height: 1px;
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
            <div class="logo-container d-flex justify-content-center align-items-center mb-3">
                <img src="assets/img/adoralogo.jpg" alt="" class="logo">
            </div>
            <h4 class="text-center mb-4" id="salon-name">Adora Beauty Lounge</h4>
            <a href="admin.php">Dashboard</a>
            <a href="services.php">Services</a>
            <a href="employees.php">Employees</a>
            <a href="customers.php">Customers</a>
            <a href="commission.php">Commissions</a>
            <a href="transact_history.php">Transaction History</a>
            <a href="report.php" class="active">Reports</a>
            <a href="staff.php">Billing</a>
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


            <div class="card-container d-flex flex-wrap">
                <div class="card total-customers">
                    <h4>Total Customers</h4><br>
                    <h4>Served :</h4><br>
                    <p class="fs-3 fw-bold">
                        
                    </p>
                </div>

                <div class="card total-commission">
                    <h4>Total Commission</h4>
                    <p class="fs-3 fw-bold">
                        ₱ 
                    </p>
                </div>

                <div class="card total-sales">
                    <h4>Total Sales</h4>
                    <p class="fs-3 fw-bold">
                        ₱ 
                    </p>
                </div>

                <div class="card total-profit">
                    <h4>Total Profit</h4>
                    <p class="fs-3 fw-bold">
                        ₱ 
                    </p>
                </div>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>

</html>