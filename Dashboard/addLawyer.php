<?php
include 'conn.php';

$sql_select = "SELECT * FROM ecomm_categories";
$categories = mysqli_query($conn, $sql_select);

if (isset($_POST['addLawyer'])) {
    $pname = $_POST['pname'];
    $pprice = $_POST['pprice'];
    $pdes = $_POST['pdes'];
    $pimg = $_FILES['pimg']['name'];
    $pcategory = $_POST['pcategory'];
    $target_dir = "uploads/lawyers/";

    // Check if the directory exists, if not create it
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $target_file = $target_dir . basename($_FILES["pimg"]["name"]);

    // Move uploaded file
    if (move_uploaded_file($_FILES["pimg"]["tmp_name"], $target_file)) {
        $sql = "INSERT INTO ecomm_lawyers (pname, pprice, pimg, pdes, pcategory) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("sssss", $pname, $pprice, $pimg, $pdes, $pcategory);
            $stmt->execute();
            $stmt->close();
            header('Location: lawyerapp.php');
        } else {
            echo "Error preparing statement: " . $conn->error;
        }
    } else {
        echo "Error uploading file.";
    }
}
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
    
    <title>Add Lawyer</title>

    <style>
        h1 {
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

        input[type="text"], input[type="file"], select, textarea {
            width: 100%;
            padding: 10px;
            margin: 5px 0 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"], .btn-success {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: green;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover, .btn-success:hover {
            background-color: darkgreen;
        }

        .container {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }
    </style>
</head>
<body>
    <!-- Include navigation bar -->
    <?php include 'nav.php'; ?>

    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <?php if (isset($_SESSION['name'])) { ?>
                <!-- Nav Item - Dashboard -->
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <!-- Divider -->
                <hr class="sidebar-divider">
                <!-- Heading -->
                <div class="sidebar-heading">Addons</div>
                <!-- Nav Item - Pages Collapse Menu -->
                <!-- Nav Item - Charts -->
                <li class="nav-item">
                    <a class="nav-link" href="admin_add_category.php">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>Add Lawyers Categories</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="addLawyer.php">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>Add Lawyers</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>Contact details</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Lawerapp.php">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>Lawyer Appointement</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="lawyerapp.php">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>Lawyers</span>
                    </a>
                </li>
                <!-- Nav Item - Tables -->
                <li class="nav-item">
                    <a class="nav-link" href="../index.php">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>Go To Website</span>
                    </a>
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
            <div class="content">
                <h2 class="text-center py-3">Add New Lawyer</h2>
                <form method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="pname" class="form-label">Lawyer Name</label>
                        <input type="text" class="form-control" id="pname" name="pname" required>
                    </div>
                    <div class="mb-3">
                        <label for="pprice" class="form-label">Price</label>
                        <input type="text" class="form-control" id="pprice" name="pprice" required>
                    </div>
                    <div class="mb-3">
                        <label for="pdes" class="form-label">Description</label>
                        <textarea class="form-control" id="pdes" name="pdes" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="pimg" class="form-label">Lawyer Image</label>
                        <input type="file" class="form-control" id="pimg" name="pimg" required>
                    </div>
                    <div class="mb-3">
                        <label for="pcategory" class="form-label">Category</label>
                        <select class="form-control" id="pcategory" name="pcategory" required>
                            <?php
                            while ($row = mysqli_fetch_assoc($categories)) {
                                echo "<option value='" . $row['cid'] . "'>" . $row['cname'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success" name="addLawyer">Add Lawyer</button>
                </form>
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
