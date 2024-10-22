<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'conn.php';

if (isset($_POST["update"])) {
    $uid = $_SESSION['uid'];
    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $profile_pic = $_SESSION['profile_pic'];

    // Handle profile picture upload
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

    // Update database if there are no errors
    if (empty($_SESSION['error'])) {
        $sql = "UPDATE `ecomm_users` SET `username`='$username', `firstname`='$firstname', `lastname`='$lastname', `email`='$email', `pass`='$pass', `img`='$profile_pic' WHERE `uid`='$uid'";

        if (mysqli_query($conn, $sql)) {
            $_SESSION['success'] = "Profile updated successfully.";
            $_SESSION['profile_pic'] = $profile_pic;
            $_SESSION['name'] = $username;
            header('location: profile.php');
            exit();
        } else {
            $_SESSION['error'] = "Error: " . mysqli_error($conn);
        }
    }

    // Redirect back to profile page if there are errors
    header('Location: profile.php');
    exit();
}

// Fetch user details
$uid = $_SESSION['uid'];
$sql = "SELECT * FROM `ecomm_users` WHERE `uid`='$uid'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>JusticeHub - Profile</title>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-primary">
    <div class="container">
        <div class="row justify-content-center">
            <div class="card col-lg-5 center shadow-lg my-5">
                <div class="card-body p-0 center">
                    <!-- Nested Row within Card Body -->
                    <div class="row center">
                        <div class="col-md-12 center">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Update Your Profile</h1>
                                </div>
                                <?php
                                if (isset($_SESSION['error'])) {
                                    echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
                                    unset($_SESSION['error']);
                                }
                                if (isset($_SESSION['success'])) {
                                    echo '<div class="alert alert-success">' . $_SESSION['success'] . '</div>';
                                    unset($_SESSION['success']);
                                }
                                ?>
                                <form class="user" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" name="username" placeholder="Username" value="<?php echo $user['username']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" name="firstname" placeholder="First Name" value="<?php echo $user['firstname']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" name="lastname" placeholder="Last Name" value="<?php echo $user['lastname']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user" name="email" placeholder="Email Address" value="<?php echo $user['email']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" name="pass" placeholder="Password" value="<?php echo $user['pass']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="file" class="form-control form-control-user" name="profile_pic">
                                    </div>
                                    <button type="submit" name="update" class="btn btn-primary btn-user btn-block">
                                        Update Profile
                                    </button>
                                </form>
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
