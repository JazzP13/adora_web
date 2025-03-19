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

        .card-container {
            display: flex;
            gap: 1.5rem;
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
        form{
            width: 100%;
            height: 100%;
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
            <div class="content-area">
                <div class="content-wrapper">
                    <div class="container-fluid py-4">
                        <div class="row">

                            <div class="col-md-4">
                                <h4 class="fw-bold text-primary">Details:</h4>
                                <div class="mb-3">
                                    <label class="form-label">Date:</label>
                                    <span class="text-muted">
                                        <?php echo date('F j, Y'); ?>
                                    </span>
                                </div>


                                <div class="mb-3">
                                    <label class="form-label">Service: <span class="text-danger">*</span></label>
                                    <select id="select_service" class="form-select">
                                        <option value="">Select Service</option> <!-- Added value for default option -->
                                        <?php
                                        include 'connect.php'; // Ensure connection is included

                                        $query = "SELECT description, amount FROM service_list";
                                        $result = mysqli_query($conn, $query);

                                        if (!$result) {
                                            die("Error fetching services: " . mysqli_error($conn)); // Improved error handling
                                        }

                                        while ($row = mysqli_fetch_array($result)) {
                                            $description = htmlspecialchars($row["description"]); // Prevents XSS attacks
                                            $amount = htmlspecialchars($row["amount"]);            // Ensures safe display
                                            echo "<option value='$description|$amount'>$description - ₱$amount</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Staff: <span class="text-danger">*</span></label>
                                    <select id="select_staff" class="form-select">
                                        <option>Select Staff</option>
                                        <?php
                                        $query = "SELECT * FROM employees";
                                        $result = mysqli_query($conn, $query);
                                        while ($row = mysqli_fetch_array($result)) {
                                            $fname = $row["firsname"];
                                            $lname = $row["lastnsame"];
                                            $com = $row["comm_percentage"];
                                            echo "<option value='$fname $lname|$com'>$fname $lname - $com%</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <button type="button" onclick="addToTable()" class="btn btn-primary w-100">Add</button>
                            </div>

                            <div class="col-md-8">
                                <h4 class="fw-bold text-primary">
                                    <i class="bi bi-person-fill"></i> Bill To:
                                </h4>
                                <input type="text" name="customer_name" class="form-control mb-3" placeholder="Customer's name">

                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped" id="serviceTable">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>Description</th>
                                                <th>Amount</th>
                                                <th>Staff</th>
                                                <th>Staff Commission</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tableBody">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment Section -->
                <div class="payment-section">
                    <div class="d-flex justify-content-center align-items-center mt-3">
                        <h5 class="fw-bold text-primary me-2">
                            <i class="bi bi-calculator"></i> Total Amount:
                        </h5>
                        <input type="text"
                            name="total_amount"
                            id="totalAmount"
                            class="form-control w-25 text-end fw-bold fs-3 bg-light border-primary text-primary"
                            value="₱0"
                            readonly>
                    </div>

                    <div class="text-end mt-3">
                        <input type="submit" value="Done" name="done" class="btn btn-primary">
                        <?php
                        include 'connect.php';
                        $query = "SELECT * FROM serviceTable";
                        $result = mysqli_query($conn, $query);
                        $num_services = isset($_POST['num_services']) ? intval($_POST['num_services']) : 0;
                        $transact_date = date("F j, Y");
                        $customer_name = isset($_POST['customer_name']) ? $_POST['customer_name'] : '';
                        $total_amount = isset($_POST['total_amount']) ? $_POST['total_amount'] : '₱0';
                        if (isset($_POST["done"])) {
                            $query = "INSERT INTO transactions 
                                    (transaction_date, customer_name, total_amount, num_services) 
                                    VALUES ('$transact_date', '$customer_name', '$total_amount', $num_services)";
                            $insertResult = mysqli_query($conn, $query);

                            if (!$insertResult) {
                                die("Insert failed: " . mysqli_error($conn)); // Debugging insert issues
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
    </div>
    </form>


    <script>
        let totalAmount = 0;

        function addToTable() {
            const serviceData = document.getElementById('select_service').value.split('|');
            const staffData = document.getElementById('select_staff').value.split('|');

            const serviceDesc = serviceData[0];
            const serviceAmount = parseFloat(serviceData[1]);
            const staffName = staffData[0];
            const staffCommission = staffData[1];

            const tableBody = document.getElementById('tableBody');
            const newRow = `
                <tr>
                    <td class="text-center">${serviceDesc}</td>
                    <td class="text-center">₱${serviceAmount}</td>
                    <td class="text-center">${staffName}</td>
                    <td class="text-center">${staffCommission}%</td>
                    <td class="text-center">
                        <button class="btn btn-danger btn-sm" onclick="deleteRow(this, ${serviceAmount})">Delete</button>
                    </td>
                </tr>
            `;

            tableBody.insertAdjacentHTML('beforeend', newRow);
            totalAmount += serviceAmount;
            document.getElementById('totalAmount').value = `₱${totalAmount.toFixed(2)}`;
        }

        function deleteRow(button, amount) {
            button.closest('tr').remove();
            totalAmount -= amount;
            document.getElementById('totalAmount').value = `₱${totalAmount.toFixed(2)}`;
        }
    </script>

    <?php include 'includes/footer.php'; ?>
</body>

</html>