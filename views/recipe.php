<?php
require_once "includes/header.php"; 
?>
<!-- Page Header Start -->
<div class="container-fluid page-header mb-5 position-relative overlay-bottom">
    <div class="d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5" style="min-height: 400px">
        <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase">RECIPES</h1>
    </div>
</div>
<!-- Page Header End -->

<!-- Menu Start -->
<div class="container-fluid pt-5">
    <div class="container">
            <?php if (isset($_SESSION["success"]["recipe"])): ?>
                <?php
                    $msg = '';
                    if (isset($_SESSION["success"]["recipe"]["insert"])) {
                        $msg = "Successfully added a new recipe";
                    } elseif (isset($_SESSION["success"]["recipe"]["update"])) {
                        $msg = "Successfully updated recipe";
                    } elseif (isset($_SESSION["success"]["recipe"]["delete"])) {
                        $msg = "Deleted recipe successfully";
                    }
                ?>
                <div class="row">
                    <div class="alert alert-success alert-dismissible fade show" role="alert" id="alert">
                        <strong><i class="fa fa-check-circle me-2" aria-hidden="true"></i></strong><?php echo $msg; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
                <?php unset($_SESSION["success"]["recipe"]); ?>
            <?php endif; ?>
        <div class="row">

            <!-- Loop through all recipes -->
            <?php 
                foreach ($recipes as $recipe) {
            ?>
            <div class="col-lg-4">
                <div class="row align-items-center mb-5">
                    <div class="col-4 col-sm-3">
                        <a href="http://localhost/MASAWRAP/recipe/<?php echo $recipe["id"]; ?>">
                            <img class="w-100 rounded-circle mb-3 mb-sm-0" src="<?php $this->assets('img',$recipe['image']); ?>" alt="<?php echo $recipe["name"]; ?>">
                        </a>
                    </div>
                    <div class="col-8 col-sm-9">
                        <h4><?php echo $recipe["name"]; ?></h4>
                        <p class="m-0"><?php echo $recipe["description"]; ?></p>
                        <!-- Apply category-container class here -->
                        <p class="category-container" style="background-color: #a36c63; padding: 5px 10px; border-radius: 5px; display: inline-block; width: fit-content; color: #000000; margin: 0;">
                            Categories: <?php echo $recipe["categories"]; ?>
                        </p>
                    </div>
                </div>
            </div>
            <?php 
                }
            ?>
        </div>
    </div>
</div>
<!-- Menu End -->

<?php 
require_once "includes/footer.php";
require_once "includes/java.php";
?>
