<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reset_user'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $new_password = $_POST['new_password']; // Plain text password

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'ecommerce');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the user exists by username or email
    $sql = "SELECT * FROM user WHERE name = ? OR email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Update the password
        $sql = "UPDATE user SET pass = ? WHERE name = ? OR email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sss', $new_password, $username, $email);
        if ($stmt->execute()) {
            header('Location: login.php'); // Redirect to login page
            exit();
        } else {
            echo "Error updating password.";
        }
    } else {
        header('Location: login.php'); // Redirect to login page if user not found
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password - User</title>
    
    <!-- Custom fonts and styles for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    
    <!-- Custom styles for this page -->
    <style>
        body.bg-gradient-success {
            background-color: #1cc88a;
            background-image: linear-gradient(180deg, #1cc88a 10%, #f3f4f7 100%);
            background-size: cover;
        }
        .center {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .card {
            border-radius: 1rem;
        }
        .bg-login-image {
            background: url('img/login-image.jpg');
            background-position: center;
            background-size: cover;
        }
        .form-control-user {
            border-radius: 10rem;
            padding: 1.5rem 1rem;
        }
        .btn-user {
            border-radius: 10rem;
            padding: 0.75rem 1rem;
        }
    </style>
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
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form action="forget.php" method="POST">
                                        <div class="form-group">
                                            <input type="text" name="username" class="form-control form-control-user" placeholder="Username">
                                        </div>
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control form-control-user" placeholder="Email">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="new_password" class="form-control form-control-user" placeholder="New Password" required>
                                        </div>
                                        <input type="submit" name="reset_user" class="btn btn-success btn-user btn-block" value="Reset Password">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
</body>
</html>
