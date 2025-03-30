<?php
include 'connect.php';
if (!isset($_GET["transaction_id"]) || empty($_GET["transaction_id"])) {
    die("Transaction ID is missing.");
}
$transact_id = $_GET["transaction_id"];

$query1 = mysqli_query($conn, "SELECT * FROM  transactions WHERE transaction_id = '$transact_id'");
$t_row = mysqli_fetch_array($query1);

$customer_name = $t_row["customer_name"];
$total_amount = intval($t_row['total_amount']);
$transaction_date = $t_row['transaction_date'];

$query2 = mysqli_query($conn, "SELECT * FROM transaction_details WHERE transaction_id = '$transact_id'");
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
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 1rem;
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
        .card{
            width: 30%;
            padding: 1rem;
            border-radius: 10px;
            border: none;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        #total-sales-lablel, #total-commission-lablel, #total-profit-lablel{
            font-size: 1.2rem;
            font-weight: 400;
        }
        #total-sales, #total-commission, #total-profit{
            font-size: 1.7rem;
            font-weight: 700;
            font-style: italic;
        }   
    </style>
    <title>Transaction details</title>
</head>

<body>
    <div class="container-fluid p-0">
        <div class="header p-3">
            <div id="header-button" class="d-flex">
                <a href="transact_history.php" class="btn" id="btn-back"><i class="bi bi-arrow-left"></i>Back</a>
            </div>
            <div class="head-text d-flex flex-column justify-content-center align-items-center">
                <h3 class="mb-0 text-center ">Transaction details</h3>
            </div>
        </div>
        <div class="content d-flex flex-column justify-content-center align-items-center pt-4">

            <div class="container-fluid">
                <p class="text-start" id="customer-name">
                    Customer name: <span class="text-primary" id="c-name"><u><?php echo $customer_name ?></u></span>
                </p>
            </div>
            <div class="table-container table-responsive">
                <table class="table table-unbordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="bg-success text-white">Transaction ID</th>
                            <th class="bg-success text-white">Transaction Date/Time</th>
                            <th class="bg-success text-white">Service</th>
                            <th class="text-center bg-success text-white">Service Price</th>
                            <th class="text-center bg-success text-white">Commssion %</th>
                            <th class="text-center bg-success text-white">Deducted commission</th>
                            <th class="text-center bg-success text-white">Total Profit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($transact_details_row = mysqli_fetch_assoc($query2)) { ?>
                            <tr id="info-row" class="table-unbordered">
                                <td><?php echo $transact_id; ?></td>
                                <td><?php echo $transaction_date; ?></td>
                                <td><?php echo $transact_details_row['service_name']; ?></td>
                                <td class="table-info text-center"><?php echo intval($transact_details_row['amount']); ?></td>
                                <td class="text-center"><?php echo intval($transact_details_row['commission_percent']) . "%"; ?></td>
                                <td class="text-center"><?php echo intval($transact_details_row['commission']); ?></td>
                                <td class="text-center">
                                    <?php
                                    $total_profit = (intval($transact_details_row['amount']) - intval($transact_details_row['commission']));
                                    echo $total_profit;
                                    ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div class="container-fluid mt-5 <?php //d-flex justify-content-end align-items-center?>">
                    <div class="card-container d-flex justify-content-around align-items-center">

                    <?php 
                    $calculation_query = mysqli_query($conn, "SELECT SUM(commission) as total_commisions FROM transaction_details WHERE transaction_id = '$transact_id'");
                    //$calculation_row = mysqli_fetch_array($calculation_query);
                    $total_commission = mysqli_fetch_array($calculation_query)['total_commisions'];
                    $total_profit = $total_amount - $total_commission;

                    ?>

                    <!-- card 1 -->
                        <div class="card bg-warning" id="total-sales-card">
                            <label for="total-amount" id="total-sales-lablel" class="text-dark">Total Sales:</label>
                            <label for="total-cost" id="total-sales" class="text-dark"><?php echo "&#8369;" . " " . number_format($total_amount); ?></label>
                        </div>

                        <!-- card 2 -->
                        <div class="card bg-danger" id="total-commission-card">
                            <label for="total-amount" id="total-commission-lablel" class="text-white">Total commission:</label><span class="text-white">(deducted)</span>
                            <label for="total-cost" id="total-commission" class="text-white"><?php echo "&#8369;" . " " . number_format($total_commission); ?></label>
                        </div>

                        <!-- card 2 -->
                        <div class="card bg-primary" id="total-profit-card">
                            <label for="total-amount" id="total-profit-lablel" class="text-white">Total Profit:</label>
                            <label for="total-cost" id="total-profit" class="text-white"><?php echo "&#8369;" . " " . number_format($total_profit); ?></label>
                        </div>

                    </div>
                </div>
            </div>
        </div>
</body>

</html>