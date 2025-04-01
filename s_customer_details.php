<?php
include 'connect.php';
$fullname = $_GET["fullname"];

$query2 = mysqli_query($conn, "SELECT * FROM transactions WHERE customer_name = '$fullname'");
$result = mysqli_fetch_assoc($query2);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            margin: 0;
            padding: 0;
            font-family: 'Poppins';
        }

        .header {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 20px;
            padding: 10px 20px;
            height: 10vh;
        }

        .head-text {
            flex-grow: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #btn-back {
            border: 1px solid #CFE2FF;
            background-color: #0D6EFD;
            color: white;
            position:fixed;
            box-shadow: rgba(0, 0, 0, 0.36);
        }

        #btn-back:hover {
            background-color: #CFE2FF;
            color: rgb(0, 0, 0)
        }

        #customer-name {
            font-size: 1.5rem;
            font-weight: 400;
            flex-grow: 1;
        }

        .table-container {
            width: 95%;
            margin-top: 20px;
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(6, 19, 134, 0.54);
            padding: 1rem;
            margin-bottom: 2rem;
        }

        table {
            width: 95%;
        }

        th {
            font-size: 1.1rem;
            font-weight: 600;
        }

        tbody {
            font-size: 0.8em;
        }

        #total-amount-lable {
            font-size: 1.5rem;
            font-weight: 600;
        }

        #total-amount {
            height: 60px;
            text-align: center;
            font-size: 1.5rem;
            background-color: #D1E7DD;
        }

        #c-name {
            font-size: 1.8rem;
            font-weight: 600;
        }

        span {
            font-weight: 500;
            font-style: italic;
        }

        #info-row {
            background-color: white;
        }

        #total-amount-lablel {
            font-size: 2rem;
            font-weight: 500;
        }
        #total_cost{
            width: 200px;
            height: 60px;
            font-size: 1.5rem;
            background-color:rgb(180, 240, 252);
        }
    </style>
    <title>Customer's details</title>
</head>

<body>
    <div class="container-fluid p-0">
        <div class="header p-3">
            <div id="header-button" class="d-flex">
                <a href="s_customers.php" class="btn" id="btn-back"><i class="bi bi-arrow-left"></i>Back</a>
            </div>
            <div class="head-text d-flex flex-column justify-content-center align-items-center">
                <h3 class="mb-0 text-center ">Customer's details</h3>
            </div>
        </div>
        <div class="content d-flex flex-column justify-content-center align-items-center pt-4">

            <!-- The customer's name will be displayed here -->
            <div class="container-fluid">
                <p class="text-start" id="customer-name">
                    Customer name: <span class="text-primary" id="c-name"><u><?php echo $fullname; ?></u></span>
                </p>
            </div>


            <!-- table to display the customer's details -->
            <div class="table-container">
                <table class="table table-unbordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Date of visit</th>
                            <th>Transact. Id</th>
                            <th>Availed service/s</th>
                            <th>Service amount</th>
                            <th>Service Provider</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $join_query = mysqli_query($conn, "SELECT c.fullname,
                                                                                    c.date_visited,
                                                                                    t.transaction_id, 
                                                                                    t.transaction_date, 
                                                                                    t.customer_name, 
                                                                                    td.service_name, 
                                                                                    td.amount,
                                                                                    td.staff_name
                                                                                    FROM customers_list c
                                                                                    JOIN transactions t ON c.fullname = t.customer_name
                                                                                    JOIN transaction_details td ON t.transaction_id = td.transaction_id
                                                                                    WHERE c.fullname = '$fullname'");
                        if (mysqli_num_rows($join_query) > 0) {
                            while ($row = mysqli_fetch_assoc($join_query)) {
                        ?>
                                <tr>
                                    <td><?php echo $row['date_visited']; ?></td>
                                    <td><?php echo $row['transaction_id']; ?></td>
                                    <td><?php echo $row['service_name']; ?></td>
                                    <td><?php echo $row['amount']; ?></td>
                                    <td><?php echo $row['staff_name']; ?></td>
                            <?php
                            }
                        } ?>
                                </tr>
                    </tbody>
                </table>
                <!--<div class="container-fluid mt-5 d-flex justify-content-end align-items-center">
                    <div class="">
                        <label for="total_cost" id="total-cost-lable" class="text-primary fs-5">Total amount:</label>
                        <?php
                        $query3 -=mysqli_query($conn,'SELECT SUM(amount) as total_cost FROM transaction_details WHERE transaction_id = $result["transaction_id"]');
                        ?>
                        <input type="text" name="total_cost" id="total_cost" class="form-control text-center fw-bold" value="100" readonly>
                    </div>
                </div>-->
            </div>
        </div>
</body>

</html>