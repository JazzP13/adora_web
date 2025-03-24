<?php
include 'connect.php';

$searchKey = isset($_POST['search_key']) ? mysqli_real_escape_string($conn, $_POST['search_key']) : '';

$query = "SELECT * FROM service_list";
if (!empty($searchKey)) {
    $query = "SELECT * FROM service_list WHERE service_name LIKE '%$searchKey%' OR category LIKE '%$searchKey%'";
}

$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

// Generate the table rows dynamically
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td hidden>{$row['id']}</td>
                <td>{$row['service_name']}</td>
                <td>{$row['amount']}</td>
                <td>{$row['category']}</td>
                <td>
                    <div class='d-flex gap-1'>
                        <a href='edit_service.php?id={$row['id']}' class='btn btn-primary btn-sm'>
                            <i class='bi bi-pencil-square'></i> Edit
                        </a>
                        <a href='delete_service.php?id={$row['id']}' class='btn btn-danger btn-sm'>
                            <i class='bi bi-trash'></i> Delete
                        </a>
                    </div>
                </td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='5' class='text-center text-danger'>No matching services found.</td></tr>";
}
?>
