<?php
include 'database.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id']) && isset($_POST['email'])) {
    $id = $_POST['id'];
    $email = $_POST['email'];

    // Validate email before deletion (you can improve this validation)
    $sql = "SELECT * FROM comments WHERE id = $id AND email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $delete_sql = "DELETE FROM comments WHERE id = $id";
        if ($conn->query($delete_sql) === TRUE) {
            echo "Comment deleted successfully!";
        } else {
            echo "Error deleting comment: " . $conn->error;
        }
    } else {
        echo "Email does not match or comment not found.";
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>
