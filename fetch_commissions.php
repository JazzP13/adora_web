<?php
include 'connect.php';

// Check if refresh button is clicked
if (isset($_POST['refresh'])) {
    $selected_date = date("Y-m-d"); // Set to today's date when refresh is clicked
} else {
    $selected_date = isset($_POST['selected_date']) ? $_POST['selected_date'] : date("Y-m-d");
}

$query = mysqli_query($conn, "SELECT * FROM commissions WHERE DATE(transaction_date_time) = '$selected_date'");

if (!$query) {
    echo "<tr><td colspan='4' class='text-danger text-center'>Error fetching data: " . mysqli_error($conn) . "</td></tr>";
} elseif (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_assoc($query)) {
        echo "
            <tr>
                <td style='display:none;'>{$row['id']}</td>
                <td>{$row['transaction_date_time']}</td>
                <td>{$row['staff_name']}</td>
                <td>{$row['commission_per_transaction']}</td>
            </tr>
        ";
    }
} else {
    echo '<tr><td colspan="4" class="text-center">No records found for the selected date.</td></tr>';
}
?>
