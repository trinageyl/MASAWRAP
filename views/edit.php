<?php
include "includes/header.php";
?>
<div class="container-fluid page-header mb-5 position-relative overlay-bottom">
    <div class="d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5" style="min-height: 400px">
        <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase">Edit</h1>
    </div>
</div>
<div id="main">
    <div class="container">
        <h1 class="pg-header ta-center">
            Edit Recipe
        </h1>

        <form enctype="multipart/form-data" action="<?php $this->url('recipe/'.$recipes['id'].'/update'); ?>" method="POST" class="recipe-manage">
            <?php if (isset($_SESSION["success"]["recipe"]["update"][$recipes["id"]])): ?>
                <div class="row">
                    <div class="alert alert-success alert-dismissible fade show" role="alert" id="alert">
                        <strong><i class="fa fa-check-circle" aria-hidden="true"></i></strong> Successfully updated recipe
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION["success"]["recipe"])) unset($_SESSION["success"]["recipe"]); ?>

            <?php if (isset($_SESSION["errors"]["recipe"]["update"][$recipes["id"]]["database"])): ?>
                <div class="text-danger fs-6">Something went wrong. Please contact your administrator*</div>
            <?php endif; ?>

            <div class="mb-3">
                <?php if (isset($_SESSION["errors"]["recipe"]["update"][$recipes["id"]]["name"])): ?>
                    <div class="text-danger fs-6">Name is required *</div>
                <?php endif; ?>
                <label for="name">Recipe Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $recipes["name"]; ?>">
            </div>

            <div class="mb-3">
                <?php if (isset($_SESSION["errors"]["recipe"]["update"][$recipes["id"]]["description"])): ?>
                    <div class="text-danger fs-6">Description is required *</div>
                <?php endif; ?>
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="5"><?php echo $recipes["description"]; ?></textarea>
            </div>

            <div class="mb-3">
                <label for="ingredients">Ingredients</label>
                <textarea class="form-control" id="ingredients" name="ingredients" rows="5"><?php echo $recipes["ingredients"]; ?></textarea>
            </div>

            <div class="mb-3">
                <label for="procedure">Procedure</label>
                <textarea class="form-control" id="procedure" name="procedure" rows="5"><?php echo $recipes["procedure"]; ?></textarea>
            </div>

            <div class="mb-3">
                <label for="categories">Categories</label>
                <?php 
                $recipe_cats = explode(",", $recipes["selected_categories"]);
                ?>
                <?php foreach ($categories as $category): ?>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="categories[]" value="<?php echo $category['category_id']; ?>"
                            <?php if (in_array($category['category_id'], $recipe_cats)) echo 'checked'; ?>>
                        <label class="form-check-label">
                            <?php echo $category['category_name']; ?>
                        </label>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="mb-3">
                <?php if (isset($_SESSION["errors"]["recipe"]["update"][$recipes["id"]]["image"])): ?>
                    <div class="text-danger fs-6">Image must be of type .jpg or .png *</div>
                <?php endif; ?>
                <label for="image" class="form-label">Recipe Image</label>
                <div class="row">
                    <div class="col-md-3">
                        <img src="<?php $this->assets('images', $recipes["image"]); ?>" alt="<?php echo $recipes["image"]; ?>" class="img-fluid">
                    </div>
                    <div class="col-md-9">
                        <input class="form-control" type="file" id="image" name="image">
                    </div>
                </div>
            </div>

            <?php
                if (isset($_SESSION["errors"]["recipe"]["update"][$recipes["id"]])) {
                   unset($_SESSION["errors"]["recipe"]["update"][$recipes["id"]]);
               }
            ?>
            <input type="hidden" name="csrf_token" value="<?php echo $this->generateCSRFToken('edit-recipe-' . $recipes['id']); ?>">
            <input type="hidden" name="recipe_id" value="<?php echo $recipes['id']; ?>">
            <div class="mb-3">
                <input type="submit" value="Save Changes" class="btn btn-success">
                <input type="submit" value="Cancel" class="btn btn-secondary">
            </div>
        </form>

    </div>
</div>
<?php include "includes/footer.php"; ?>
