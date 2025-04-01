<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Employees - Adora Billing System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- jQuery -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&display=swap" rel="stylesheet">

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
            flex: 1;
            padding: 1rem;
            background-color: #f8f9fa;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .search-bar {
            display: flex;
            gap: 0.5rem;
        }

        .btn-actions {
            display: flex;
            gap: 0.5rem;
        }

        .table-container {
            background: #fff;
            padding: 1rem;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
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
        .logo {
            height: 120px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-self: center;
        }
        #salon-name{
            font-family: 'Dancing Script';
        }
        th {
            font-size: 0.9rem;
            font-weight: 400;
        }
        tr{
            font-size: 0.9rem;
        }
        #edit{
            font-size: 12px;
        }
        #delete{
            font-size: 12px;
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
            <a href="admin.php">Dashboard</a>
            <a href="services.php">Services</a>
            <a href="employees.php" class="active">Employees</a>
            <a href="customers.php">Customers</a>
            <a href="commission.php">Commissions</a>
            <a href="transact_history.php">Transaction History</a>
            <a href="report.php">Reports</a>
            <a href="staff.php">Billing</a>
            <a href="#">Accounts</a>
        </div>

        <div class="content-area">
            <h2 class="mb-4">Manage Employees</h2>

            <div class="top-bar">
                <div class="search-bar">
                    <input type="text" id="searchInput" class="form-control" placeholder="Search employee...">
                    <button id="btnSearch" class="btn btn-primary">Search</button>
                </div>

                <div class="btn-actions">
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">
                        <i class="bi bi-plus-lg"></i>New Employee
                    </button>
                </div>
            </div>

            <div class="table-container">
                <table class="table table-striped table-hover table-responsive">
                    <thead class="table-dark">
                        <tr>
                            <th hidden>ID</th>
                            <th>Fullname</th>
                            <th>Birthdate</th>
                            <th>Address</th>
                            <th>Date Started</th>
                            <th>Commission %</th>
                            <th colspan="2">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="employeeTableBody">
                        <?php
                        include 'connect.php';
                        $query = mysqli_query($conn, "SELECT * FROM employees_list ORDER BY id DESC");
                        while ($row = mysqli_fetch_assoc($query)) {
                        ?>
                            <tr>
                                <td hidden><?php echo $row['id']; ?></td>
                                <td><?php echo $row['firstname'] . " " . $row['lastname']; ?></td>
                                <td><?php echo $row['birth_date']; ?></td>
                                <td><?php echo $row['address']; ?></td>
                                <td><?php echo $row['date_started']; ?></td>
                                <td><?php echo intval($row['comm_percentage']); ?>%</td>
                                <td>
                                    <div class="d-flex flex-row gap-1">
                                        <button class="btn btn-primary btn-sm" id="edit" data-bs-toggle="modal" data-bs-target="#editEmployeeModal<?php echo $row['id']; ?>">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </button><!-- Open the edit modal -->

                                        <a href="delete_employee.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" id="delete">
                                            <i class="bi bi-trash"></i> Delete
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Employee Modal -->
    <div class="modal fade" id="addEmployeeModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Employee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="add_employees.php" method="POST">
                        <div class="mb-3">
                            <label class="form-label">Firstname</label>
                            <input type="text" name="firstname" class="form-control" required>
                            <label class="form-label">Lastname</label>
                            <input type="text" name="lastname" class="form-control" required>
                            <label class="form-label">Birthdate</label>
                            <input type="date" name="b_date" class="form-control" required>
                            <label class="form-label">Address</label>
                            <input type="text" name="address" class="form-control" required>
                            <label class="form-label">Commission Percentage</label>
                            <input type="number" name="commission_percent" class="form-control" required>
                            <label class="form-label">Contact No.</label>
                            <input type="number" name="contact_no" class="form-control" required>
                            <label class="form-label">Date Started</label>
                            <input type="text" name="date_started" class="form-control" value="<?php echo date('F j, Y') ?>" disabled>
                        </div>
                        <div class="text-end">
                            <button type="submit" name="save_employee" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
    include 'connect.php';
    $query = mysqli_query($conn, "SELECT * FROM employees_list ORDER BY id DESC");
    while ($row = mysqli_fetch_assoc($query)) {
    ?>
        <div class="modal fade" id="editEmployeeModal<?php echo $row['id']; ?>" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Employee</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form action="update_employee.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                            <div class="mb-3">
                                <label class="form-label">Firstname</label>
                                <input type="text" name="firstname" class="form-control" value="<?php echo $row['firstname']; ?>" required>

                                <label class="form-label">Lastname</label>
                                <input type="text" name="lastname" class="form-control" value="<?php echo $row['lastname']; ?>" required>

                                <label class="form-label">Birthdate</label>
                                <input type="date" name="b_date" class="form-control" value="<?php echo $row['birth_date']; ?>" required>

                                <label class="form-label">Address</label>
                                <input type="text" name="address" class="form-control" value="<?php echo $row['address']; ?>" required>

                                <label class="form-label">Commission Percentage</label>
                                <input type="number" name="commission_percent" class="form-control" value="<?php echo intval($row['comm_percentage']); ?>" required>

                                <label class="form-label">Contact No.</label>
                                <input type="number" name="contact_no" class="form-control" value="<?php echo $row['contact_number']; ?>" required>

                                <label class="form-label">Date Started</label>
                                <input type="text" name="date_started" class="form-control" value="<?php echo $row['date_started']; ?>" disabled>
                            </div>
                            <div class="text-end">
                                <button type="submit" name="update_employee" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

    <?php include 'includes/footer.php'; ?>

    <script>
        $(document).ready(function() {
            $("#btnSearch").click(function() {
                var searchKey = $("#searchInput").val();
                $.ajax({
                    url: "search_employees.php",
                    method: "POST",
                    data: {
                        search: searchKey
                    },
                    success: function(response) {
                        $("#employeeTableBody").html(response);
                    }
                });
            });
        });
    </script>

</body>

</html>