<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<style>
    /* Navbar background and link styles */
    .navbar {
        background-color: #f8f9fa; /* Light gray background */
        border-bottom: 1px solid #dee2e6; /* Gray border */
        padding: 10px 0; /* Padding top and bottom */
    }

    .navbar-brand {
        color: #007bff; /* Blue links */
        font-weight: bold; /* Bold text */
        margin-left: 10px; /* Add left margin */
    }

    .navbar-brand:hover,
    .nav-link:hover {
        color: #0056b3; /* Darker blue on hover */
        text-decoration: none; /* Remove underline on hover */
    }

    /* Adjust padding and margins */
    .navbar-nav {
        margin-left: auto; /* Move navbar items to the right */
    }

    .navbar-nav .nav-item {
        margin-left: 10px; /* Space between navbar items */
    }

     
     /* User Profile Picture */
     .user-avatar {
        width: 35px; /* Size of the avatar */
        height: 35px;
        border-radius: 50%; /* Circle shape */
        overflow: hidden;
        margin-top: 10px;
        margin-right: 8px; /* Spacing between avatar and username */
        cursor: pointer; /* Make the cursor a pointer */
    }

    .user-avatar img {
        width: 100%; /* Ensure the image fills the circle */
        height: auto;
    }

    /* Modal styles */
    .modal-content img {
        width: 100%; /* Ensure the image fills the modal */
        height: auto;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php" style="padding-left: 15px;">JusticeHub</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <?php if (isset($_SESSION['name'])) { ?>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="cart.php">Cart</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="logout.php">Logout</a>
                    </li>
                    <li class="nav-item">
                        <div class="user-avatar" data-bs-toggle="modal" data-bs-target="#profilePicModal">
                            <img src="<?php echo $_SESSION['profile_pic']; ?>" alt="User Avatar">
                        </div>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#"><?php echo $_SESSION['name']; ?></a>
                    </li> 
                <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="register.php">Register</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>

<!-- Profile Picture Modal -->

<div class="modal fade" id="profilePicModal" tabindex="-1" aria-labelledby="profilePicModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="profilePicModalLabel">Profile Picture</h5>
            </div>
            <div class="modal-body">
                <img src="<?php echo $_SESSION['profile_pic']; ?>" class="img-fluid" alt="User Avatar">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
 