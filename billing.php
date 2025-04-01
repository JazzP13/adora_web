<?php
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">



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
            position: sticky;
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
            display: flex;
            flex-direction: column;
            flex: 1;
            padding: 2rem;
            background-color: #f8f9fa;
        }

        .content-wrapper {
            flex-grow: 1;
            overflow-y: auto;
        }

        .payment-section {
            position: sticky;
            bottom: 0;
            background-color: #fff;
            border-top: 2px solid #007bff;
            padding: 1rem;
            box-shadow: 0px -2px 5px rgba(0, 0, 0, 0.1);
            z-index: 10;
        }

        form {
            width: 100%;
            height: 100%;
        }

        .container {
            width: 100vw;
            height: 100vh;
            background: white;
            padding: 20px;
            border-radius: 10px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .content {
            display: flex;
            flex-grow: 1;
            gap: 5px;
        }

        .section-left {
            width: 30%;
            padding-right: 1rem;
        }

        .section-right {
            width: 65%;
            padding-left: 1rem;
        }

        .footer {
            display: flex;
            justify-content: space-between;
            position: sticky;
            bottom: 0;
            background: white;
            padding: 10px 0;
            gap: 10rem;
        }

        #total-amount {
            height: 60px;
            text-align: center;
            font-size: 40px;
        }

        #bill_to {
            font-size: 40px;
        }

        #details {
            font-size: 30px;
        }

        table {
            padding: 1rem;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        #place_payment {
            height: 60px;
        }

        #total_label {
            font-size: 30px;
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
            <a href="staff.php">Dashboard</a>
            <a href="billing.php" class="active">Billing</a>
            <a href="S_customers.php">Customers</a>
            <a href="s_transaction_history.php">Transaction History</a>
            <a href="admin.php">Management</a>
        </div>
        <form id="billingForm" action="billing.php" method="POST">
            <div class="container">
                <div class="content">
                    <!-- Left Section -->
                    <div class="section-left">
                        <h5 class="fw-bold text-primary" id="details">Details:</h5>
                        <div class="mb-2">
                            <label class="form-label">Service:</label>
                            <select class="form-select" name="selected_service" id="selected-service" required>
                                <option>Select service</option>
                                <?php
                                $query = $conn->prepare("SELECT * FROM service_list");
                                $query->execute();
                                $result = $query->get_result();
                                while ($row = $result->fetch_assoc()) {
                                    $value = $row['service_name'] . "-" . intval($row['amount']);
                                    echo "<option>$value</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Staff:</label>
                            <select class="form-select" name="selected_staff" id="selected-staff" required>
                                <option>Select staff</option>
                                <?php
                                $query = $conn->prepare("SELECT * FROM employees_list");
                                $query->execute();
                                $result = $query->get_result();
                                while ($row = $result->fetch_assoc()) {
                                    $value = $row['firstname'] . " " . $row['lastname'] . "-" . intval($row["comm_percentage"]) . "%";
                                    echo "<option>$value</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <input type="submit" name="btn_save" class="btn btn-primary w-100" value="Save">
                        <?php
                        // Logic for selected services and selected staff to be saved to the table
                        $service = $price = $staff = $commission = "";

                        if (isset($_POST["btn_save"])) {
                            if ($_POST["selected_service"] == "Select service" || $_POST["selected_staff"] == "Select staff") {
                                echo "<script>alert('Please select both Service and Staff')</script>";
                                exit();
                            }

                            $service_and_price = explode("-", $_POST['selected_service']); //extract the data
                            $staff_and_commission = explode("-", $_POST['selected_staff']);

                            if (count($service_and_price) < 2 || count($staff_and_commission) < 2) {
                                echo "<script>alert('Invalid selection format. Please select again.')</script>";
                                exit();
                            }

                            $service =  $service_and_price[0];
                            $price = intval($service_and_price[1]);

                            $staff = $staff_and_commission[0];
                            $commission = (int)rtrim($staff_and_commission[1], "%");
                            $staff_commission = ($price * $commission) / 100;

                            $query = mysqli_query($conn, "INSERT INTO availed_service (service_name, price, staff, comm_percent, staff_commision) VALUES ('$service', '$price', '$staff', '$commission', '$staff_commission')");
                        }
                        ?>
                    </div>

                    <!-- Right Section -->
                    <div class="section-right">
                        <h5 class="fw-bold text-primary" id="bill_to"><i class="bi bi-person-fill"></i> Bill To:</h5>
                        <input type="text" name="customer_name" class="form-control mb-2 text-center" id="customer_name" placeholder="Customer's name">
                        <table class="table table-unbordered table-hover mt-4">
                            <thead class="table-dark">
                                <tr>
                                    <th>Service/s</th>
                                    <th>Amount</th>
                                    <th colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody">
                                <tr>

                                    <?php
                                    $msg = "no data yet";
                                    $query = mysqli_query($conn, "SELECT * FROM availed_service");
                                    if (mysqli_num_rows($query) == 0) {
                                        echo "<tr><td colspan='5' class='text-center'>No data yet</td></tr>";
                                    } else {
                                        while ($row = mysqli_fetch_assoc($query)) {

                                            echo "<tr>
                                        <td>{$row['service_name']}</td>
                                        <td>₱{$row['price']}</td>
                                        <td>
                                        <a href='delete_availed.php?id={$row['id']}' class='btn btn-sm btn-danger'>
                                        <i class='bi bi-trash'></i> Delete
                                        </td>
                                        </tr>";
                                        }
                                    }
                                    ?>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="footer d-flex justify-content-center align-items-center">
                    <div class="w-50 text-end">
                        <h5 class="fw-bold text-primary" id="total_label"><i class="bi bi-calculator text-primary"></i> Total Amount:</h5>
                        <input type="text" class="form-control" readonly id="total-amount" value="<?php
                                                                                                    $total_amount = calculateTotalAmount($conn);

                                                                                                    function calculateTotalAmount($conn)
                                                                                                    {
                                                                                                        $query = mysqli_query($conn, "SELECT SUM(price) AS total FROM availed_service");
                                                                                                        $result = mysqli_fetch_assoc($query);
                                                                                                        return isset($result['total']) ? $result['total'] : 0;
                                                                                                    }
                                                                                                    if (mysqli_num_rows($query) == 0) {
                                                                                                        echo "₱0";
                                                                                                    } else {
                                                                                                        echo "₱ " . $total_amount;
                                                                                                    } ?>">
                        <input type="submit" value="Place Payment" name="place_payment" class="btn btn-primary w-100 mt-3" id="place_payment">
                        <?php
                        
                        include 'connect.php';

                        $customer_name = isset($_POST['customer_name']) ? trim($_POST['customer_name']) : "";

                        // Fetch the number of services availed
                        $query = "SELECT COUNT(*) AS service_num FROM availed_service";
                        $a = mysqli_query($conn, $query);
                        if (!$a) {
                            die("Query failed: " . mysqli_error($conn));
                        }
                        $result = mysqli_fetch_assoc($a);
                        $num_of_services = $result['service_num'];
                        $total_amount = calculateTotalAmount($conn);
                        date_default_timezone_set('Asia/Manila'); // Change to your correct timezone
                        $transact_date_time = date('Y-m-d H:i:s'); // MySQL datetime format



                        if (isset($_POST["place_payment"])) { // When button is clicked
                            if (!empty($customer_name)) {
                                mysqli_autocommit($conn, false); // Disable auto-commit
                                mysqli_begin_transaction($conn); // Start transaction
                                try {
                                    // Insert into transactions table
                                    $query = "INSERT INTO transactions (transaction_date, customer_name, total_amount, num_services) VALUES (?, ?, ?, ?)";
                                    $stmt = mysqli_prepare($conn, $query);

                                    if (!$stmt) {
                                        throw new Exception("Error preparing statement: " . mysqli_error($conn));
                                    }

                                    mysqli_stmt_bind_param($stmt, "ssdi", $transact_date_time, $customer_name, $total_amount, $num_of_services);
                                    $execute = mysqli_stmt_execute($stmt);

                                    if (!$execute) {
                                        throw new Exception("Error inserting transaction: " . mysqli_error($conn));
                                    }

                                    // Get the last inserted transaction ID
                                    $transaction_id = mysqli_insert_id($conn);
                                    mysqli_stmt_close($stmt);
                                } catch (Exception $e) {
                                    mysqli_rollback($conn);
                                    die("Transaction failed: " . $e->getMessage());
                                }
                            } else {
                                die("Customer name is required.");
                            }

                            // Fetch data from availed_service
                            $query = "SELECT * FROM availed_service";
                            $b = mysqli_query($conn, $query);

                            if (!$b) {
                                die("Error fetching services: " . mysqli_error($conn));
                            }

                            while ($row = mysqli_fetch_assoc($b)) {
                                $service_name = $row['service_name'];
                                $service_price = $row['price'];
                                $staff_name = $row['staff'];
                                $staff_commission = $row['staff_commision'];
                                $commission_percent = $row['comm_percent'];

                                try {
                                    // Insert into transaction_details
                                    $query = "INSERT INTO transaction_details (transaction_id, service_name, amount, staff_name, commission, commission_percent) VALUES (?, ?, ?, ?, ?, ?)";
                                    $stmt = mysqli_prepare($conn, $query);

                                    if (!$stmt) {
                                        throw new Exception("Error preparing statement: " . mysqli_error($conn));
                                    }

                                    mysqli_stmt_bind_param($stmt, "isdsdd", $transaction_id, $service_name, $service_price, $staff_name, $staff_commission, $commission_percent);
                                    $execute = mysqli_stmt_execute($stmt);

                                    if (!$execute) {
                                        throw new Exception("Error inserting transaction details: " . mysqli_error($conn));
                                    }

                                    mysqli_stmt_close($stmt);
                                } catch (Exception $e) {
                                    mysqli_rollback($conn);
                                    die("Transaction details failed: " . $e->getMessage());
                                }

                                try {
                                    // Insert into commissions table
                                    $query = "INSERT INTO commissions (transaction_date_time, staff_name, service, service_price, commission_per_transaction, commission_percent) VALUES (?, ?, ?, ?, ?, ?)";
                                    $stmt = mysqli_prepare($conn, $query);

                                    if (!$stmt) {
                                        throw new Exception("Error preparing statement: " . mysqli_error($conn));
                                    }

                                    mysqli_stmt_bind_param($stmt, "sssddd", $transact_date_time, $staff_name, $service_name, $service_price, $staff_commission, $commission_percent);
                                    $execute = mysqli_stmt_execute($stmt);

                                    if (!$execute) {
                                        throw new Exception("Error inserting into commissions: " . mysqli_stmt_error($stmt));
                                    }

                                    mysqli_stmt_close($stmt);
                                } catch (Exception $e) {
                                    mysqli_rollback($conn);
                                    die("Transaction failed: " . $e->getMessage());
                                }
                            }

                            //Commit everything after all insertions are successful**
                            mysqli_commit($conn);
                            mysqli_autocommit($conn, true); // Re-enable auto-commit

                            echo "<script>window.location.href = 'transact_succes.php';</script>";
                            exit();
                        }



                        ?>



                    </div>
                </div>
            </div>
        </form>
</body>

</html>