<?php
session_start();

if (isset($_POST['sub'])) {
    include('conn.php');
    $name = $_POST['name'];
    $pass = $_POST['pass'];
    $sql = "SELECT * FROM user WHERE `name` = '$name' AND `pass` = '$pass'";
    $result = mysqli_query($conn, $sql);
    $rr = mysqli_fetch_array($result);
    $rows = mysqli_num_rows($result);

    if ($rows) {
        $_SESSION['name'] = $name;
        $_SESSION['pass'] = $rr['pass'];
        $_SESSION['profile_pic'] = $rr['image']; // Store the profile picture URL in the session
        header('Location:index.php');
    } else {
        echo "<script>alert('Invalid credentials');</script>";
    }
}
?>


 
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-success">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-lg-5 center">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-md-12">
                                <div class="p-5 " >
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form class="user" method="POST">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                placeholder="Enter Name..." name="name">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Password" name="pass">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck" required>
                                                <label class="custom-control-label" for="customCheck">checkbox
                                                    </label>
                                            </div>
                                        </div>
                                       <input type="submit" placeholder="Login" name="sub" class="btn btn-success btn-user btn-block">
                                            
                                        </a>
                                        <hr>
                                        
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                    <a href="forget.php" class="btn btn-google btn-user btn-block">
                                             Forgot Password?
                                        </a>
                                        
                                    </div>
                                    <div class="text-center">
                                    <a href="register.php" class="btn btn-facebook btn-user btn-block">
                                             Create an Account!
                                        </a>
                                    </div>
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

</body>

</html>