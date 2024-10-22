<?php
if(!session_id()) {
    session_start();
}

if (!isset($_SESSION['uname'])) {
    header("Location: signin.php");
    exit; // Ensure script stops execution after redirection
}
?>
