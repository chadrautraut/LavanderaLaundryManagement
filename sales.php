<?php
    include_once 'functions/authentication.php';
    include_once 'functions/authentication.php';

    // Load predicted sales data
    $predictedSales = [];
    if (($handle = fopen("predicted_sales.csv", "r")) !== FALSE) {
        fgetcsv($handle); // Skip the header
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $predictedSales[] = [
                'year' => $data[0],
                'month' => $data[1],
                'predicted_sales' => $data[2]
            ];
        }
        fclose($handle);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['train_model'])) {
        // Path to the train_model.py script
        $trainModelPath = "C:/xampp/htdocs/Lavandera-Laundry-Management-System-with-QRCode-Main/functions/views/train_model.py";
        
        // Execute the train_model.py script
        exec("python \"$trainModelPath\"", $output, $return_var);
        if ($return_var === 0) {
            echo "<script>alert('Model trained successfully!');</script>";
        } else {
            echo "<script>alert('Error training model: " . implode("\n", $output) . "');</script>";
        }
    }

    if (isset($_POST['predict_sales'])) {
        // Path to the predict_sales.py script
        $predictSalesPath = "C:/xampp/htdocs/Lavandera-Laundry-Management-System-with-QRCode-Main/functions/views/predict_sales.py";
        
        // Execute the predict_sales.py script
        exec("python \"$predictSalesPath\"", $output, $return_var);
        if ($return_var === 0) {
            echo "<script>alert('Sales predicted successfully!');</script>";
        } else {
            echo "<script>alert('Error predicting sales: " . implode("\n", $output) . "');</script>";
        }
        
        // Reload the page to show the prediction results
        header("Location: sales.php");
        exit();
    }
    
}



?>

<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Sales Report - Laundry Management System with QRCode</title>
    <link rel="shortcut icon" href="assets/img/lavandera.jpg" type="image/gif">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/bs-theme-overrides.css">
    <link rel="stylesheet" href="assets/css/dataTables.bootstrap5.min.css">
</head>

<body id="page-top">
    <div id="wrapper">
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion p-0 toggled" style="background: var(--bs-primary-text-emphasis);">
            <div class="container-fluid d-flex flex-column p-0"><a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="index.php">
                    <div class="sidebar-brand-icon rotate-n-15"><img class="rounded-circle" src="assets/img/lavandera.jpg" width="60" height="60"></div>
                    <div class="sidebar-brand-text mx-3"><span><br><br>Lavandera<br>Laundry<br>Mangement<br>System</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <?php
                        include_once 'functions/views/navbar.php';
                    ?>
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <ul class="navbar-nav flex-nowrap ms-auto">
                            
                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span class="d-none d-lg-inline me-2 text-gray-600 small">My Account</span><i class="far fa-user"></i></a>
                                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"><a class="dropdown-item" href="profile.php"><i class="fas fa-cogs fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Settings</a><a class="dropdown-item <?php if($_SESSION['level'] == '1'){echo 'd-none';}?>" href="logs.php"><i class="fas fa-list fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Activity log</a>
                                        <div class="dropdown-divider"></div><a class="dropdown-item" href="functions/logout.php"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Sales Report</h3>
                    <div class="card shadow">

                    

                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">Transactions</p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table mt-2" id="mytable" role="grid" aria-describedby="dataTable_info">
                                <table class="table table-striped my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>Invoice</th>
                                            <th>Customer</th>
                                            <th>User</th>
                                            <th>Total</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            include_once 'functions/views/sales.php'
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr></tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span></span></div>
                </div>
            </footer>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>

    <?php
        include_once 'functions/modals/transaction-modal.php';
    ?>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap5.min.js"></script>
    <script src="assets/js/dataTables.buttons.min.js"></script>
    <script src="assets/js/jszip.min.js"></script>
    <script src="assets/js/pdfmake.min.js"></script>
    <script src="assets/js/vfs_fonts.js"></script>
    <script src="assets/js/buttons.html5.min.js"></script>
    <script src="assets/js/buttons.print.min.js"></script>
    <script src="assets/js/theme.js"></script>
    <script src="assets/js/jquery.min.js"></script>
<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/dataTables.bootstrap5.min.js"></script>
<script src="assets/js/dataTables.buttons.min.js"></script>
<script src="assets/js/jszip.min.js"></script>
<script src="assets/js/pdfmake.min.js"></script>
<script src="assets/js/vfs_fonts.js"></script>
<script src="assets/js/buttons.html5.min.js"></script>
<script src="assets/js/buttons.print.min.js"></script>
    <script src="assets/js/sweetalert.min.js"></script>
    <script>
        const urlParams = new URLSearchParams(window.location.search);
        const type = urlParams.get('type');
        const message = urlParams.get('message');
        if (type == 'success') {
            swal("Success!", message, "success");
        } else if (type == 'error') {
            swal("Error!", message, "error");
        }
        $(document).ready(function() {
            $('#dataTable').DataTable( {
                dom: 'Blfrtip',
                aaSorting: [[0, 'desc']],
                buttons: [
                    { extend: 'excel', className: 'btn btn-primary' },
                    { extend: 'pdf', className: 'btn btn-primary' },
                    { extend: 'print', className: 'btn btn-primary' }
                ]
            } );    
        } );
    </script>
</body>

</html>

<?php
    include_once 'functions/authentication.php';

    // Load predicted sales data
    $predictedSales = [];
    if (($handle = fopen("predicted_sales.csv", "r")) !== FALSE) {
        fgetcsv($handle); // Skip the header
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $predictedSales[] = [
                'year' => $data[0],
                'month' => $data[1],
                'predicted_sales' => $data[2]
            ];
        }
        fclose($handle);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['train_model'])) {
        // Path to the train_model.py script
        $trainModelPath = "C:/xampp/htdocs/Lavandera-Laundry-Management-System-with-QRCode-Main/functions/views/train_model.py";
        
        // Execute the train_model.py script
        exec("python \"$trainModelPath\"", $output, $return_var);
        if ($return_var === 0) {
            echo "<script>alert('Model trained successfully!');</script>";
        } else {
            echo "<script>alert('Error training model: " . implode("\n", $output) . "');</script>";
        }
    }

    if (isset($_POST['predict_sales'])) {
        // Path to the predict_sales.py script
        $predictSalesPath = "C:/xampp/htdocs/Lavandera-Laundry-Management-System-with-QRCode-Main/functions/views/predict_sales.py";
        
        // Execute the predict_sales.py script
        exec("python \"$predictSalesPath\"", $output, $return_var);
        if ($return_var === 0) {
            echo "<script>alert('Sales predicted successfully!');</script>";
        } else {
            echo "<script>alert('Error predicting sales: " . implode("\n", $output) . "');</script>";
        }
        
        // Reload the page to show the prediction results
        header("Location: sales.php");
        exit();
    }
}

?>



<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Sales Report - Laundry Management System with QRCode</title>
    <link rel="shortcut icon" href="assets/img/lavandera.jpg" type="image/gif">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/bs-theme-overrides.css">
    <link rel="stylesheet" href="assets/css/dataTables.bootstrap5.min.css">
</head>

<body id="page-top">
    <div id="wrapper">
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion p-0 toggled" style="background: var(--bs-primary-text-emphasis);">
            <div class="container-fluid d-flex flex-column p-0"><a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="index.php">
                    <div class="sidebar-brand-icon rotate-n-15"><img class="rounded-circle" src="assets/img/lavandera.jpg" width="60" height="60"></div>
                    <div class="sidebar-brand-text mx-3"><span><br><br>Lavandera<br>Laundry<br>Mangement<br>System</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <?php
                        include_once 'functions/views/navbar.php';
                    ?>
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <ul class="navbar-nav flex-nowrap ms-auto">
                            
                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span class="d-none d-lg-inline me-2 text-gray-600 small">My Account</span><i class="far fa-user"></i></a>
                                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"><a class="dropdown-item" href="profile.php"><i class="fas fa-cogs fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Settings</a><a class="dropdown-item <?php if($_SESSION['level'] == '1'){echo 'd-none';}?>" href="logs.php"><i class="fas fa-list fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Activity log</a>
                                        <div class="dropdown-divider"></div><a class="dropdown-item" href="functions/logout.php"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="container-fluid">
                <div class="container-fluid">
    <h3 class="text-dark mb-4">Sales Report</h3>
    <div class="card shadow">
        <div class="card-header py-3">
            <p class="text-primary m-0 fw-bold">Actions</p>
        </div>
        <div class="card-body">
            <form method="post">
                <button type="submit" name="train_model" class="btn btn-primary">Train Model</button>
                <button type="submit" name="predict_sales" class="btn btn-primary">Predict Sales</button>
            </form>
        </div>
    </div>
</div>

                    <h3 class="text-dark mb-4">Predicted Sales Report for the Next following Month</h3>
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">Predicted</p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table mt-2" id="mytable" role="grid" aria-describedby="dataTable_info">
                                <table class="table table-striped my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>Invoice</th>
                                            
                                            <th>Year</th>
                                            <th>Month</th>
                                            <th>Predicted Sales</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($predictedSales as $sale): ?>
                                            <tr>
                                                <td><?php echo "Invoice-" . $sale['year'] . "-" . str_pad($sale['month'], 2, '0', STR_PAD_LEFT); ?></td>
                                                <td><?php echo $sale['year']; ?></td>
                                                <td><?php echo date("F", mktime(0, 0, 0, $sale['month'], 1)); ?></td>
                                                <td><?php echo number_format((float)$sale['predicted_sales'], 2, '.', ''); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                        <?php
                                            include_once 'functions/views/sales.php'
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr></tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span></span></div>
                </div>
            </footer>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>

    <?php
        include_once 'functions/modals/transaction-modal.php';
    ?>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap5.min.js"></script>
    <script src="assets/js/dataTables.buttons.min.js"></script>
    <script src="assets/js/jszip.min.js"></script>
    <script src="assets/js/pdfmake.min.js"></script>
    <script src="assets/js/vfs_fonts.js"></script>
    <script src="assets/js/buttons.html5.min.js"></script>
    <script src="assets/js/buttons.print.min.js"></script>
    <script src="assets/js/theme.js"></script>
    <script src="assets/js/sweetalert.min.js"></script>
    <script>
        const urlParams = new URLSearchParams(window.location.search);
        const type = urlParams.get('type');
        const message = urlParams.get('message');
        if (type == 'success') {
            swal("Success!", message, "success");
        } else if (type == 'error') {
            swal("Error!", message, "error");
        }
        $(document).ready(function() {
            $('#dataTable').DataTable( {
                dom: 'Blfrtip',
                aaSorting: [[0, 'desc']],
                buttons: [
                    { extend: 'excel', className: 'btn btn-primary' },
                    { extend: 'pdf', className: 'btn btn-primary' },
                    { extend: 'print', className: 'btn btn-primary' }
                ]
            } );
            
            
        } );
    </script>
</body>

</html>

<?php
include_once 'functions/authentication.php';
include_once 'functions/connection.php'; // Include your database connection

// Load predicted sales data
$predictedSales = [];
if (($handle = fopen("predicted_sales.csv", "r")) !== FALSE) {
    fgetcsv($handle); // Skip the header
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $predictedSales[] = [
            'year' => $data[0],
            'month' => $data[1],
            'predicted_sales' => $data[2]
        ];
    }
    fclose($handle);
}

function generateMonthlySalesCSV($db) {
    // Prepare the SQL query to get total sales per month
    $query = "
        SELECT 
            DATE_FORMAT(created_at, '%Y-%m-01') AS sale_date, 
            SUM(total) AS total_sales 
        FROM 
            transactions 
        GROUP BY 
            YEAR(created_at), MONTH(created_at)
        ORDER BY 
            sale_date
    ";

    // Execute the query
    $stmt = $db->prepare($query);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Open a file in write mode
    $file = fopen('monthly_sales.csv', 'w');

    // Write the header row
    fputcsv($file, ['date', 'total_sales']);

    // Write the data rows
    foreach ($results as $row) {
        fputcsv($file, [
            $row['sale_date'],
            number_format((float)$row['total_sales'], 2, '.', '')
        ]);
    }

    // Close the file
    fclose($file);
}

// Call the function to generate the monthly sales CSV
generateMonthlySalesCSV($db);
?>

<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Sales Report - Laundry Management System with QRCode</title>
    <link rel="shortcut icon" href="assets/img/lavandera.jpg" type="image/gif">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/bs-theme-overrides.css">
    <link rel="stylesheet" href="assets/css/dataTables.bootstrap5.min.css">
</head>

<body id="page-top">
    <div id="wrapper">
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion p-0 toggled" style="background: var(--bs-primary-text-emphasis);">
            <div class="container-fluid d-flex flex-column p-0"><a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="index.php">
                    <div class="sidebar-brand-icon rotate-n-15"><img class="rounded-circle" src="assets/img/lavandera.jpg" width="60" height="60"></div>
                    <div class="sidebar-brand-text mx-3"><span><br><br>Lavandera<br>Laundry<br>Management<br>System</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <?php
                        include_once 'functions/views/navbar.php';
                    ?>
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <h 4 class="text-gray-900">Sales Report</h4>
                        <ul class="navbar-nav flex-nowrap ms-auto">
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="d-none d-lg-inline me-2 text-gray-600 small">User  </span>
                                    <img class="border rounded-circle img-profile" src="assets/img/undraw_profile.svg">
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end shadow animated--grow-in">
                                    <li><a class="dropdown-item" href="#">Profile</a></li>
                                    <li><a class="dropdown-item" href="#">Settings</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="#">Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Total Monthly Sales Report</h3>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Total Sales Data</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Total Sales</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Read the monthly_sales.csv file and display the data
                                        if (($handle = fopen("monthly_sales.csv", "r")) !== FALSE) {
                                            fgetcsv($handle); // Skip the header
                                            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                                                echo "<tr>";
                                                echo "<td>{$data[0]}</td>";
                                                echo "<td>{$data[1]}</td>";
                                                echo "</tr>";
                                            }
                                            fclose($handle);
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span></span></div>
                </div>
            </footer>
        </div>
    </div>
    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/datatables.min.js"></script>
    <script src="assets/js/scripts.js"></script>
</body>

</html>