
<?php 

// include("function/commonfunction.php");


?>
<footer>
    <section class="primary-bg section-gap footer">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-4">
                    <div class="footer-about footer-box">
                        <h4 class="heading underline">About Us</h4>
                        <p>Morbi eu purus eget tellus fringilla malesuada eget nec nisi. Etiam nec dolor porttitor, cursus elit quis, tristique erat. Integer euismod, nunc sit amet posuere gravida, dolor ipsum lobortis tortor, sed viverra purus dolor at massa nulla.</p>
                        <div class="social-icon pt-lg-2">
                            <div class="d-flex gap-2 align-items-center">
                                <div class="icon">
                                    <i class="fa-solid fa-location-dot"></i>
                                </div>
                                <p><span>90-120 Swanston St,Melbourne VIC 3000, Australia</span></p>
                            </div>
                            <div class="d-flex gap-2 align-items-center">
                                <div class="icon">
                                    <i class="fa-solid fa-phone"></i>
                                </div>
                                <p><a href="tel:+61 3 9559 9559">+61 3 9559 9559</a> or <a href="tel:+61 3 9669 9669">+61 3 9669 9669</a></p>
                            </div>
                            <div class="d-flex gap-2 align-items-center">
                                <div class="icon">
                                    <i class="fa-solid fa-envelope"></i>
                                </div>
                                <p><a href="mailto:support@gtcreators.com">support@gtcreators.com</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="footer-box footer-recent">
                        <h4 class="heading underline">Recent Posts</h4>
                        <div>
                            <a href="#">
                                <div class="d-flex gap-3 pb-3 align-items-center">
                                    <div class="image">
                                        <img src="../image/footer-r-1.jpg" alt="">
                                    </div>
                                    <div class="content">
                                        <h3 class="heading">Vestibulum rutrum pretium</h3>
                                        <div class="date">
                                            <span>August 14, 2016</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="">
                            <a href="#">
                                <div class="d-flex gap-3 pb-3 align-items-center">
                                    <div class="image">
                                        <img src="../image/footer-r-2.jpg" alt="">
                                    </div>
                                    <div class="content">
                                        <h3 class="heading">Pellentesque non magna</h3>
                                        <div class="date">
                                            <span>August 14, 2016</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="d-flex gap-3 pb-3 align-items-center">
                            <div class="image d-none">
                                <img src="../image/footer-r-3.jpg" alt="">
                            </div>
                            <div class="splide footer-slide">
                                <div class="splide__track">
                                    <ul class="splide__list">
                                        <li class="splide__slide">
                                            <div class="image">
                                                <a href="#"><img src="../image/footer-r-3.jpg" alt=""></a>
                                            </div>
                                        </li>
                                        <li class="splide__slide">
                                            <div class="image">
                                                <a href="#"><img src="../image/footer-r-4.jpg" alt=""></a>
                                            </div>
                                        </li>
                                        <li class="splide__slide">
                                            <div class="image">
                                                <a href="#"><img src="../image/footer-r-5.jpg" alt=""></a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <a href="#">
                                <div class="content">
                                    <h3 class="heading">Slider post format</h3>
                                    <div class="date">
                                        <span>July 30, 2016</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                <div class="footer-box footer-gallery">
                        <h4 class="heading underline">Our Gallery</h4>
                        <?php
                            // Directory containing the images
                            $image_dir = "../admin_area/product_images/";

                            $image_files = [];

                            if ($handle = opendir($image_dir)) {
                                while (false !== ($file = readdir($handle))) {
                                    if ($file != "." && $file != ".." && is_file($image_dir . $file)) {
                                        $image_files[] = $file;
                                    }
                                }
                                closedir($handle);
                            }
                            // shuffle($image_files);
                        ?>
                        <div class="row g-2">
                            <?php
                                $num_images = 8;

                                for ($i = 0; $i < min($num_images, count($image_files)); $i++) {
                                    ?>
                                    <div class="col-3">
                                        <div class="image">
                                            <img src="<?php echo $image_dir . $image_files[$i]; ?>" alt="">
                                        </div>
                                    </div>
                                    <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="footer-bottom">
        <div class="container">
            <div class="text-center">
                <span>©2016 GTC. All rights reserved.</span>
            </div>
        </div>
        <!-- <a href="#" id="button"><i class="fa-solid fa-chevron-up"></i></a> -->
    </section>
</footer>











<script src="../js/jquery.min.js"></script>
<!-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> -->
<script src="../js/wow.min.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="../js/splide.min.js"></script>
<script src="../js/jquery.fancybox.js"></script>
<script src="../js/script.js"></script>

</body>
</html>