<?php
include 'database.php';
include 'auth.php';
$cid = $_GET['cid'];
$sql_select = "SELECT * FROM ecomm_lawyers WHERE pcategory = $cid";
$lawyers = mysqli_query($conn, $sql_select);


if (isset($_POST['addToCart'])) {
    include 'auth.php';

    $uid = $_SESSION['uid'];
    $pid = $_POST['pid'];
    $price = $_POST['price'];
   

    $subtotal = $price ;

    $sql_insert = "INSERT INTO `ecomm_cart` (`pid`, `uid`, `price`,  `subtotal`) VALUES ('$pid', '$uid', '$price',  '$subtotal')";

    $result = mysqli_query($conn, $sql_insert);

    header('location: cart.php');
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Lawyers</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
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
    .card {
        margin-bottom: 10%;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
        height: 100%; /* Ensure card takes full height */
        display: flex;
        flex-direction: column;
        padding-top: 15px; /* Add padding at the top */
        padding-bottom: 15px; /* Add padding at the bottom */
    }
    .card:hover {
        transform: scale(1.05);
    }
    .card-img-top {
        width: 100%;
        height: 300px; /* Set a fixed height for the images */
        object-fit: cover; /* Ensure the image covers the area without distortion */
    }
    .card-body {
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    .card-text {
        flex-grow: 1;
    }
    .price {
        margin-top: auto;
    }
    .card-body form {
        margin-top: 10px; /* Add a small margin to separate the price and the button */
    }
    @media (max-width: 767.98px) { /* Adjust for mobile view */
        .col-md-4 {
            flex: 0 0 100%;
            max-width: 100%;
            margin-bottom: 20px;
        }
    }
</style>

  </head>
  <body>
    
    <?php include "nav.php" ?>
    <!-- END nav -->
    
    <section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_1.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-end justify-content-center">
          <div class="col-md-9 ftco-animate pb-5 text-center">
            <h1 class="mb3 bread">Lawyers</h1>
            <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Lawyers <i class="ion-ios-arrow-forward"></i></span></p>
          </div>
        </div>
      </div>
    </section>
    
    <div class="container mt-5">
      <div class="row justify-content-center">
        <?php
          while ($row = mysqli_fetch_assoc($lawyers)) {
        ?>
          <div class="col-md-4">
            <div class="card">
              <img src="<?php echo 'Dashboard/uploads/lawyers/' . $row['pimg'] ?>" class="card-img-top" alt="<?php echo $row['pname'] ?>">
              <div class="card-body">
                <h5 class="card-title"><?php echo $row['pname'] ?></h5>
                <p class="card-text"><b>Description:</b> <?php echo $row['pdes'] ?></p>
                <p class="card-text price"><strong>Price: <?php echo $row['pprice'] ?></strong></p>
                <form method="post">
                  <input type="hidden" name="pid" value="<?php echo $row['pid'] ?>">
                  <input type="hidden" name="price" value="<?php echo $row['pprice'] ?>">
                  <br>
                  <input type="submit" class="btn btn-dark w-100" name="addToCart" value="Add Appointment">
                </form>
              </div>
            </div>
          </div>
        <?php
          }
        ?>
      </div>
    </div>
    
    <?php include "footer.php" ?> 
    
    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen">
      <svg class="circular" width="48px" height="48px">
        <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/>
        <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/>
      </svg>
    </div>

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
    
  </body>
</html>



