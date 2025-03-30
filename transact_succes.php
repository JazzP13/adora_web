<?php
include 'connect.php';

$sql = "SELECT customer_name,transaction_date FROM transactions ORDER BY transaction_id DESC LIMIT 1";
$result = mysqli_query($conn, $sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $customer = $row['customer_name']; // Store the last inserted value
    $date = $row['transaction_date'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Document</title>
    <style>
        body {
            margin-top: 120px;
            font-family: 'Poppins';
        }

        .container {
            padding: 40px;
            width: 50vw;
            text-align: center;
        }

        #button {
            border: none;
            height: 50px;
            width: 160px;
            text-align: center;
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="content-container d-flex flex-column justify-content-center align-items-center">
            <div class="succes_text">
                <h3>Transaction Successfull!</h3>
            </div>
            <div class="button-container p-3">
                <form action="transact_succes.php" method="post">
                    <input type="submit" name="btn_OK" value="OK" class="bg-primary text-white" id="button">
                    <?php
                    if (isset($_POST['btn_OK'])) {

                        //   This query is to insert data into customers_list table
                        $sql_insert = "INSERT INTO customers_list (fullname, date_visited) VALUES (?, ?)";
                        $stmt = $conn->prepare($sql_insert);
                        $stmt->bind_param("ss", $customer, $date);
                        if ($stmt->execute()) {
                            echo "Data successfully inserted into another table!";
                        } else {
                            echo "No records found!";
                        }

                        //    This query is to delete the data sa temporary table
                        $query = mysqli_query($conn, "DELETE FROM availed_service");
                        if ($query) {
                            header("location:billing.php");
                        }
                    }
                    ?>
                </form>
            </div>
        </div>
    </div>
</body>

</html>