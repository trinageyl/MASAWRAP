<?php
include "includes/header.php";
?>

<!-- Page Header Start -->
<div class="container-fluid page-header mb-5 position-relative overlay-bottom">
    <div class="d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5" style="min-height: 400px">
        <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase">Favorites</h1>
    </div>
</div>
<!-- Page Header End -->

<section class="py-5 bg-light">
    <div class="container px-4 px-lg-5 mt-5">
        
        <?php if (isset($_SESSION['user'])): ?>  <!-- Ensure the user is logged in -->
        <?php 
        $userHasFavorites = false; // Track if the user has any favorite recipes
        if(!empty($recipes)) { ?>
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <?php foreach ($recipes as $recipe) { 
                    $favorited_by_users = explode(',', $recipe['favorited_by_users']); 
                    if (in_array($_SESSION['user']['id'], $favorited_by_users)):
                        $userHasFavorites = true; 
                        ?>
                        <div class="col mb-5">
                            <div class="card h-100">
                                <!-- Product image-->
                                <img class="card-img-top" src="<?php $this->assets('img',$recipe['image']); ?>" alt="<?php echo $recipe["name"]; ?>">
                                <!-- Product details-->
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <!-- Product name-->
                                        <h5 class="fw-bolder"><?php echo $recipe['name']; ?></h5>
                                    </div>
                                    <div class="text-center">
                                        <!-- Product description-->
                                        <p><?php echo $recipe['description']; ?></p>
                                        <a href="http://localhost/MASAWRAP/recipe/<?php echo $recipe["id"]; ?>">View Recipe</a>
                                    </div>
                                </div>
                                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent text-center">
                                    <!-- Remove from Favorites Button -->
                                    <form action="http://localhost/MASAWRAP/recipe/<?php echo $recipe['id']; ?>/remove-favorite" method="POST">
                                        <input type="hidden" name="user_id" value="<?php echo $_SESSION['user']['id']; ?>">
                                        <button type="submit" class="btn btn-danger mt-auto">Remove from Favorites</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php 
                    endif;
                } ?>
            </div>

            <?php if (!$userHasFavorites): ?>
                <!-- If the user has no favorite recipes, display a message -->
                <p class="text-center">You don't have any favorite recipes yet.</p>
            <?php endif; ?>

        <?php } else { ?>
            <p>No recipes found.</p>
        <?php } ?>
    <?php else: ?>
        <p>Please log in to view your favorite recipes.</p>
    <?php endif; ?>    

</div>
</section>

<?php
require_once "includes/footer.php";
require_once "includes/java.php";
?>
