<?php
include 'auth.php';
include 'database.php';

if (isset($_POST['order'])) {
    $uid = $_SESSION['uid'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    // Assuming you have processed the order and stored necessary data in database
    $sql_total = "SELECT SUM(subtotal) AS total FROM ecomm_cart WHERE uid = $uid";
    $result_total = mysqli_query($conn, $sql_total);
    $total = mysqli_fetch_assoc($result_total)['total'];

    $sql_order = "INSERT INTO ecomm_orders (uid, oname, ophone, oaddress, oemail, total) VALUES ('$uid', '$name', '$phone', '$address', '$email', '$total')";

    if (mysqli_query($conn, $sql_order)) {
        $oid = mysqli_insert_id($conn);

        $sql_select_cart = "SELECT * FROM ecomm_cart WHERE uid = $uid";
        $result_select_cart = mysqli_query($conn, $sql_select_cart);
        $row_count_cart = mysqli_num_rows($result_select_cart);

        if ($row_count_cart) {
            while ($row = mysqli_fetch_assoc($result_select_cart)) {
                $cart_id = $row['cart_id'];
                $pid = $row['pid'];
                $price = $row['price'];
                $subtotal = $row['subtotal'];

                $sql_insert_items = "INSERT INTO ecomm_order_items (pid, oid, price, subtotal) VALUES ('$pid', '$oid', '$price', '$subtotal')";

                if (mysqli_query($conn, $sql_insert_items)) {
                    $sql_delete_cart = "DELETE FROM ecomm_cart WHERE cart_id = $cart_id";
                    $result_delete_cart = mysqli_query($conn, $sql_delete_cart);
                }
            }

            // Set session variables for receipt
            $_SESSION['order_id'] = $oid;
            $_SESSION['order_name'] = $name;
            $_SESSION['order_date'] = date('Y-m-d'); // Example: Use actual order date

            // Redirect to receipt page
            header('Location: receipt.php');
            exit();
        } else {
            echo "<script>alert('Error: Cart is empty!');</script>";
        }
    } else {
        echo "<script>alert('Error placing order!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointement</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700,700i,900,900i&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css"> <!-- Custom CSS file -->

    <style>
        /* Custom styles */
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
            background-color: #ffffff;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            padding: 30px;
            border-radius: 10px;
        }

        .form-label {
            font-weight: bold;
        }

        .form-control {
            border-radius: 5px;
            border-color: #ddd;
        }

        .btn-order {
            background-color: #007bff;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-order:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <h3 class="mb-4">Your Details</h3>
        <form method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone:</label>
                <input type="text" class="form-control" id="phone" name="phone" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address:</label>
                <input type="text" class="form-control" id="address" name="address" required>
            </div>
            <div class="form-check">
             <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
              <label class="form-check-label" for="exampleCheck1"> <p style="  font-style: italic; color: #888;"><strong>Note:</strong> "Once you proceed your appointeent so it will not be cancel"</label>
                            </div>
            <button type="submit" class="btn btn-order bg-success" name="order">Get Appointment</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
