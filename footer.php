<footer class="ftco-footer ftco-bg-dark ftco-section py-2">
    <div class="container">
        <div class="row mb-5">
            <!-- About JusticeHub widget -->
            <div class="col-md">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2">About JusticeHub</h2>
                    <p>We are dedicated to upholding justice, fairness, and equality for all. Founded on the principle that every individual deserves access to legal representation and protection.</p>
                    <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                        <li class="ftco-animate"><a href="https://twitter.com/"><span class="icon-twitter"></span></a></li>
                        <li class="ftco-animate"><a href="https://www.facebook.com/"><span class="icon-facebook"></span></a></li>
                        <li class="ftco-animate"><a href="https://www.instagram.com/"><span class="icon-instagram"></span></a></li>
                    </ul>
                </div>
            </div>
            <!-- Practice Areas widget -->
            <div class="col-md">
                <div class="ftco-footer-widget mb-4 ml-md-5">
                    <h2 class="ftco-heading-2">Lawyers Categories</h2>
                    <ul class="list-unstyled">
                        <?php
                        // Assuming you have PHP enabled and connected to your database
                        include "database.php";
                        $sql = "SELECT * FROM ecomm_categories";
                        $result = mysqli_query($conn, $sql);

                        // Display each category as a list item
                        while ($row = mysqli_fetch_assoc($result)) {
                            // Generate URL dynamically based on category ID
                            $category_url = "user_select_category.php?cid={$row['cid']}";
                            echo "<li><span class='ion-ios-arrow-forward mr-3 text-success'></span><a href='{$category_url}' class='text-success'>{$row['cname']}</a></li>";
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <!-- Business Hours widget -->
            <div class="col-md">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2">Business Hours</h2>
                    <div class="opening-hours">
                        <h4>Opening Days:</h4>
                        <p class="pl-3">
                            <span>Monday - Friday : 9am to 8pm</span>
                            <span>Saturday : 9am to 5pm</span>
                        </p>
                        <h4>Vacations:</h4>
                        <p class="pl-3">
                            <span>All Sundays</span>
                            <span>All Official Holidays</span>
                        </p>
                    </div>
                </div>
            </div>
            <!-- Contact Information widget -->
            <div class="col-md">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2">Have a Question?</h2>
                    <div class="block-23 mb-3">
                        <ul>
                            <li><span class="icon icon-map-marker"></span><span class="text">Block 80, Building 06, North Karachi, Karachi, Pakistan</span></li>
                            <li><a href="tel://+92 318 0112631"><span class="icon icon-phone"></span><span class="text">+92 318 0112631</span></a></li>
                            <li><a href="mailto:umohi4613@gmail.com"><span class="icon icon-envelope"></span><span class="text">umohi4613@gmail.com</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Copyright information -->
        <div class="row">
            <div class="col-md-12 text-center">
                <p>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | <i class="icon-heart color-danger" aria-hidden="true"></i> by <a href="index.php">JusticeHub</a>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                </p>
            </div>
        </div>
    </div>
</footer>
