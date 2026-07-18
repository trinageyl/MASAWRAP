<?php
    require_once "includes/header.php"; 
?>

    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 position-relative overlay-bottom">
        <div class="d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5" style="min-height: 400px">
            <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase">About</h1>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- About Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="section-title">
                <h4 class="text-primary text-uppercase" style="letter-spacing: 5px;">About Us</h4>
                <h1 class="display-4">Serving Since 2022</h1>
            </div>
            <div class="row">
                <div class="col-lg-4 py-0 py-lg-5">
                    <img class="w-100" src="http://localhost/MASAWRAP/img/logoo.png" alt="Image">
                    <h1 class="mb-3">Welcome to MASA WRAP</h1>
                    <h5 class="mb-3">At MASA WRAP, we celebrate
                                    the rich and diverse flavors of
                                    Filipino cuisine. Our mission is
                                    to bring the authentic taste of
                                    the Philippines to kitchens
                                    around the world, preserving
                                    the culinary traditions that
                                    make our culture so unique.
                    </h5>
                </div>
                <div class="col-lg-4 py-5 py-lg-0" style="min-height: 500px;">
                    <div class="position-relative h-100">
                        <img src="<?php $this->assets('img','diivider.png'); ?>" alt="">
                    </div>
                </div>
                <div class="col-lg-4 py-0 py-lg-5">
                    <img class="w-100" src="http://localhost/MASAWRAP/img/Pilip.png" alt="Image">
                    <h1 class="mb-3">Our Mission</h1>
                    <h5 class="mb-3">At MASA WRAP, we celebrate
                                    the rich and diverse flavors of
                                    Filipino cuisine. Our mission is
                                    to bring the authentic taste of
                                    the Philippines to kitchens
                                    around the world, preserving
                                    the culinary traditions that
                                    make our culture so unique.
                    </h5>
                    <h1 class="mb-3">Our Values</h1>
                    <h5 class="mb-3"><i class="fa fa-check text-primary mr-3"></i>Authenticity: We strive to provide recipes that stay true to traditional Filipino cooking methods and ingredients.</h5>
                    <h5 class="mb-3"><i class="fa fa-check text-primary mr-3"></i>Cultural Preservation: We aim to preserve and promote Filipino culinary heritage.</h5>
                    <h5 class="mb-3"><i class="fa fa-check text-primary mr-3"></i>Community: We believe in the power of community and welcome contributions from fellow Filipino food enthusiasts.</h5>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <?php 
    require_once "includes/footer.php";
    require_once "includes/java.php";
?>