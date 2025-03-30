<?php
include 'connect.php';

if (isset($_POST['search'])) {
    $search = $conn->real_escape_string($_POST['search']);

    $sql = "SELECT id, fullname, date_visited AS last_visited 
            FROM customers_list 
            WHERE fullname LIKE '%$search%' 
            ORDER BY last_visited DESC";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td hidden>{$row['id']}</td>
                    <td>{$row['fullname']}</td>
                    <td>{$row['last_visited']}</td>
                    <td>
                        <a href='view_details.php?id={$row['id']}' class='btn btn-primary btn-sm'>
                            <i class='bi bi-eye'></i> View Details
                        </a>
                    </td>
                </tr>";
        }
    } else {
        echo "<tr><td colspan='3'>No records found.</td></tr>";
    }
}
?>
