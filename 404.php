<?php
$dynamicTitle = "Page Not Found";
include ("header.php");
include ("function/commonfunction.php");

?>


<section class="error-banner bg-light-white">
    <div class="container">
        <div class="content">
            <div class="title">
                <h1 class="heading">404</h1>
            </div>
            <h5 class="heading">Oops! Page Not Available.</h5>
            <p>The page you are looking for does not exist. It may have been moved, or removed altogether. Perhaps you
                can return back to the site's homepage and see if you can find what you are looking for.</p>
            <a href="index.php" class="white-btn btn">back to home</a>
        </div>
    </div>
</section>




<?php include ("footer.php"); ?>