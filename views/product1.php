<?php
include "includes/header.php"; // Always include the header
?>

<?php 
$pageTitle = "RECIPE"; // Default page title
?>

<!-- Page Header Start -->
<div class="container-fluid page-header mb-5 position-relative overlay-bottom">
    <div class="d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5" style="min-height: 400px">
        <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase"><?php echo $pageTitle; ?></h1>
    </div>
</div>
<!-- Page Header End -->

<?php
// Check if the user is logged in and their role is "Viewer"
if (isset($_SESSION['user']['role']) && $_SESSION['user']['role'] === 'Viewer') {
    // Display the permission message, but keep the page header
    echo "<div class='container text-center my-5' style='padding-top: 50px;'><h2>You lack permission to view this page.</h2></div>";
    include "includes/footer.php";
    exit(); // Prevent the rest of the page from loading
}
?>

<!-- Recipe section -->
<section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="col-md-6">
                
                <img class="card-img-top mb-5 mb-md-0" src="<?php $this->assets('img',$recipes['image']); ?>" alt="recipe image">
            </div>
            <div class="col-md-6">
                <!-- Recipe Name -->
                <h1 class="display-5 fw-bolder"><?php echo $recipes["name"]; ?></h1>

                <!-- Chef Section -->
                <h5 class="text-muted">Chef: <?php echo $recipes["chef"]; ?></h5>

                <!-- Description -->
                <h4 class="lead"><?php echo ($recipes["description"]); ?></h4>

                <!-- Ingredients -->
                <h3 class="fw-bold mt-4">Ingredients</h3>
                <ul>
                    <?php 
                    $ingredientsArray = explode(',', $recipes["ingredients"]);
                    foreach ($ingredientsArray as $ingredient) {
                        if(trim($ingredient) != '') { 
                            echo "<li>" . trim($ingredient) . "</li>";
                        }
                    }
                    ?>
                </ul>

                <!-- Procedure -->
                <h3 class="fw-bold mt-4">Procedure</h3>
                <ol>
                    <?php 
                    $proceduresArray = explode('.', $recipes["procedure"]);
                    foreach ($proceduresArray as $procedure) {
                        if(trim($procedure) != '') {
                            echo "<li>" . trim($procedure) . "</li>";
                        }
                    }
                    ?>
                </ol>

                <!-- Edit and Delete Buttons (for admin, chef, or recipe creator) -->
                <?php 
                    if (isset($_SESSION["user"]) && 
                        ($_SESSION["user"]["role"] == 'administrator' || 
                         $_SESSION["user"]["role"] == 'chef' || 
                         $_SESSION["user"]["id"] == $recipes["user_id"])): ?>
                    <div class="d-flex mt-3">
                        <a href="https://localhost/MASAWRAP/edit/<?php echo $recipes["id"]; ?>" class="btn btn-primary font-weight-bold py-2 px-4 me-2">Edit Recipe</a>
                        <form action="https://localhost/MASAWRAP/recipe/<?php echo $recipes["id"]; ?>/delete" method="GET">
                            <input type="hidden" name="id" value="<?php echo $recipes['id']; ?>">
                            <input type="hidden" name="delete" value="true">
                            <button type="button" class="btn btn-danger font-weight-bold py-2 px-4" data-bs-toggle="modal" data-bs-target="#delete-modal-"<?php echo $recipes["id"]; ?>>Delete Recipe</button> 
                        </form>
                    </div>

                    <div class="modal fade" id="delete-modal-"<?php echo $recipes['id']; ?> data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Remove Recipe</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to remove <strong><?php echo $recipes['name']; ?></strong>?
                                    <form action="http://localhost/MASAWRAP/recipe/<?php echo $recipes['id']; ?>/delete" method="POST" id="delete-modal-<?php echo $recipes['id']; ?>">
                                        <input type="hidden" name="recipe_id" value="<?php echo $recipes["id"]; ?>">
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" form="delete-modal-<?php echo $recipes['id']; ?>" class="btn btn-danger">Remove</button>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php endif; ?>

                <!-- Add to Favorite Button (only for viewers) -->
                <?php if (isset($_SESSION["user"]) && $_SESSION["user"]["role"] === 'user'): ?>
                <form action="/MASAWRAP/recipe/<?php echo $recipes['id']; ?>/to-favorite" method="POST">
                    <input type="hidden" name="recipe_id" value="<?php echo $recipes['id']; ?>">
                    <button type="submit" class="btn btn-success font-weight-bold py-2 px-4">Add to Favorites</button>
                </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php
require_once "includes/footer.php";
require_once "includes/java.php";
?>
