<?php include 'connect.php'; ?>

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
    </style>
</head>

<body>
    <div class="main-content">
        <div class="sidebar">
            <h4 class="text-center mb-4">Staff Panel</h4>
            <a href="staff.php">Dashboard</a>
            <a href="billing.php" class="active">Billing</a>
            <a href="S_customers.php">Customers</a>
            <a href="s_transaction_history.php">Transaction History</a>
            <a href="#">Accounts</a>
        </div>
        <form id="billingForm" action="billing.php" method="post">
            <div class="container">
                <div class="content">
                    <!-- Left Section -->
                    <div class="section-left">
                        <h5 class="fw-bold">Details:</h5>
                        <div class="mb-2">
                            <label class="form-label">Date:</label>
                            <h3><?php echo date('F j, Y') ?></h3>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Service:</label>
                            <select class="form-select" name="selected_service" id="selected-service">
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
                            <select class="form-select" name="selected_staff" id="selected-staff">
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
                    </div>

                    <!-- Right Section -->
                    <div class="section-right">
                        <h5 class="fw-bold"><i class="bi bi-person"></i> Bill To:</h5>
                        <input type="text" class="form-control mb-2" placeholder="Customer's name">
                        <table class="table table-unbordered">
                            <thead>
                                <tr>
                                    <th>Service/s</th>
                                    <th>Amount</th>
                                    <th>Staff</th>
                                    <th>Staff Commission</th>
                                    <th colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody"></tbody>
                            <tr>
                                <!-- table data here -->
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="footer">
                    <div class="w-50">
                        <h5 class="fw-bold">Received Amount:</h5>
                        <input type="text" class="form-control">
                        <h5 class="fw-bold mt-2">Change:</h5>
                        <input type="text" class="form-control" disabled>
                    </div>
                    <div class="w-50 text-end">
                        <h5 class="fw-bold"><i class="bi bi-calculator"></i> Total Amount:</h5>
                        <input type="text" class="form-control" disabled id="total-amount" value="100">
                        <input type="submit" class="btn btn-primary w-100 mt-3" value="Review">
                    </div>
                </div>
            </div>
        </form>
        </script>
</body>

</html>

<?php
// Logic for selected services and selected staff to be saved to the table
$service = $price = $staff = $commission = "";

if (isset($_POST["btn_save"])) {
    $service_and_price = explode("-", $_POST['selected_service']); //extract the data
    $staff_and_commission = explode("-", $_POST['selected_staff']); //extract the data

    $service =  $service_and_price[0];
    $price = intval($service_and_price[1]);

    $staff = $staff_and_commission[0];
    $commission = (int)rtrim($staff_and_commission[1], "%");

    ////unfinised
}
?>