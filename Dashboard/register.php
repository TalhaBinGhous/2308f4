<?php
session_start();
include 'conn.php';

if (isset($_POST["submit"])) {
    // Check if passwords match
    if ($_POST['pass'] != $_POST['cpass']) {
        $_SESSION['error'] = "Confirm password does not match";
    } else {
        // Gather form data
        $name = $_POST['name'];
        $email = $_POST['email'];
        $pass = $_POST['pass'];

        // Check if username or email already exists
        $check_query = "SELECT * FROM `user` WHERE `name`='$name' OR `email`='$email'";
        $result = mysqli_query($conn, $check_query);

        if (mysqli_num_rows($result) > 0) {
            $_SESSION['error'] = "Username or Email already exists. Please choose another.";
        } else {
            // Handle profile picture upload
            $profile_pic = '';
            if ($_FILES['profile_pic']['error'] == 0) {
                $target_dir = "uploads/profilepics/";
                $target_file = $target_dir . basename($_FILES["profile_pic"]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                // Check if image file is a actual image or fake image
                $check = getimagesize($_FILES["profile_pic"]["tmp_name"]);
                if ($check !== false) {
                    $uploadOk = 1;
                } else {
                    $_SESSION['error'] = "File is not an image.";
                    $uploadOk = 0;
                }

                // Check file size
                if ($_FILES["profile_pic"]["size"] > 500000) {
                    $_SESSION['error'] = "Sorry, your file is too large.";
                    $uploadOk = 0;
                }

                // Allow certain file formats
                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif") {
                    $_SESSION['error'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                }

                // If everything is ok, try to upload file
                if ($uploadOk == 1) {
                    if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file)) {
                        $profile_pic = $target_file;
                    } else {
                        $_SESSION['error'] = "Sorry, there was an error uploading your file.";
                    }
                }
            }

            // Insert into database if there are no errors
            if (empty($_SESSION['error'])) {
                $sql = "INSERT INTO `user`(`name`, `email`, `pass`, `image`)
                        VALUES ('$name', '$email', '$pass', '$profile_pic')";

                if (mysqli_query($conn, $sql)) {
                    $_SESSION['success'] = "Account created successfully.";
                    header('location: login.php');
                    exit();
                } else {
                    $_SESSION['error'] = "Error: " . mysqli_error($conn);
                }
            }
        }
    }

    // Redirect back to registration page if there are errors
    header('Location: register.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Register</title>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-success">
    <div class="container">
        <div class="row justify-content-center">
            <div class="card col-lg-5 center shadow-lg my-5">
                <div class="card-body p-0 center">
                    <!-- Nested Row within Card Body -->
                    <div class="row center">
                        <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                        <div class="col-md-12 center">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                                </div>
                                <?php
                                if (isset($_SESSION['error'])) {
                                    echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
                                    unset($_SESSION['error']);
                                }
                                ?>
                                <form class="user" method="post" enctype="multipart/form-data">
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="text" class="form-control form-control-user" id="exampleFirstName" placeholder="Name" name="name" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user" id="exampleInputEmail" placeholder="Email Address" name="email" required>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" name="pass" required>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="password" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Repeat Password" name="cpass" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="profile_pic" name="profile_pic">
                                            <label class="custom-file-label" for="profile_pic">Choose file</label>
                                        </div>
                                    </div>
                                    <input type="submit" name="submit" id="signup" class="btn btn-success btn-user btn-block" value="Register">
                                    <hr>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a href="forget.php" class="btn btn-danger btn-user btn-block">
                                         Forgot Password?
                                    </a>  
                                </div>
                                <div class="text-center">
                                    <a href="login.php" class="btn btn-facebook btn-user btn-block">
                                        Already have an account? Login!
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
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
    <script>
        // JavaScript to display the file name in the label
        document.querySelector('.custom-file-input').addEventListener('change', function (e) {
            var fileName = document.getElementById("profile_pic").files[0].name;
            var nextSibling = e.target.nextElementSibling
            nextSibling.innerText = fileName
        })
    </script>
</body>
</html>
