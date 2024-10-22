<?php
include 'conn.php';

if (isset($_POST['addCat'])) {
    $cname = $_POST['cname'];
    $cimg = $_FILES['cimg']['name'];
    $target_dir = "uploads/categories/";

    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $target_file = $target_dir . basename($_FILES["cimg"]["name"]);

    // Check for duplicate category name
    $check_duplicate = "SELECT * FROM ecomm_categories WHERE cname = '$cname'";
    $result = mysqli_query($conn, $check_duplicate);

    if (mysqli_num_rows($result) > 0) {
        echo "Category name already exists. Please choose a different name.";
    } else {
        // Move uploaded file
        if (move_uploaded_file($_FILES["cimg"]["tmp_name"], $target_file)) {
            $sql = "INSERT INTO ecomm_categories (cname, cimg) VALUES ('$cname', '$cimg')";
            $result = mysqli_query($conn, $sql) or die('Fail to insert category: ' . mysqli_error($conn));

            header('Location: addLawyer.php');
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <title>Categories</title>
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

        form {
            width: 90%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin: 10px 0 5px;
        }

        input[type="text"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            color: #fff;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: green;
        }

        table {
            width: 90%;
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

        @media (min-width: 768px) {
            form, table {
                width: 70%;
            }
        }

        @media (min-width: 1024px) {
            form, table {
                width: 50%;
            }
        }
    </style>
</head>
<body>
    <?php include 'nav.php'; ?>
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <!-- <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
            </a> -->

            <!-- Divider -->
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
                        <span>Lawyer Appointment</span></a>
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
            <h3>Add Category</h3>
            <form method="post" enctype="multipart/form-data">
                <label for="cname">
                    Category Name:
                    <input type="text" name="cname" required>
                </label>
                <div class="mb-3">
                    <label for="cimg" class="form-label">Category Image</label>
                    <input type="file" class="form-control" id="cimg" name="cimg" required>
                </div>
                <input type="submit" name="addCat" value="Add Category" class="btn btn-success">
            </form>

            <h3>View Categories</h3>
            <?php
            $sql = "SELECT * FROM `ecomm_categories`";
            $result = mysqli_query($conn, $sql);
            if (!$result) {
                die('Error executing query: ' . mysqli_error($conn));
            }
            $row_count = mysqli_num_rows($result);

            if ($row_count > 0) {
                ?>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Category Name</th>
                    </tr>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo $row['cid']; ?></td>
                            <td><?php echo $row['cname']; ?></td>
                        </tr>
                    <?php } ?>
                </table>
                <?php
            } else {
                echo '<h3>No Records</h3>';
            }
            ?>
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
    </div>
</body>
</html>
