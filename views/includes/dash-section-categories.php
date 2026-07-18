<div id="categories" class="section">
    <div class="container">
        <?php
        if (isset($_SESSION["success"]["category"])):
            if (isset($_SESSION["success"]["category"]["insert"])) {
                $msg = "Successfully added a new category";
            } elseif (isset($_SESSION["success"]["category"]["update"])) {
                $msg = "Successfully updated category";
            } elseif (isset($_SESSION["success"]["category"]["delete"])) {
                $msg = "Deleted category successfully";
            }
            ?>
            <div class="row">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong><i class="fa fa-check-circle me-2"></i></strong><?php echo $msg; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
            <?php unset($_SESSION["success"]["category"]); 
        endif; ?>

            <div class="row mb-4">
                <div class="col">
                    <h1 class="pg-header">Categories</h1>
                </div>
                <div class="container">
                    <div class="col d-flex justify-content-end align-items-center mb-4">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-category-modal">
                            Add Category
                        </button>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="add-category-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Category</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="https://localhost/MASAWRAP/categories/insert" method="POST" id="add-category">
                                <div class="mb-3">
                                    <?php if (isset($_SESSION["errors"]["category"]["insert"]["name"])): ?>
                                        <div class="text-danger fs-6">Category Name is required *</div>
                                    <?php endif; ?>
                                    <label for="title">Category</label>
                                    <input type="text" class="form-control" id="title" name="category_name">
                                </div>
                                <div class="mb-3">
                                    <?php if (isset($_SESSION["errors"]["category"]["insert"]["description"])): ?>
                                        <div class="text-danger fs-6">Category description is required *</div>
                                    <?php endif; ?>
                                    <label for="description">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="5" ></textarea>
                                </div>
                                <input type="hidden" name="csrf_token" value="<?php echo $this->generateCSRFToken("add-a-category"); ?>">
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" form="add-category" class="btn btn-primary">Submit</button> 
                                </div>
                            </form>

                        </div>

                    </div>
                </div>
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Category</th>
                        <th>Description</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $category): ?>
                        <tr>
                            <td><?php echo $category["category_id"]; ?></td>
                            <td><?php echo $category["category_name"]; ?></td>
                            <td><?php echo $category["description"]; ?></td>
                            <td class="text-center">
                                <button type="button" class="btn btn-warning mx-1" data-bs-toggle="modal" data-bs-target="#edit-category-<?php echo $category["category_id"]; ?>">Edit</button>
                                <button type="button" class="btn btn-danger mx-1" data-bs-toggle="modal" data-bs-target="#delete-category-<?php echo $category["category_id"]; ?>">Delete</button>
                            </td>
                        </tr>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="edit-category-<?php echo $category["category_id"]; ?>" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Category</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="<?php $this->url(); ?>/categories/update" method="POST" id="edit-category-form-<?php echo $category["category_id"]; ?>">
                                            <div class="mb-3">
                                                <?php if (isset($_SESSION["errors"]["category"]["update"][$category["category_id"]]["name"])): ?>
                                                    <div class="text-danger fs-6">Category Name is required *</div>
                                                <?php endif; ?>
                                                <label>Category Name</label>
                                                <input type="text" class="form-control" name="category_name" value="<?php echo $category["category_name"]; ?>">
                                            </div>
                                            <div class="mb-3">
                                                <?php if (isset($_SESSION["errors"]["category"]["update"][$category["category_id"]]["description"])): ?>
                                                    <div class="text-danger fs-6">Category description is required *</div>
                                                <?php endif; ?>
                                                <label>Description</label>
                                                <textarea class="form-control" name="description" rows="3"><?php echo $category["description"]; ?></textarea>
                                            </div>
                                            <input type="hidden" name="category_id" value="<?php echo $category["category_id"]; ?>">
                                            <input type="hidden" name="csrf_token" value="<?php echo $this->generateCSRFToken('edit-category-' . $category["category_id"]); ?>">
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" form="edit-category-form-<?php echo $category["category_id"]; ?>" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Delete Modal -->
                        <div class="modal fade" id="delete-category-<?php echo $category["category_id"]; ?>" tabindex="-1" aria-labelledby="deleteCategoryModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Confirm Deletion</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete <?php echo $category["category_name"]; ?>?
                                    </div>
                                    <div class="modal-footer">
                                        <form action="<?php $this->url(); ?>/categories/delete" method="POST" id="delete-category-form-<?php echo $category["category_id"]; ?>">
                                            <input type="hidden" name="category_id" value="<?php echo $category["category_id"]; ?>">
                                            <input type="hidden" name="csrf_token" value="<?php echo $this->generateCSRFToken('delete-category-' . $category["category_id"]); ?>">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
