<?php
// Check if a session is already started

    session_start();


// Unset all session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect the user to the index page
header('Location: index.php');
?>
