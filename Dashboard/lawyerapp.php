<?php
include 'conn.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <title>Lawyers</title>
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f8f9fc;
            margin: 0;
            padding: 0;
        }

        h3 {
            text-align: center;
            margin-top: 20px;
        }

        table {
            width: 100%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        img {
            width: 100%;
            height: auto;
        }

        .actions {
            display: flex;
            gap: 10px;
        }

        .actions a {
            color: #4e73df;
            text-decoration: none;
        }

        .actions a:hover {
            text-decoration: underline;
        }

        @media (min-width: 768px) {
            table {
                width: 70%;
                margin: 20px auto;
            }

            img {
                width: 150px;
                height: 150px;
            }
        }

        @media (min-width: 1024px) {
            table {
                width: 50%;
                margin: 20px auto;
            }

            img {
                width: 200px;
                height: 200px;
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

            <!-- Sidebar - Brand -->
            <hr class="sidebar-divider my-0">
            <?php if (isset($_SESSION['name'])) { ?>
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

                <!-- Nav Item - Tables -->
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
            <?php } else { ?>
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="login.php">
                    <div class="sidebar-brand-icon rotate-n-15">
                        <i class="fas fa-laugh-wink"></i>
                    </div>
                    <div class="sidebar-brand-text mx-3">Login First</div>
                </a>
            <?php } ?>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
        </ul>
        <!-- End of Sidebar -->
        
        <div id="content-wrapper" class="d-flex flex-column">
            <h3 class="text-center mt-3 mb-4">Lawyers</h3>

            <?php
            $sql = "SELECT * FROM ecomm_lawyers INNER JOIN ecomm_categories ON ecomm_lawyers.pcategory = ecomm_categories.cid";
            $result = mysqli_query($conn, $sql);

            $row_count = mysqli_num_rows($result);

            if ($row_count > 0) {
            ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>Lawyers Name</th>
                                <th>Lawyers Price</th>
                                <th>Lawyers Category</th>
                                <th>Lawyers Description</th>
                                <th>Lawyers Image</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <td><?php echo $row['pname']; ?></td>
                                    <td><?php echo $row['pprice']; ?></td>
                                    <td><?php echo $row['cname']; ?></td>
                                    <td><?php echo $row['pdes']; ?></td>
                                    <td>
                                        <img src="uploads/lawyers/<?php echo $row['pimg']; ?>" alt="<?php echo $row['pname']; ?>" class="img-fluid">
                                    </td>
                                    <td class="actions">
                                        <a href="edit.php?pid=<?php echo $row['pid']; ?>" class="btn btn-success btn-sm text-light">Edit</a>
                                        <a href="delete.php?pid=<?php echo $row['pid']; ?>" onclick="return confirm('Are you sure you want to delete this lawyer?')" class="btn btn-danger text-light btn-link btn-sm">Delete</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            <?php } else { ?>
                <h3 class="text-center mt-5">No Records</h3>
            <?php } ?>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
</body>
</html>
