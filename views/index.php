<?php
    require_once "includes/header.php";
?>

    <!-- Carousel Start -->
    <div class="container-fluid p-0 mb-5">
        <div id="blog-carousel" class="carousel slide overlay-bottom" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="<?php $this->assets('img','foodbg.png'); ?>" alt="">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <h1 class="display-1 text-white m-0" style="font-family: 'Georgia', sans-serif;">MASA WRAP</h1>
                        <h2 class="text-uppercase font-weight-medium m-0" style="font-family: 'Georgia', sans-serif;">FILIPINO RECIPE</h2>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="<?php $this->assets('img','foodbg.png'); ?>" alt="">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <h2 class="display-1 text-white m-0" style="font-family: 'Georgia', serif;">Welcome to MASA WRAP</h2>
                        <h3 class="text-center m-0" style="font-family: 'Georgia', serif;">Your go-to destination for bringing traditional Filipino meals to your table! Discover the perfect blend of Filipino tastes with our delightful recipes. Indulge in sweet Filipino desserts and meryenda. Join us on a culinary journey where every bite brings you closer to the heart of the Philippines.</h3>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#blog-carousel" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#blog-carousel" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- About Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="section-title">
                <img src="<?php $this->assets('img','sun.png'); ?>" alt="">
                <h1 class="display-4" style="font-family: 'Verdana', sans-serif;">ABOUT US</h1>
            </div>
            <div class="row">
                <div class="col-lg-4 py-0 py-lg-5">
                    <h1 class="mb-3" style="font-family: 'Verdana', sans-serif;">Welcome to MASA WRAP</h1>
                    <h4 style="font-family: 'Times New Roman', serif;">At MASA WRAP, we celebrate the rich and diverse flavors of Filipino cuisine. Our mission is to bring the authentic taste of the Philippines to kitchens around the world, preserving the culinary traditions that make our culture so unique.</h4>
                </div>
                <div class="col-lg-4 py-5 py-lg-0" style="min-height: 500px;">
                    <div class="position-relative h-100">
                        <img src="<?php $this->assets('img','diivider.png'); ?>" alt="">
                    </div>
                </div>
                <div class="col-lg-4 py-0 py-lg-5">
                    <h1 class="mb-3" style="font-family: 'Verdana', sans-serif;">Our Mission</h1>
                    <h4 class="mb-3" style="font-family: 'Times New Roman', serif;"><i class="fa fa-check text-primary mr-3"></i>We are dedicated to providing authentic Filipino recipes, from beloved classics to modern twists. Our vision is to become the ultimate resource for anyone looking to explore and enjoy the flavors of the Philippines.</h4>
                    <a href="about" class="btn btn-primary font-weight-bold py-2 px-4 mt-2" style="font-family: 'Verdana', sans-serif;">Learn More</a>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- Offer Start -->
    <div class="offer container-fluid my-5 py-5 text-center position-relative overlay-top overlay-bottom">
        <div class="container py-5">
            <h1 class="display-3 mt-3" style="color: #fff; font-family: 'Georgia', serif;">NEW RECIPES ALERT</h1>
            <form class="form-inline justify-content-center mb-4">
                <div class="input-group">
                    <div class="input-group-append">
                        <a href="https://localhost/MASAWRAP/recipes" class="btn btn-primary font-weight-bold px-4" style="font-family: 'Georgia', serif;">CHECK RECIPES</a>
                    </div>

                </div>
            </form>
        </div>
    </div>
    <!-- Offer End -->


    <!-- Menu Start -->
    <div class="container-fluid pt-5">
        <div class="container">
            <div class="section-title">
                <h1 class="display-1" style="font-family: 'Verdana', sans-serif; font-size: 65px;">MENU</h1>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <a href="https://localhost/MASAWRAP/recipes"><h3 class="mb-5" style="font-family: 'Verdana', sans-serif;">MAIN DISH</h3></a>
                    <?php 
                        $count = 0;
                        foreach ($recipes as $recipe)
                            if ($recipe["categories"] == "Main Dish" && $count < 1){
                    ?>
                    <div class="row align-items-center mb-5">
                        <div class="col-4">
                            <img class="w-100 rounded-circle mb-3 mb-sm-0" src="<?php $this->assets('img','dish.png'); ?>" alt="">
                        </div>
                        <div class="col-8">
                            <h4 style="font-family: 'Times New Roman', serif;">Savor hearty and traditional Filipino meals that bring warmth and comfort to your table.</h4>
                        </div>
                    </div>
                    <?php 
                        $count++;
                    }
                    ?>
                </div>
                <div class="col-lg-6">
                    <a href="https://localhost/MASAWRAP/recipes"><h3 class="mb-5" style="font-family: 'Verdana', sans-serif;">SNACK</h3></a>
                    <?php 
                        $count = 0;
                        foreach ($recipes as $recipe)
                            if ($recipe["categories"] == "Snack" && $count < 1){
                    ?>
                    <div class="row align-items-center mb-5">
                        <div class="col-4">
                            
                            <img class="w-100 rounded-circle mb-3 mb-sm-0" src="<?php $this->assets('img','snack.png'); ?>" alt="">
                        </div>
                        <div class="col-8">
                            <h4 style="font-family: 'Times New Roman', serif;">Enjoy a variety of fun and casual Filipino snacks perfect for any time of day.</h4>
                        </div>
                    </div>
                    <?php 
                        $count++;
                    }
                    ?>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <a href="https://localhost/MASAWRAP/recipes"><h3 class="mb-5 text-center" style="font-family: 'Verdana', sans-serif;">DESSERT</h3></a>
                    <?php 
                        $count = 0;
                        foreach ($recipes as $recipe)
                            if ($recipe["categories"] == "Dessert" && $count < 1){
                    ?>
                    <div class="row align-items-center mb-5">
                        <div class="col-4">
                            <img class="w-100 rounded-circle mb-3 mb-sm-0" src="<?php $this->assets('img','dessert.png'); ?>" alt="">
                        </div>
                        <div class="col-8">
                            <h4 style="font-family: 'Times New Roman', serif;">Indulge in sweet Filipino desserts that offer a delightful end to any meal.</h4>
                        </div>
                    </div>
                    <?php 
                        $count++;
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Menu End -->

<?php 
    require_once "includes/footer.php";
    require_once "includes/java.php"
?>
