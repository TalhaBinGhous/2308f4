<?php
// Include your database configuration file
include 'conn.php';

// Function to get the total number of users
function getUserCount($conn) {
    $query = "SELECT COUNT(*) as user_count FROM user";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['user_count'];
}

function getEcomUserCount($conn) {
    $query = "SELECT COUNT(*) as user_count FROM ecomm_users";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['user_count'];
}

// Function to get the total number of orders
function getOrderCount($conn) {
    $query = "SELECT COUNT(*) as order_count FROM ecomm_orders";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['order_count'];
}

// Function to get the total number of contacts
function getContactCount($conn) {
    $query = "SELECT COUNT(*) as contact_count FROM contact";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['contact_count'];
}

// Get the user count
$user_count = getUserCount($conn);

$ecomusercount = getEcomUserCount($conn);
// Get the order count
$order_count = getOrderCount($conn);
// Get the contact count
$contact_count = getContactCount($conn);
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
<style></style>
</head>

<body id="page-top">
<?php include 'nav.php';
                        ?>
    <!-- Page Wrapper -->
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
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

               

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800 py-5"><strong>Dashboard</strong></h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Admin Users</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $user_count; ?>
                        <i class="fas fa-calendar fa-2x text-gray-300"></i></div>
                    </div>
                    <div class="col-auto">
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
 <!-- Total Orders Card Example -->
 <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                        Total Appointement</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $order_count; ?>
                    <i class="fas fa-shopping-cart fa-2x text-gray-300"></i></div>
                </div>
                </div>
                
            </div>
        </div>
    </div>
 <!-- Daily User Login Card Example -->
 <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        Daily User Login</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $ecomusercount; ?>
                    <i class="fas fa-calendar fa-2x text-gray-300"></i></div>
                </div>
            </div>
                
            </div>
        </div>
    </div>

                        <!-- Daily User Login Card Example -->
 <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        Contacts</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $contact_count; ?>
                    <i class="fas fa-calendar fa-2x text-gray-300"></i></div>
                </div>
            </div>
                
            </div>
        </div>
    </div>

                    <!-- Content Row -->

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                    <h4 class=" font-weight-bold text-success text-center">Some Introduction about our Dashboard</h4>
                                    <p class="text-center">Navigate through insightful analytics, stay updated with industry news, and connect with a vibrant community of fellow professionals. Whether you're managing audits, analyzing financial data, or staying compliant with regulatory changes, Justicehub equips you with the tools to excel in your field.</p>
                                    <p class="text-center">
                                    Explore our comprehensive dashboard, access exclusive content, and elevate your ACCA experience with Justicehub. Join today and discover how we empower ACCA professionals like you to thrive in a dynamic and evolving financial landscape.
                                    </p>
                                    <p class="text-center">Join the Justicehub community today and experience a new era of efficiency and empowerment in your ACCA career. Together, let's chart a course towards excellence and achievement.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pie Chart -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-success text-center">About Us</h6>
                                
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <p class="text-center">Welcome to JusticeHub, your premier platform for ACCA members and affiliates. Designed to streamline your professional journey, Justicehub offers intuitive tools and resources tailored to your needs as a chartered certified accountant.</p>
                                    <p class="text-center">Join thousands of ACCA professionals who rely on Justicehub for insightful analytics, expert guidance, and collaborative solutions.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                   

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; JusticeHub 2024</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

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