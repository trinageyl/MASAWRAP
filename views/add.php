<?php
include "includes/header.php";
?>

<div class="container-fluid page-header mb-5 position-relative overlay-bottom">
    <div class="d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5" style="min-height: 400px">
        <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase">ADD</h1>
    </div>
</div>

<div id="main">
    <div class="container-fluid">
        <div class="column">
            <h1 class="pg-header ta-center text-uppercase">
                Add a Recipe
            </h1>

            <form enctype="multipart/form-data" action="https://localhost/MASAWRAP/recipes/insert" method="POST" class="recipe-manage">

                <!-- Show error messages -->
                <?php if (isset($_SESSION["errors"]["recipe"]["insert"]["database"])): ?>
                    <div class="text-danger fs-6">
                        Something went wrong. Please contact your administrator*
                    </div>
                <?php endif; ?>

                <!-- Basic Information -->
                <div class="mb-3">
                    <?php if (isset($_SESSION["errors"]["recipe"]["insert"]["name"])): ?>
                        <div class="text-danger fs-6">Product Name is required *</div>
                    <?php endif; ?>
                    <label for="productname">Product Name</label>
                    <input id="productname" name="name" type="text" class="form-control">
                </div>

                <div class="mb-3">
                    <?php if (isset($_SESSION["errors"]["recipe"]["insert"]["description"])): ?>
                        <div class="text-danger fs-6">Description is required *</div>
                    <?php endif; ?>
                    <label for="productdesc">Product Description</label>
                    <textarea class="form-control" name="description" id="productdesc" rows="5"></textarea>
                </div>

                <!-- Ingredients -->
                <div class="mb-3">
                    <?php if (isset($_SESSION["errors"]["recipe"]["insert"]["ingredients"])): ?>
                        <div class="text-danger fs-6">Ingredients are required *</div>
                    <?php endif; ?>
                    <label for="ingredients">Ingredients</label>
                    <textarea class="form-control" name="ingredients" id="ingredients" rows="5"></textarea>
                </div>

                <!-- Procedure -->
                <div class="mb-3">
                    <?php if (isset($_SESSION["errors"]["recipe"]["insert"]["procedure"])): ?>
                        <div class="text-danger fs-6">Procedure is required *</div>
                    <?php endif; ?>
                    <label for="procedure">Procedure</label>
                    <textarea class="form-control" name="procedure" id="procedure" rows="5"></textarea>
                </div>

                <!-- Categories -->
                <div class="mb-3">
                    <label for="categories">Categories</label>
                    <?php foreach ($categories as $category): ?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="categories[]" value="<?php echo $category['category_id']; ?>">
                            <label class="form-check-label">
                                <?php echo $category["category_name"]; ?>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Image -->
                <div class="mb-3">
                    <?php if (isset($_SESSION["errors"]["recipe"]["insert"]["image"])): ?>
                        <div class="text-danger fs-6">Image must be of type .jpg or .png *</div>
                    <?php endif; ?>
                    <label for="image">Product Image</label>
                    <input type="file" class="form-control" name="image" accept=".png,.jpg,.jpeg">
                </div>

                <input type="hidden" name="csrf_token" value="<?php echo $this->generateCSRFToken("add"); ?>">

                <?php
                 if (isset($_SESSION["errors"]["recipe"]["insert"])) {
                     unset($_SESSION["errors"]["recipe"]["insert"]);
                 }
                ?>

                <div class="mb-3">
                    <input type="submit" value="Save Changes" class="btn btn-primary">
                    <input type="submit" value="Cancel" class="btn btn-secondary">
                </div>
            </form>
        </div>
    </div>
</div>

<?php include "includes/footer.php"; ?>
