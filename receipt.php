<?php
session_start();

// Check if session variables are set
if (!isset($_SESSION['order_id'], $_SESSION['order_name'], $_SESSION['order_date'])) {
    header('Location: checkout.php'); // Redirect to checkout if session variables are not set
    exit();
}

$order_id = $_SESSION['order_id'];
$order_name = $_SESSION['order_name']; // Assuming this is where user's name is stored
$order_date = $_SESSION['order_date'];

// Fetch user and order details from the database
include 'database.php';

$sql_order_details = "SELECT * FROM ecomm_orders WHERE oid = $order_id";
$result_order_details = mysqli_query($conn, $sql_order_details);
$order_details = mysqli_fetch_assoc($result_order_details);

$uid = $order_details['uid'];

$sql_user_details = "SELECT * FROM ecomm_users WHERE uid = $uid";
$result_user_details = mysqli_query($conn, $sql_user_details);
$user_details = mysqli_fetch_assoc($result_user_details);

// Fetch lawyer details based on order items
$sql_lawyer_details = "SELECT ecomm_lawyers.pname AS lawyer_name, ecomm_categories.cname AS category_name 
                       FROM ecomm_order_items 
                       JOIN ecomm_lawyers ON ecomm_order_items.pid = ecomm_lawyers.pid 
                       JOIN ecomm_categories ON ecomm_lawyers.pcategory = ecomm_categories.cid 
                       WHERE ecomm_order_items.oid = $order_id";
$result_lawyer_details = mysqli_query($conn, $sql_lawyer_details);
$lawyer_details = mysqli_fetch_assoc($result_lawyer_details);

$lawyer_name = $lawyer_details['lawyer_name'];
$lawyer_category = $lawyer_details['category_name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
        }
        .receipt {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            max-width: 600px;
            width: 100%;
            margin: 20px; /* Add margin for better spacing */
        }
        .receipt h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .receipt-details {
            margin-bottom: 20px;
            border: 2px double #4CAF50; /* Double border with green color */
            padding: 10px; /* Padding inside the border */
        }
        .receipt-details p {
            margin: 10px 0;
        }
        .receipt-details strong {
            font-weight: bold;
        }
        .note {
            margin-top: 20px;
            font-style: italic;
            color: #888;
        }
        .button-container {
            text-align: center;
            margin-top: 20px;
        }
        .button-container button,
        .button-container a {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 5px;
        }
        .button-container button:hover,
        .button-container a:hover {
            background-color: #45a049;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .receipt {
                padding: 10px;
                margin: 10px;
            }
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        downloadPDF();
    });

    function downloadPDF() {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        // Set font style
        doc.setFont("Arial", "normal");

        // Add content to PDF
        doc.setFontSize(15);
        doc.text("JusticeHub", 10, 10); // Adjust position as needed

        doc.setFontSize(16);
        doc.text("Appointment Receipt", 70, 30);

        doc.setFontSize(12);
        doc.text("Order ID: <?php echo $order_id; ?>", 20, 50);
        doc.text("Username: <?php echo $order_name; ?>", 20, 60);
        doc.text("Lawyer Name: <?php echo $lawyer_name; ?>", 20, 70);
        doc.text("Category: <?php echo $lawyer_category; ?>", 20, 80);
        doc.text("Appointed Date: <?php echo $order_date; ?>", 20, 90);

        // Save the PDF with filename 'receipt.pdf'
        doc.save("receipt_by_JusticeHub.pdf");
    }

    function redirectToIndex() {
        window.location.href = 'index.php'; // Redirect to index.php
    }
    </script>
</head>
<body>
    <div class="receipt">
        <h2>Appointment Receipt</h2>
        <div class="receipt-details">
            <p><strong>Order ID:</strong> <?php echo $order_id; ?></p>
            <p><strong>Username:</strong> <?php echo $order_name; ?></p> <!-- Display user's name -->
            <p><strong>Lawyer Name:</strong> <?php echo $lawyer_name; ?></p>
            <p><strong>Category:</strong> <?php echo $lawyer_category; ?></p>
            <p><strong>Order Date:</strong> <?php echo $order_date; ?></p>
        </div>
        <div class="note">
            <p><strong>Note:</strong> We will send you an email with your appointment details. Please bring this receipt on the day of your appointment. Thank you!</p>
        </div>
        <div class="button-container">
            <button onclick="window.print()">Print Receipt</button>
            <button onclick="downloadPDF()">Download Receipt</button>
            <button onclick="redirectToIndex()">Return to Index</button> <!-- Redirect button -->
        </div>
    </div>
</body>
</html>
