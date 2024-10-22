<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700,700i,900,900i&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/ionicons.min.css">
    
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Our Story</title>
    <style>
       
        .containers {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .comment {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 15px;
            position: relative;
        }
        .comment h5 {
            margin-bottom: 5px;
            color: #333;
        }
        .comment p {
            margin-bottom: 10px;
            color: #666;
        }
        .comment small {
            display: block;
            color: #888;
        }
        .comment .delete-btn {
            position: absolute;
            top: 5px;
            right: 10px;
        }
        .modal-dialog {
            max-width: 400px;
        }
    </style>
</head>
<body>


<?php  include 'nav.php';?>


<section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_1.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-end justify-content-center">
          <div class="col-md-9 ftco-animate pb-5 text-center">
            <h1 class="mb-3 bread">Success Story</h1>
            <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Success Story<i class="ion-ios-arrow-forward"></i></span></p>
          </div>
        </div>
      </div>
    </section>


<div class="containers">
    <div class="text-center my-4">
        <img src="./img/1.jpg" class="img-fluid" alt="JusticeHub Success Story">
    </div>
    <div class="my-4">
        <h2>JusticeHub Success Story</h2>
        <p>Once, a challenging corporate dispute threatened to derail a thriving business's future. The stakes were high, and every decision mattered. That's when JusticeHub stepped in, bringing together a team of seasoned lawyers renowned for their expertise in corporate law.</p>
        <p>With a meticulous approach and a deep understanding of the intricacies involved, JusticeHub navigated the complex legal landscape with precision. They devised a strategy that not only safeguarded their client's interests but also strategically positioned them for success.</p>

        <p>Clients who entrust their legal matters to JusticeHub find not only skilled attorneys but also compassionate advocates who prioritize their needs and concerns. Whether navigating the complexities of family law or negotiating intricate business contracts, our lawyers provide personalized solutions tailored to achieve the best possible results.</p>
        <p>Through rigorous negotiations and strategic counsel, JusticeHub not only resolved the dispute but also secured a favorable settlement that exceeded expectations. The outcome was a testament to their commitment to excellence and unwavering dedication to achieving justice for their clients.</p>

        <p>JusticeHub's dedication extends beyond the courtroom. Through proactive legal strategies and innovative approaches, our lawyers anticipate challenges and proactively work towards favorable resolutions. This proactive stance sets JusticeHub apart, ensuring that clients receive comprehensive support throughout their legal journey.</p>
        <p>In the dynamic landscape of legal practice, JusticeHub remains at the forefront of innovation and excellence. Continuously adapting to legal trends and leveraging cutting-edge technology, our firm empowers clients with the resources they need to navigate even the most intricate legal landscapes successfully.</p>
        <p>For those seeking not just legal representation but a steadfast ally in their legal battles, JusticeHub stands ready. With a track record of success and a commitment to excellence, our lawyers are prepared to tackle any challenge, secure justice, and achieve favorable outcomes for our valued clients.</p>

        <p>This success story exemplifies JusticeHub's ability to deliver results under pressure, ensuring that every client receives personalized attention and effective legal representation. From start to finish, JusticeHub remains a trusted partner in navigating legal challenges, providing steadfast support, and securing favorable outcomes that uphold the principles of justice.</p>
    </div>
</div>

<!-- Comments Section -->
<div class="containers mt-4">
    <h3 > <strong> Comment Section</strong></h3>

    <?php
    include 'database.php';

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert new comment
    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $comment = $_POST['comment'];
        $parent_id = $_POST['parent_id'];

        $sql = "INSERT INTO comments (name, email, comment, parent_id) VALUES ('$name', '$email', '$comment', '$parent_id')";
        if ($conn->query($sql) === TRUE) {
            // Clear form fields after successful submission
            echo '<script>document.getElementById("commentForm").reset();</script>';
            // Redirect to blog.php after successful submission
            echo '<script>window.location.replace("blog.php");</script>';
        } else {
            echo '<div class="alert alert-danger" role="alert">Error: ' . $sql . '<br>' . $conn->error . '</div>';
        }
    }

    // Display comments
    $sql = "SELECT * FROM comments WHERE parent_id = 0 ORDER BY created_at DESC";
    $result = $conn->query($sql);

    function display_comments($comments, $parent_id = 0, $conn) {
        $html = '';
        foreach ($comments as $comment) {
            $html .= '<div class="comment">';
            $html .= '<h5>' . $comment['name'] . '</h5>';
            $html .= '<p>' . $comment['comment'] . '</p>';
            $html .= '<small>' . $comment['created_at'] . '</small>';
            
            // Delete comment button and modal
            $html .= '<button type="button" class="btn btn-sm btn-danger delete-btn" data-toggle="modal" data-target="#deleteModal' . $comment['id'] . '">Delete</button>';
            
            // Modal for delete confirmation
            $html .= '<div class="modal fade" id="deleteModal' . $comment['id'] . '" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel' . $comment['id'] . '" aria-hidden="true">';
            $html .= '<div class="modal-dialog" role="document">';
            $html .= '<div class="modal-content">';
            $html .= '<div class="modal-header">';
            $html .= '<h5 class="modal-title" id="deleteModalLabel' . $comment['id'] . '">Delete Comment</h5>';
            $html .= '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
            $html .= '<span aria-hidden="true">&times;</span>';
            $html .= '</button>';
            $html .= '</div>';
            $html .= '<div class="modal-body">';
            $html .= '<p>Enter your email to confirm deletion:</p>';
            $html .= '<input type="email" class="form-control" id="deleteEmail' . $comment['id'] . '" placeholder="Your Email" required>';
            $html .= '</div>';
            $html .= '<div class="modal-footer">';
            $html .= '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>';
            $html .= '<button type="button" class="btn btn-danger" onclick="deleteComment(' . $comment['id'] . ')">Delete Comment</button>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';
            
            // End of comment div
            $html .= '</div>';
        }
        return $html;
    }
    
    if ($result->num_rows > 0) {
        $comments = [];
        while ($row = $result->fetch_assoc()) {
            $comments[] = $row;
        }
        echo display_comments($comments, 0, $conn);
    }
    
    $conn->close();
    ?>

    <!-- Comment Form -->
    <h5 class="text-success">Enter your Comment</h5>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="mt-4 mb-4" id="commentForm">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="comment">Comment:</label>
            <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
        </div>
        <input type="hidden" name="parent_id" value="0">
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<?php  include 'footer.php';?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    function deleteComment(commentId) {
        var email = document.getElementById('deleteEmail' + commentId).value;
        
        // AJAX call to verify email and delete comment
        $.ajax({
            url: 'delete_comment.php', // PHP file for handling delete operations
            type: 'POST',
            data: { id: commentId, email: email },
            success: function(response) {
                alert(response); // Display success or error message
                
                // Reload comments after successful deletion
                if (response.includes('successfully')) {
                    location.reload(); // Reload the current page
                }
            },
            error: function(xhr, status, error) {
                alert("Error: " + error); // Display error if any
            }
        });
    }
</script>
<script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>
    
</body>
</html>
