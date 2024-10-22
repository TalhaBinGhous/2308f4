<?php
include 'database.php';

if(isset($_POST['register'])) {
    if($_POST['pass'] != $_POST['cpass']) {
        echo "Confirm password does not match";
    } else {
        $uname = $_POST['uname'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $pass = $_POST['pass'];

        // Check for duplicate username or email
        $check_duplicate = "SELECT * FROM ecomm_users WHERE username = '$uname' OR email = '$email'";
        $result = mysqli_query($conn, $check_duplicate);

        if(mysqli_num_rows($result) > 0) {
            echo "Username or email already exists. Please choose a different username or email.";
        } else {
            // Handle profile picture upload
            $profile_pic = '';
            if ($_FILES['profile_pic']['error'] == 0) {
                $target_dir = "Dashboard/uploads/webuserpic/";
                $target_file = $target_dir . basename($_FILES["profile_pic"]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                // Check if image file is a valid image
                $check = getimagesize($_FILES["profile_pic"]["tmp_name"]);
                if ($check !== false) {
                    $uploadOk = 1;
                } else {
                    echo "File is not an image.";
                    $uploadOk = 0;
                }

                // Check file size
                if ($_FILES["profile_pic"]["size"] > 500000) {
                    echo "Sorry, your file is too large.";
                    $uploadOk = 0;
                }

                // Allow certain file formats
                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif") {
                    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                }

                // If everything is ok, try to upload file
                if ($uploadOk == 1) {
                    if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file)) {
                        $profile_pic = $target_file;
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                }
            }

            // Insert into database if there are no errors
            if (!empty($uname) && !empty($fname) && !empty($lname) && !empty($email) && !empty($pass)) {
                $sql = "INSERT INTO ecomm_users (username, firstname, lastname, email, pass, img) 
                        VALUES ('$uname', '$fname', '$lname', '$email', '$pass', '$profile_pic')";
                
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    header('location: signin.php');
                    exit();
                } else {
                    echo "Error: " . mysqli_error($conn);
                }
            } else {
                echo "Please fill all required fields.";
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>signup</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet"> 
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sign Up Start -->
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <a href="index.html" class="">
                                <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>Juctisehub</h3>
                            </a>
                            <h3>Sign Up</h3>
                        </div>
                        <form method="post" enctype="multipart/form-data">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="uname" id="floatingText" placeholder="Username">
                            <label for="floatingText">Username</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="fname" id="floatingText" placeholder="First name">
                            <label for="floatingText">First Name:</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="lname" id="floatingText" placeholder="Last name">
                            <label for="floatingText">Last Name:</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" name="email" id="floatingInput" placeholder="name@example.com">
                            <label for="floatingInput">Email address</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="password" name="pass" class="form-control" id="floatingPassword" placeholder="Password">
                            <label for="floatingPassword">Password</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="password" name="cpass" class="form-control" id="floatingPassword" placeholder="Password">
                            <label for="floatingPassword">Confirm Password</label>
                        </div>
                        <div class="form-floating mb-3" style="display: flex; align-items: center;">
    
    <div class="custom-file" style="flex: 1;">
        <input type="file" class="custom-file-input" id="profile_pic" name="profile_pic" style="cursor: pointer;">
        <label class="custom-file-label" for="profile_pic">Choose file</label>
    </div>
</div>

                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                                <label class="form-check-label" for="exampleCheck1">Check me out</label>
                            </div>
                            
                        </div>
                        <button type="submit" name="register" class="btn btn-primary py-3 w-100 mb-4">Sign Up</button>
                        <p class="text-center mb-0">Already have an Account? <a href="signin.php">Sign In</a></p>
                         </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sign Up End -->
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>
