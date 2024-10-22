<?php
if(isset($_POST['btn'])){
    include('database.php');
    $name = $_POST['name'];
    $email = $_POST['email'];
    $sub = $_POST['sub'];
    $msg = $_POST['msg'];

    $sql = "INSERT INTO `contact`(`name`, `email`, `sub`, `msg`) VALUES ('$name','$email','$sub','$msg')";
    $result = mysqli_query($conn, $sql);
    if($result){
        mysqli_close($conn);
        // Redirect to index.php after form submission
        echo '<script>window.location = "contact.php";</script>';
        exit(); // Ensure no further code execution after redirection
    } else {
        echo "<script>alert('Not Submitted');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Contact</title>
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

    <script>
        // JavaScript to prevent form resubmission on refresh
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</head>
<body>
<?php include "nav.php"?>
<!-- END nav -->

<section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_1.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text align-items-end justify-content-center">
            <div class="col-md-9 ftco-animate pb-5 text-center">
                <h1 class="mb-3 bread">Contact us</h1>
                <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Contact <i class="ion-ios-arrow-forward"></i></span></p>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section contact-section">
    <div class="container">
        <div class="row d-flex mb-5 contact-info">
            <div class="col-md-12 mb-4">
                <h2 class="h3">Contact Information</h2>
            </div>
            <div class="w-100"></div>
            <div class="col-md-3">
                <p><span class="text-success">Address:</span> Block 80, Building 06, North Karachi, Karachi, Pakistan</p>
            </div>
            <div class="col-md-3">
                <p><span class="text-success">Phone:</span> <a href="tel://+92 318 0112631">+92 318 0112631</a></p>
            </div>
            <div class="col-md-3">
                <p><span class="text-success">Email:</span> <a href="mailto:umohi4613@gmail.com">umohi4613@gmail.com</a></p>
            </div>
            <div class="col-md-3">
                <p><span class="text-success">Website</span> <a href="index.php">Juctisehub.com</a></p>
            </div>
        </div>
        <div class="row block-9">
            <div class="col-lg-6 order-md-last d-flex">
                <form action="#" class="bg-light p-5 contact-form" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" name="name" placeholder="Your Name">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="email" placeholder="Your Email">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="sub" placeholder="Subject">
                    </div>
                    <div class="form-group">
                        <textarea name="msg" id="" cols="30" rows="7" class="form-control" placeholder="Message"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Submit" name="btn" class="btn btn-primary py-3 px-5">
                    </div>
                </form>
            </div>
            <div class="col-lg-6 d-flex">
                <div id="map" class="bg-white">
                    <!-- Updated Google Maps iframe with Karachi location -->
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3621.481786789566!2d67.0123572105615!3d24.81319234705616!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3eb33d9a723eb46b%3A0xb6021750d515bfde!2sLawyers%20Club!5e0!3m2!1sen!2s!4v1721079541766!5m2!1sen!2s" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div> 
    </div>
</section>

<?php include "footer.php"?>
<!-- loader -->
<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>

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
<script src="js/google-map.js"></script>
<script src="js/main.js"></script>

</body>
</html>
