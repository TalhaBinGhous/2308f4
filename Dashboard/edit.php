<?php
include 'conn.php';

if (isset($_GET['pid'])) {
    $pid = $_GET['pid'];
    $sql = "SELECT * FROM ecomm_lawyers WHERE pid = $pid";
    $result = mysqli_query($conn, $sql);

    if ($row = mysqli_fetch_assoc($result)) {
        $pname = $row['pname'];
        $pprice = $row['pprice'];
        $pcategory = $row['pcategory'];
        $pdes = $row['pdes'];
        $pimg = $row['pimg'];
    }
}

if (isset($_POST['update'])) {
    $pid = $_POST['pid'];
    $pname = $_POST['pname'];
    $pprice = $_POST['pprice'];
    $pcategory = $_POST['pcategory'];
    $pdes = $_POST['pdes'];
    $pimg = $_FILES['pimg']['name'];

    // Image upload
    if ($pimg) {
        $target_dir = "uploads/lawyers/";
        $target_file = $target_dir . basename($pimg);
        move_uploaded_file($_FILES['pimg']['tmp_name'], $target_file);
    } else {
        $pimg = $row['pimg']; // Keep the existing image if no new image is uploaded
    }

    $sql = "UPDATE ecomm_lawyers SET pname = '$pname', pprice = '$pprice', pcategory = '$pcategory', pdes = '$pdes', pimg = '$pimg' WHERE pid = $pid";

    if (mysqli_query($conn, $sql)) {
        header("Location: lawyerapp.php");
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Lawyer</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f8f9fc;
            margin: 0;
            padding: 0;
        }

        h3 {
            text-align: center;
            margin-top: 20px;
        }

        form {
            width: 50%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin: 10px 0 5px;
        }

        input[type="text"], textarea, input[type="file"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        input[type="submit"] {
            background-color: #4e73df;
            color: #fff;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #2e59d9;
        }

        img {
            max-width: 100%;
            height: auto;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <?php include 'nav.php'; ?>

    <h3>Edit Lawyer</h3>
    <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="pid" value="<?php echo $pid; ?>">
        <label for="pname">Lawyer Name:</label>
        <input type="text" name="pname" value="<?php echo $pname; ?>" required>
        <label for="pprice">Lawyer Price:</label>
        <input type="text" name="pprice" value="<?php echo $pprice; ?>" required>
        <label for="pcategory">Lawyer Category:</label>
        <select name="pcategory" required>
            <?php
            $cat_sql = "SELECT * FROM ecomm_categories";
            $cat_result = mysqli_query($conn, $cat_sql);

            while ($cat_row = mysqli_fetch_assoc($cat_result)) {
                $selected = ($cat_row['cid'] == $pcategory) ? 'selected' : '';
                echo "<option value='{$cat_row['cid']}' $selected>{$cat_row['cname']}</option>";
            }
            ?>
        </select>
        <label for="pdes">Lawyer Description:</label>
        <textarea name="pdes" required><?php echo $pdes; ?></textarea>
        <label for="pimg">Lawyer Image:</label>
        <input type="file" name="pimg">
        <img src="uploads/lawyers/<?php echo $pimg; ?>" alt="<?php echo $pname; ?>">
        <input type="submit" name="update" value="Update Lawyer">
    </form>
</body>
</html>
