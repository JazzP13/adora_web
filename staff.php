<?php
/*session_start();
if(!isset($_SESSION['staff_id'])){
    header('location:login.php');
}*/
include 'connect.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff - Adora Billing System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">


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
            background-image: url(assets/img/adorahome.png);
            background-size: cover;

        }

        .card-container {
            display: flex;
            /* Ensures cards are in one row */
            gap: 1.5rem;
            /* Spacing between cards */
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

        .head-text h2 {
            font-family: 'Dancing Script';
            font-size: 80px;
            color: #fff;
        }

        #salon-name {
            font-family: 'Dancing Script';
        }

        .logo {
            height: 120px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-self: center;
        }
    </style>
</head>

<body>
    <div class="main-content">
        <div class="sidebar">
            <div class="logo-container d-flex justify-content-center align-items-center mb-3">
                <img src="assets/img/adoralogo.jpg" alt="" class="logo">
            </div>
            <h4 class="text-center mb-4" id="salon-name">Adora beauty Lounge</h4>
            <a href="staff.php" class="active">Dashboard</a>
            <a href="billing.php">Billing</a>
            <a href="S_customers.php">Customers</a>
            <a href="s_transaction_history.php">Transaction History</a>
            <a href="admin.php">Management</a>
        </div>

        <div class="content-area">
            <div class="head-text d-flex justify-content-center align-items-center">
                <h2 class="mb-4">Adora Beauty Lounge</h2>
            </div>

            <?php
            $sql = "SELECT COUNT(*) AS num_of_emoloyess FROM employees_list"; // QUERY TO GET THE NUMBER OF EMPLOYEES
            $query_result = mysqli_query($conn, $sql);
            $result = mysqli_fetch_assoc($query_result);
            ?>

            <div class="card-container">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center">
                        <h5 class="card-title">Total Employees</h5>
                        <p class="display-4 fw-bold text-success"><?php echo $result['num_of_emoloyess']; ?></p>
                        <p class="text-muted">Active Employees</p>
                    </div>
                </div>


                <?php
                $sql_2 = "SELECT COUNT(*) AS num_of_services FROM service_list"; // QUERY TO GET THE NUMBER OF SERVICES
                $query_result_2 = mysqli_query($conn, $sql_2);
                $row = mysqli_fetch_assoc($query_result_2);
                ?>

                <div class="card shadow-sm border-0">
                    <div class="card-body text-center">
                        <h5 class="card-title">Total Services</h5>
                        <p class="display-4 fw-bold text-primary"><?php echo $row['num_of_services']; ?></p>
                        <p class="text-muted">Available services</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>

</html>