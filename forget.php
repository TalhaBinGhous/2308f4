<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reset_ecomm_user'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $new_password = $_POST['new_password']; // Plain text password

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'ecommerce');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the user exists by username or email
    $sql = "SELECT * FROM ecomm_users WHERE username = ? OR email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Update the password
        $sql = "UPDATE ecomm_users SET pass = ? WHERE username = ? OR email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sss', $new_password, $username, $email);
        if ($stmt->execute()) {
            header('Location: signin.php'); // Redirect to login page
            exit();
        } else {
            echo "Error updating password.";
        }
    } else {
        header('Location: signin.php'); // Redirect to login page if user not found
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
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
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
    <title>Forget Password</title>
    <style>
        body {
            font-family: 'Poppins', Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        input[type="text"], input[type="email"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #28a745; /* Success color */
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838; /* Darker success color */
        }
    </style>
</head>
<body>
<div class="container-fluid position-relative d-flex p-0">
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-8 col-xl-4">
                    <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                           
                        <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>Forget Password</h3>
                
                        </div>
                        <form action="forget.php" method="POST">
                            <div class="form-floating mb-3">
                            <input type="text" name="username" placeholder="Username">
                                <label for="floatingInput">Username</label>
                            </div>
                            <div class="form-floating mb-4">
                            <input type="email" name="email" placeholder="Email">
                                <label for="floatingPassword">Email</label>
                            </div>
                            <div class="form-floating mb-4">
                            <input type="password" name="new_password" placeholder="New Password" required>
                                <label for="floatingPassword">New Password</label>
                            </div>
                            <button type="submit" name="reset_ecomm_user" class="btn btn-primary py-3 w-100 mb-4">Reset Password</button>
                            <p class="text-center mb-0">Don't have an Account? <a href="signup.php">Sign Up</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>