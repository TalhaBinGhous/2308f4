<?php
include 'conn.php'; // Assuming this file includes your database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Details</title>
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f8f9fc;
        }
        .container {
            margin-top: 50px;
        }
        h2 {
            margin-bottom: 20px;
        }
        .contact-item {
            margin-bottom: 20px;
            border: 1px solid #ccc;
            padding: 15px;
            border-radius: 5px;
            background-color: #fff;
        }
        .contact-item .item-details {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <!-- Included nav -->
    <?php include 'nav.php'; ?>
    <div id="wrapper">

<!-- Sidebar -->
<ul  class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <!-- <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
    </a> -->

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <?php
        if (isset($_SESSION['name'])) {
        ?>
    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Addons
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="admin_add_category.php">
        <i class="fas fa-fw fa-folder"></i>
            <span>Add Lawyers Categories</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="addLawyer.php">
        <i class="fas fa-fw fa-folder"></i>
            <span>Add Lawyers</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="contact.php">
        <i class="fas fa-fw fa-folder"></i>
            <span>Contact details</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="Lawerapp.php">
        <i class="fas fa-fw fa-folder"></i>
            <span>Lawyer Appointement</span></a>
    </li>
    <li class="nav-item">
                    <a class="nav-link" href="lawyerapp.php">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>Lawyers</span></a>
                </li>
    <!-- Nav Item - Tables -->
    
    <li class="nav-item">
        <a class="nav-link" href="../index.php">
        <i class="fas fa-fw fa-folder"></i>
            <span>Go To Website</span></a>
    </li>
    <?php
        } else {
        ?>
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="login.php">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Login First</div>
    </a>
        <?php
        }
        ?>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
</ul>
    <div class="container">
        <h2 class="text-center">Contact Details</h2>

        <?php
        // Fetching contact details from database
        $sql = "SELECT * FROM contact";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
                <div class="contact-item">
                    <h4><?php echo $row['name']; ?></h4>
                    <p><strong>Email:</strong> <?php echo $row['email']; ?></p>
                    <p><strong>Subject:</strong> <?php echo $row['sub']; ?></p>
                    <p><strong>Message:</strong> <?php echo $row['msg']; ?></p>
                </div>
        <?php
            }
        } else {
            echo '<h3 class="text-center">No contact details found.</h3>';
        }
        ?>

    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
</body>
</html>
