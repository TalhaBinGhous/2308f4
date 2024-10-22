<?php
include("conn.php");

if (isset($_GET['pid']) && is_numeric($_GET['pid'])) {
    $pid = $_GET['pid'];

    $sql = "DELETE FROM `ecomm_lawyers` WHERE pid = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $pid);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: lawyerapp.php");
        exit; // Ensure no further code is executed
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
} else {
    echo "Invalid request.";
}

mysqli_close($conn);

?>
