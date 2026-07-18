<?php
    include "includes/header.php";
?>

    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 position-relative overlay-bottom">
        <div class="d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5" style="min-height: 400px">
            <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase">Search</h1>
        </div>
    </div>
    <!-- Page Header End -->

<?php 
    require "models/RecipeModel.php";
    $recipe = new Recipe();
    
    $by = isset($_GET['by']) ? $_GET['by'] : "none";
    $term = isset($_GET['term']) ? $_GET['term'] : "";
    
    $results = $recipe->get_recipes_by($by, $term);
?>

<section class="py-5 bg-light">
    <div class="container px-4 px-lg-5 mt-5">
    <h2 class="fw-bolder mb-4">Search products</h2>
    <h2><?php echo $_GET["term"]; ?></h2>
    <?php if(!empty($results)) { ?>
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php foreach ($results as $recipe) { ?>
                <div class="col mb-5">
                        <div class="card h-100">
                                <!-- Product image-->
                            <a href="product1.php?id=<?php echo $recipe["id"]; ?>"><img class="card-img-top" src="http://localhost/MASAWRAP/img/
                                <?php echo $recipe["image"]?>" alt="coffee"></a>
                                <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                        <!-- Product name-->
                                    <h5 class="fw-bolder"><?php echo $recipe["name"]?></h5>
                                </div>
                            </div>
                        </div>
                </div>
            <?php } ?>
        </div>
    <?php } else { ?>
        <p>No results found.</p>
    <?php } ?>
    </div>
</section>


<?php
    require_once "includes/footer.php";
    require_once "includes/java.php";
?>