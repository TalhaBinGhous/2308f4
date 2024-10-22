<?php
session_start();
include 'auth.php'; // Ensure this file sets $_SESSION['uid']
include 'database.php';

// Check if $_SESSION['uid'] is set
if (!isset($_SESSION['uid'])) {
    // Redirect to login page or handle unauthorized access
    header("Location: signin.php");
    exit();
}

$uid = $_SESSION['uid'];

// Check if delete action is triggered
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['pid'])) {
    $pid_to_delete = $_GET['pid'];
    
    // Perform deletion from cart using prepared statement
    $delete_sql = "DELETE FROM ecomm_cart WHERE uid = ? AND pid = ?";
    $stmt_delete = $conn->prepare($delete_sql);
    $stmt_delete->bind_param("ii", $uid, $pid_to_delete);
    
    if (!$stmt_delete->execute()) {
        die('Error deleting product from cart: ' . $stmt_delete->error);
    }

    $stmt_delete->close();
}

// Select products from cart and join with lawyers table
$sql = "SELECT * FROM ecomm_lawyers INNER JOIN ecomm_cart ON ecomm_lawyers.pid = ecomm_cart.pid WHERE ecomm_cart.uid = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $uid);
$stmt->execute();
$result = $stmt->get_result();

if (!$result) {
    die('Error executing query: ' . $stmt->error);
}

$row_count = $result->num_rows;
$totalprice = 0;
?>

<!DOCTYPE html>
<html lang="en">
    <title>Appointement</title>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700,700i,900,900i&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/ionicons.min.css">
    
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        
        table {
            width: 100%;
            margin: 20px 0;
        }
        #checkoutBtn {
            display: block;
            margin: 20px auto;
        }
        .table-responsive {
            margin: 20px 0;
        }
        .card {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <?php include 'nav.php'; ?>

    <section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_1.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-end justify-content-center">
          <div class="col-md-9 ftco-animate pb-5 text-center">
            <h1 class="mb-3 bread">Appointment</h1>
            <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Appointement <i class="ion-ios-arrow-forward"></i></span></p>
          </div>
        </div>
      </div>
    </section>
    <div class="container">
        <?php if ($row_count > 0) { ?>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>Lawyer</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Sub Total</th>
                            <th>Action</th> <!-- New column for delete button -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()) {
                            $totalprice += $row['subtotal'];
                        ?>
                            <tr>
                                <td><img src="<?php echo 'Dashboard/uploads/lawyers/' . $row['pimg']; ?>" alt="" height="100px" /></td>
                                <td><?php echo $row['pname']; ?></td>
                                <td>Rs. <?php echo $row['pprice']; ?></td>
                                <td>Rs. <?php echo $row['subtotal']; ?></td>
                                <td>
                                    <a href="cart.php?action=delete&pid=<?php echo $row['pid']; ?>" class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <div class="card">
                <div class="card-body text-center">
                    <h3>Total Price: Rs. <?php echo $totalprice; ?></h3>
                    <a href="checkout.php" class="btn btn-primary">Proceed for Appointement</a>
                </div>
            </div>
        <?php } else { ?>
            <h3 class="text-center">No Any Lawyer for Appointment</h3>
        <?php } ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
 <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>