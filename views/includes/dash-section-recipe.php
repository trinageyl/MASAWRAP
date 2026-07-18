<div id="recipes" class="section">
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
            <div class="col">
                <h1 class="pg-header">Recipes</h1>
            </div>
            <?php if ($_SESSION["user"]["role"] == "chef"): ?>
                <div class="col d-flex justify-content-end align-items-center">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-recipe-modal">
                        Add Recipe
                    </button>
                </div>
            <?php endif; ?>
        </div>

        <!-- Add Recipe Modal -->
        <div class="modal fade" id="add-recipe-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Recipe</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
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

                <input type="hidden" name="from-dashboard" value="true">
                <input type="hidden" name="csrf_token" value="<?php echo $this->generateCSRFToken("add"); ?>">

                <div class="mb-3">
                    <input type="submit" value="Save Changes" class="btn btn-primary">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
                </div>
            </div>
        </div>

        <!-- Recipe List -->
        <?php if (!empty($recipes)): ?>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Categories</th>
                        <th scope="col" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recipes as $recipe): ?>
                        <tr>
                            <td><img class="w-100 rounded-circle mb-3 mb-sm-0" src="<?php $this->assets('img',$recipe['image']); ?>" alt="<?php echo $recipe["name"]; ?>" style="max-width: 40%; max-height: 40%;"></td>
                            <td><?php echo $recipe["name"]; ?></td>
                            <td><?php echo $recipe["description"]; ?></td>
                            <td><?php echo $recipe["categories"]; ?></td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <button type="button" class="btn btn-warning mx-1" data-bs-toggle="modal" data-bs-target="#recipe-modal-<?php echo $recipe["id"]; ?>">
                                        Edit
                                    </button>

                                    <button type="button" class="btn btn-danger mx-1" data-bs-toggle="modal" data-bs-target="#delete-recipe-modal-<?php echo $recipe["id"]; ?>">
                                        Delete
                                    </button>
                                </div>

                                <!-- Edit Recipe Modal -->
                                <div class="modal fade" id="recipe-modal-<?php echo $recipe["id"]; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5">Edit Recipe</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="https://localhost/MASAWRAP/recipe/<?php echo $recipe["id"]; ?>/update" method="POST" enctype="multipart/form-data">
                                                        <?php 
                                                        ?>
                                                        <div class="row">
                                                            <!-- Ingredients Field -->
                                                            <div class="col-sm-6">
                                                                <div class="form-group mb-3">
                                                                    <?php if (isset($_SESSION["errors"]["recipe"]["update"][$recipe["id"]]["name"])): ?>
                                                                        <div class="text-danger fs-6">Name is required *</div>
                                                                    <?php endif; ?>
                                                                    <label for="productname" class="mb-2">Product Name</label>
                                                                    <input id="productname" name="name" type="text" class="form-control" value="<?php echo $recipe["name"]?>">
                                                                </div>
                                                            </div>

                                                            <!-- Procedure Field -->
                                                            <div class="col-sm-6">
                                                                <div class="form-group mb-3">
                                                                    <?php if (isset($_SESSION["errors"]["recipe"]["update"][$recipe["id"]]["description"])): ?>
                                                                        <div class="text-danger fs-6">Description is required *</div>
                                                                    <?php endif; ?>
                                                                    <label for="productdesc" class="mb-2">Product Description</label>
                                                                    <textarea class="form-control" name="description" id="description" rows="5"><?php echo $recipe["description"]?></textarea>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="form-group mb-3">
                                                                    <?php if (isset($_SESSION["errors"]["recipe"]["update"][$recipe["id"]]["ingredients"])): ?>
                                                                        <div class="text-danger fs-6">Ingredients is required *</div>
                                                                    <?php endif; ?>
                                                                    <label for="ingredients" class="mb-2">Ingredients</label>
                                                                    <textarea class="form-control" name="ingredients" id="ingredients" rows="5"><?php echo $recipe["ingredients"]?></textarea>
                                                                </div>
                                                            </div>

                                                            <!-- Move the Product Description to the Right Column -->
                                                            <div class="col-sm-6">
                                                                <div class="form-group mb-3">
                                                                    <?php if (isset($_SESSION["errors"]["recipe"]["update"][$recipe["id"]]["procedure"])): ?>
                                                                        <div class="text-danger fs-6">Procedure is required *</div>
                                                                    <?php endif; ?>
                                                                    <label for="procedure" class="mb-2">Procedure</label>
                                                                    <textarea class="form-control" name="procedure" id="procedure" rows="5"><?php echo $recipe["procedure"]?></textarea>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                        <label for="categories">Categories:</label>
                                                        <?php foreach($categories as $category): ?>
                                                            <div class="form-check">
                                                                <input 
                                                                    class="form-check-input" 
                                                                    type="checkbox" 
                                                                    id="category-<?php echo $category['category_id']; ?>" 
                                                                    name="categories[]" 
                                                                    value="<?php echo $category['category_id']; ?>"
                                                                    <?php 
                                                                        $selected_categories = isset($recipes['selected_categories']) 
                                                                            ? explode(',', $recipes['selected_categories']) 
                                                                            : []; 
                                                                        if (in_array($category['category_id'], $selected_categories)) 
                                                                            echo 'checked'; 
                                                                    ?>
                                                                >
                                                                <label class="form-check-label" for="category-<?php echo $category['category_id']; ?>">
                                                                    <?php echo $category['category_name']; ?>
                                                                </label>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                        
                                                        <div class="row">
                                                            <!-- Move the Product Image to the Right Column -->
                                                            <div class="col-sm-6">
                                                                <div class="form-group mb-3">
                                                                    <?php if (isset($_SESSION["errors"]["recipe"]["update"][$recipe["id"]]["image"])): ?>
                                                                        <div class="text-danger fs-6">Product Image is required *</div>
                                                                    <?php endif; ?>
                                                                    <label class="mb-2">Product Image</label> <br>
                                                                    <input type="file" name="image" accept=".png,.jpg,.jpeg">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <button type="submit" value="edit" class="btn btn-success me-1 waves-effect waves-light">Save Changes</button>
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <input type="hidden" name="csrf_token" value="<?php echo $this->generateCSRFToken("edit-recipe-" . $recipe['id']); ?>">
                                                    <input type="hidden" name="from-dashboard" value="true">
                                                    <input type="hidden" name="recipe_id" value="<?php echo $recipe['id']; ?>">
                                                    </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <!-- Delete Recipe Modal -->
                                <div class="modal fade" id="delete-recipe-modal-<?php echo $recipe["id"]; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5">Delete Recipe</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to delete this recipe?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <form action="<?php $this->url(); ?>recipe/<?php echo $recipe['id']; ?>/delete" method="POST">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <input type="hidden" name="delete" value="true">
                                                    <input type="hidden" name="from-dashboard" value="true">
                                                    <button type="submit" class="btn btn-danger font-weight-bold py-2 px-4">Delete Recipe</button> 
                                                </form>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No recipes available.</p>
        <?php endif; ?>
    </div>
</div>
