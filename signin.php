<?php
session_start();

if (isset($_POST['login'])) {
    include('database.php');
    $uname = $_POST['uname'];
    $pass = $_POST['pass'];

    // Use prepared statements to prevent SQL injection
    $sql = "SELECT * FROM ecomm_users WHERE `username` = ? AND `pass` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $uname, $pass);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $rr = $result->fetch_assoc();
        $_SESSION['uid'] = $rr['uid']; // Assuming 'uid' is the primary key of your users table
        $_SESSION['uname'] = $rr['username'];
        $_SESSION['pass'] = $rr['pass'];
        $_SESSION['profile_pic'] = $rr['img']; // Store the profile picture URL in the session
        $stmt->close();
        $conn->close();
        header('Location: index.php');
        exit();
    } else {
        echo "<script>alert('Invalid credentials');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Sign In</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
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
                            <a href="index.html" class="">
                                <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>JusticeHub</h3>
                            </a>
                            <h3>Sign In</h3>
                        </div>
                        <form method="post" action="signin.php">
                            <?php if(!empty($error)): ?>
                                <div class="alert alert-danger"><?php echo $error; ?></div>
                            <?php endif; ?>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="uname" id="floatingInput" placeholder="Username" required>
                                <label for="floatingInput">Username</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="password" name="pass" class="form-control" id="floatingPassword" placeholder="Password" required>
                                <label for="floatingPassword">Password</label>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                                <label class="form-check-label" for="exampleCheck1">Check me out</label>
                            </div>
                            <a href="forget.php">Forgot Password</a>
                        </div>
                            <button type="submit" name="login" class="btn btn-primary py-3 w-100 mb-4">Sign In</button>
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
