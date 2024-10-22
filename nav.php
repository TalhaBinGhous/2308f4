<?php
// Start session at the very beginning of the file, before any output
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Get the current page name
$current_page = basename($_SERVER['PHP_SELF']);
?>
<style>
   
    /* User Profile Picture */
    .user-avatar {
        width: 35px; /* Size of the avatar */
        height: 35px;
        border-radius: 50%; /* Circle shape */
        overflow: hidden;
        
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
<nav class="navbar px-md-0 navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container-fluid px-md-5">
        <a class="navbar-brand" href="index.html">JusticeHub<span>A Law Firm</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button> 

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <?php
                if (isset($_SESSION['uname'])) { 
                    ?>
                    <li class="nav-item <?php echo $current_page == 'index.php' ? 'active' : ''; ?>">
                        <a href="index.php" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item <?php echo $current_page == 'about.php' ? 'active' : ''; ?>">
                        <a href="about.php" class="nav-link">About Us</a>
                    </li>
                    <li class="nav-item <?php echo $current_page == 'blog.php' ? 'active' : ''; ?>">
                        <a href="blog.php" class="nav-link">Our Story</a>
                    </li>
                    <li class="nav-item <?php echo $current_page == 'user_select_category.php' ? 'active' : ''; ?>">
                        <a href="user_select_category.php" class="nav-link">Lawyers</a>
                    </li>
                    <li class="nav-item <?php echo $current_page == 'contact.php' ? 'active' : ''; ?>">
                        <a href="contact.php" class="nav-link">Contact</a>
                    </li>
                    <li class="nav-item <?php echo $current_page == 'cart.php' ? 'active' : ''; ?>">
                        <a href="cart.php" class="nav-link">Appointement</a>
                    </li>
                    <li class="nav-item ">
                        <a href="logout.php" class="nav-link">Logout</a>
                    </li>
                   
                    <li class="nav-item">
                        <div class="user-avatar" data-bs-toggle="modal" data-bs-target="#profilePicModal">
                            <img src="<?php echo $_SESSION['profile_pic']; ?>" alt="User Avatar">
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="#"><?php echo $_SESSION['uname']; ?></a>
                    </li>
                    
                    <?php
                } else {
                    ?>
                    <li class="nav-item <?php echo $current_page == 'signin.php' ? 'active' : ''; ?>">
                        <a class="nav-link" href="signin.php">Signin</a>
                    </li>
                    <li class="nav-item <?php echo $current_page == 'signup.php' ? 'active' : ''; ?>">
                        <a class="nav-link" href="signup.php">Signup</a>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </div>
</nav>



<!-- Profile Picture Modal -->
<div class="modal fade" id="profilePicModal" tabindex="-1" aria-labelledby="profilePicModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm"> <!-- Adjusted modal-dialog class -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="profilePicModalLabel">Profile Picture</h5>
               
            </div>
            <div class="modal-body">
                <img src="<?php echo $_SESSION['profile_pic']; ?>" class="img-fluid" alt="User Avatar"> <!-- Added img-fluid class for responsive image -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
 