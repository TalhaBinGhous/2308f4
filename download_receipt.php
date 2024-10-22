<?php
session_start();

if (!isset($_SESSION['order_id'], $_SESSION['order_name'], $_SESSION['order_date'])) {
    header('Location: checkout.php'); // Redirect to checkout if session variables are not set
    exit();
}

$order_id = $_SESSION['order_id'];
$order_name = $_SESSION['order_name'];
$order_date = $_SESSION['order_date'];

include 'database.php';

$sql_order_details = "SELECT * FROM ecomm_orders WHERE oid = $order_id";
$result_order_details = mysqli_query($conn, $sql_order_details);
$order_details = mysqli_fetch_assoc($result_order_details);

$uid = $order_details['uid'];

$sql_user_details = "SELECT * FROM ecomm_users WHERE uid = $uid";
$result_user_details = mysqli_query($conn, $sql_user_details);
$user_details = mysqli_fetch_assoc($result_user_details);

$sql_lawyer_details = "SELECT ecomm_lawyers.pname AS lawyer_name, ecomm_categories.cname AS category_name 
                       FROM ecomm_order_items 
                       JOIN ecomm_lawyers ON ecomm_order_items.pid = ecomm_lawyers.pid 
                       JOIN ecomm_categories ON ecomm_lawyers.pcategory = ecomm_categories.cid 
                       WHERE ecomm_order_items.oid = $order_id";
$result_lawyer_details = mysqli_query($conn, $sql_lawyer_details);
$lawyer_details = mysqli_fetch_assoc($result_lawyer_details);

$response = [
    'order_id' => $order_id,
    'username' => $user_details['username'],
    'lawyer_name' => $lawyer_details['lawyer_name'],
    'category_name' => $lawyer_details['category_name'],
    'order_date' => $order_date
];

header('Content-Type: application/json');
echo json_encode($response);
exit();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
</head>

<body>
    <button id="downloadPdf">Download PDF</button>

    <script>
        $(document).ready(function() {
            $('#downloadPdf').click(function() {
                $.ajax({
                    url: 'receipt.php',
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        const { jsPDF } = window.jspdf;
                        const doc = new jsPDF();

                        doc.text('Appointment Receipt', 20, 20);
                        doc.text(`Order ID: ${data.order_id}`, 20, 30);
                        doc.text(`Username: ${data.username}`, 20, 40);
                        doc.text(`Lawyer Name: ${data.lawyer_name}`, 20, 50);
                        doc.text(`Category: ${data.category_name}`, 20, 60);
                        doc.text(`Order Date: ${data.order_date}`, 20, 70);

                        doc.save('appointment_receipt.pdf');
                    },
                    error: function(err) {
                        console.error('Error fetching receipt data', err);
                    }
                });
            });
        });
    </script>
</body>

</html>
