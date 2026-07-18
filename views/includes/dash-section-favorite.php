<div id="favorites" class="section">
    <div class="container">
        <?php if (isset($_SESSION["success"]["favorite"])): ?>
            <?php
                $msg = '';
                if (isset($_SESSION["success"]["favorite"]["insert"])) {
                    $msg = "Recipe successfully added to favorites.";
                } elseif (isset($_SESSION["success"]["favorite"]["delete"])) {
                    $msg = "Recipe successfully removed from favorites";
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
                <h1 class="pg-header">
                    My Favorites
                </h1>
            </div>
            <?php if (isset($_SESSION['user'])): ?>
                <?php if (!empty($favorite_items)): ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Image</th>
                                <th scope="col">Name</th>
                                <th scope="col">Description</th>
                                <!-- <th scope="col">Categories</th> -->
                                <th scope="col" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $userHasFavorites = false;
                            foreach ($favorite_items as $items): 
    
                            ?>
                                <tr>
                                    <td><img class="w-100 rounded-circle mb-3 mb-sm-0" src="<?php $this->assets('img',$items['image']); ?>" alt="<?php echo $items["name"]; ?>" style="max-width: 40%"></td>
                                    <td><?php echo $items["name"]; ?></td>
                                    <td><?php echo $items["description"]; ?></td>
                                    <!-- <td><?php echo $recipe["categories"]; ?></td> -->
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="http://localhost/MASAWRAP/recipe/<?php echo $items['recipe_id']; ?>" class="btn btn-primary mx-1">View Recipe</a>
                                            <button type="button" class="btn btn-danger mx-1" data-bs-toggle="modal" data-bs-target="#remove-favorite-modal-<?php echo $items['favorite_id']; ?>">Remove</button>
                                        </div>
                                        <div class="modal fade" id="remove-favorite-modal-<?php echo $items['favorite_id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Remove Favorite</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to remove <strong><?php echo $items['name']; ?></strong> from your favorites?
                                                        <form action="http://localhost/MASAWRAP/favorites/delete" method="POST" id="remove-favorite-<?php echo $items['favorite_id']; ?>">
                                                            <input type="hidden" name="favorite_id" value="<?php echo $items["favorite_id"]; ?>">
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" form="remove-favorite-<?php echo $items['favorite_id']; ?>" class="btn btn-danger">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php 
                            
                            endforeach; 
                            ?>
                        </tbody>
                    </table>

                <?php else: ?>
                    <p>You don't have any favorite recipes yet.</p>
                <?php endif; ?>
            <?php else: ?>
                <p>Please log in to view your favorite recipes.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
