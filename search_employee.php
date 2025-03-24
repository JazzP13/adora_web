<?php
include 'connect.php';

$search = isset($_POST['search']) ? mysqli_real_escape_string($conn, $_POST['search']) : '';

$query = "SELECT * FROM employees_list WHERE firstname LIKE '%$search%' OR lastname LIKE '%$search%' OR address LIKE '%$search%'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
            <td hidden>{$row['id']}</td>
            <td>{$row['firstname']} {$row['lastname']}</td>
            <td>{$row['birth_date']}</td>
            <td>{$row['address']}</td>
            <td>{$row['date_started']}</td>
            <td>" . intval($row['comm_percentage']) . "%</td>
            <td>
                <a href='edit_employee.php?id={$row['id']}' class='btn btn-sm btn-primary'>
                    <i class='bi bi-pencil-square'></i> Edit
                </a>
            </td>
            <td>
                <a href='delete_employee.php?id={$row['id']}' class='btn btn-sm btn-danger'>
                    <i class='bi bi-trash'></i> Delete
                </a>
            </td>
        </tr>";
    }
} else {
    echo "<tr><td colspan='7' class='text-center text-danger'>No matching employees found.</td></tr>";
}
?>
