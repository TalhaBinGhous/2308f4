<?php
include 'conn.php'; // Assuming this file includes your database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
          rel="stylesheet">

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

        .order-item {
            margin-bottom: 20px;
            border: 1px solid #ccc;
            padding: 15px;
            border-radius: 10px;
            background-color: #fff;
        }

        .order-item .item-details {
            margin-top: 10px;
        }

        .item-img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }

        @media (max-width: 575.98px) {
            .order-item {
                padding: 10px;
            }

            .item-details p {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
<!-- Included nav -->
<?php include 'nav.php'; ?>
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">
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
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                Addons
            </div>
            <!-- Nav Item - Pages Collapse Menu -->
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
                    <span>Lawyer Appointment</span></a>
            </li>
            <li class="nav-item">
                    <a class="nav-link" href="lawyerapp.php">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>Lawyers</span></a>
                </li>
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
        <hr class="sidebar-divider d-none d-md-block">
    </ul>
    <div class="container">
        <h2 class="text-center">Order Details</h2>

        <div class="row">
            <?php
            // Fetching orders with user and item details from database
            $sql = "SELECT o.oid, o.oname, o.oemail, o.ophone, u.username, oi.price, oi.subtotal, l.pname, c.cname, l.pimg
                    FROM ecomm_orders o
                    INNER JOIN ecomm_users u ON o.uid = u.uid
                    INNER JOIN ecomm_order_items oi ON o.oid = oi.oid
                    INNER JOIN ecomm_lawyers l ON oi.pid = l.pid
                    INNER JOIN ecomm_categories c ON l.pcategory = c.cid
                    ORDER BY o.oid DESC"; // Assuming you want to display latest orders first

            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <div class="col-lg-6 col-md-6 mb-4">
                        <div class="order-item">
                            <div class="row">
                                <div class="col-4">
                                    <img src="uploads/lawyers/<?php echo $row['pimg']; ?>" alt="<?php echo $row['pname']; ?>"
                                         class="img-fluid item-img">
                                </div>
                                <div class="col-8">
                                    <h4><?php echo $row['oname']; ?></h4>
                                    <p><strong>Username:</strong> <?php echo $row['username']; ?></p>
                                    <p><strong>Email:</strong> <?php echo $row['oemail']; ?></p>
                                    <p><strong>Phone:</strong> <?php echo $row['ophone']; ?></p>
                                    <div class="item-details">
                                        <p><strong>Category:</strong> <?php echo $row['cname']; ?></p>
                                        <p><strong>Lawyer Name:</strong> <?php echo $row['pname']; ?></p>
                                        <p><strong>Appointment Price:</strong> $<?php echo $row['price']; ?></p>
                                        <p><strong>Subtotal:</strong> $<?php echo $row['subtotal']; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo '<h3 class="text-center">No orders found.</h3>';
            }
            ?>
        </div>

    </div>
</div>
<!-- Bootstrap core JavaScript -->
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
