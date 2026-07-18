<div id="users" class="section">
    <div class="container">
        <?php
        if (isset($_SESSION["success"]["user"])) :
            if (isset($_SESSION["success"]["user"]["insert"])) {
                $msg = "Successfully added a new user";
            }

            if (isset($_SESSION["success"]["user"]["update"])) {
                $msg = "Successfully updated user";
            }

            if (isset($_SESSION["success"]["user"]["delete"])) {
                $msg = "Deleted user successfully";
            }
            ?>
            <div class="row">
                <div class="alert alert-success alert-dismissible fade show" role="alert" id="alert">
                    <strong><i class="fa fa-check-circle me-2" aria-hidden="true"></i></strong><?php echo $msg; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            <?php
            unset($_SESSION["success"]["user"]);
        endif;
        ?>

        <div class="row">
            <div class="col">
                <h1 class="pg-header">Users</h1>
            </div>
            <div class="col d-flex justify-content-end align-items-center">
                <div>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-user-modal">
                        Add User
                    </button>

                    <!-- Add User Modal -->
                    <div class="modal fade" id="add-user-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Add User</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form enctype="multipart/form-data" action="<?php $this->url(); ?>/user/do_register" method="POST" class="recipe-manage" id="add-user">
                                        <?php if (isset($_SESSION["errors"]["user"]["insert"]["database"])): ?>
                                            <div class="text-danger fs-6">Something went wrong. Please contact your administrator*</div>
                                        <?php endif; ?>
                                        <div class="mb-3">
                                            <?php if (isset($_SESSION["errors"]["user"]["insert"]["first_name"])): ?>
                                                <div class="text-danger fs-6">First name is required *</div>
                                            <?php endif; ?>
                                            <label for="title">First Name</label>
                                            <input type="text" class="form-control" id="title" name="first_name">
                                        </div>

                                        <div class="mb-3">
                                            <?php if (isset($_SESSION["errors"]["user"]["insert"]["last_name"])): ?>
                                                <div class="text-danger fs-6">Last name is required *</div>
                                            <?php endif; ?>
                                            <label for="title">Last Name</label>
                                            <input type="text" class="form-control" id="title" name="last_name">
                                        </div>

                                        <div class="mb-3">
                                            <?php if (isset($_SESSION["errors"]["user"]["insert"]["username"])): ?>
                                                <div class="text-danger fs-6">Username is required *</div>
                                            <?php endif; ?>
                                            <label for="title">Username</label>
                                            <input type="text" class="form-control" id="title" name="username">
                                        </div>

                                        <div class="mb-3">
                                            <?php if (isset($_SESSION["errors"]["user"]["insert"]["password"])): ?>
                                                <div class="text-danger fs-6">Password is required and must at least:
                                                    <ul>
                                                        <li>be 8 characters</li>
                                                        <li>contain one digit</li>
                                                        <li>contain one lowercase character</li>
                                                        <li>contain one uppercase character</li>
                                                    </ul>
                                                </div>
                                            <?php endif; ?>
                                            <label for="title">Password</label>
                                            <input type="password" class="form-control" id="title" name="password">
                                        </div>

                                        <div class="mb-3">
                                            <label for="title">Role</label>
                                            <select class="form-select" name="role">
                                                <option value="user">User</option>
                                                <option value="chef">Chef</option>
                                                <option value="administrator">Administrator</option>
                                            </select>
                                        </div>

                                        <input type="hidden" name="from-dashboard" value="true">
                                        <input type="hidden" name="csrf_token" value="<?php echo $this->generateCSRFToken("user-register"); ?>">
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" form="add-user" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Users Table -->
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Username</th>
                    <th scope="col">Role</th>
                    <th scope="col" class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <th scope="row"><?php echo $user["user_id"]; ?></th>
                        <td><?php echo $user["first_name"]; ?></td>
                        <td><?php echo $user["last_name"]; ?></td>
                        <td><?php echo $user["username"]; ?></td>
                        <td><?php echo $user["role"]; ?></td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <button type="button" class="btn btn-warning mx-1" data-bs-toggle="modal" data-bs-target="#user-modal-<?php echo $user["user_id"]; ?>">Edit</button>
                                <button type="button" class="btn btn-danger mx-1" data-bs-toggle="modal" data-bs-target="#delete-user-modal-<?php echo $user["user_id"]; ?>">Delete</button>
                            </div>

                            <!-- Edit User Modal -->
                            <div class="modal fade" id="user-modal-<?php echo $user["user_id"]; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5">Edit User</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="<?php $this->url(); ?>user/update" method="POST" id="edit-user-<?php echo $user["user_id"]; ?>">
                                                    <div class="mb-3">
                                                        <?php if(isset($_SESSION["errors"]["user"]["update"][$user["user_id"]]["first_name"])): ?>
                                                            <div class="text-danger fs-6">First Name is required *</div>
                                                        <?php endif; ?>
                                                        <label>First Name</label>
                                                        <input type="text" class="form-control" name="first_name" value="<?php echo $user["first_name"]; ?>">
                                                    </div>
                                                    <div class="mb-3">
                                                        <?php if(isset($_SESSION["errors"]["user"]["update"][$user["user_id"]]["last_name"])): ?>
                                                            <div class="text-danger fs-6">Last Name is required *</div>
                                                        <?php endif; ?>
                                                        <label>Last Name</label>
                                                        <input type="text" class="form-control" name="last_name" value="<?php echo $user["last_name"]; ?>">
                                                    </div>
                                                    <div class="mb-3">
                                                        <?php if(isset($_SESSION["errors"]["user"]["update"][$user["user_id"]]["username"])): ?>
                                                            <div class="text-danger fs-6">Username is required *</div>
                                                        <?php endif; ?>
                                                        <label>Username</label>
                                                        <input type="text" class="form-control-plaintext" name="username" value="<?php echo $user["username"]; ?>" disabled>
                                                    </div>
                                                    <div class="mb-3">
                                                        <?php if(isset($_SESSION["errors"]["user"]["update"][$user["user_id"]]["password"])): ?>
                                                            <div class="text-danger fs-6">Password is required and must at least:
                                                                <ul>
                                                                    <li>be 8 characters </li>
                                                                    <li>contain one digit</li>
                                                                    <li>contain one lowercase character</li>
                                                                    <li>contain one uppercase character</li>
                                                                </ul>
                                                            </div>
                                                        <?php endif; ?>
                                                        <label>New Password</label>
                                                        <input type="password" class="form-control" name="password" value="">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="title">Role</label>
                                                        <select class="form-select" aria-label="" name="role" disabled>
                                                            <option value="seller" <?php if($user['role'] == 'seller'):?> selected <?php endif; ?>>Seller</option>
                                                            <option value="buyer" <?php if($user['role'] == 'buyer'):?> selected <?php endif; ?>>Buyer</option>
                                                            <option value="administrator" <?php if($user['role'] == 'administrator'):?> selected <?php endif; ?>>Administrator</option>
                                                        </select>
                                                    </div>

                                                    <input type="hidden" name="user_id" value="<?php echo $user["user_id"]; ?>">
                                                    <input type="hidden" name="from-admin" value="true">
                                                    <input type="hidden" name="csrf_token" value="<?php echo $this->generateCSRFToken('user-update-' . $user["user_id"]); ?>">
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" form="edit-user-<?php echo $user["user_id"]; ?>" class="btn btn-primary">Edit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <!-- Delete User Modal -->
                            <div class="modal fade" id="delete-user-modal-<?php echo $user["user_id"]; ?>" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5">Delete User</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="<?php $this->url(); ?>/user/delete" method="POST" class="user-delete-form">
                                                <p>Are you sure you want to delete this user?</p>
                                                <input type="hidden" name="user_id" value="<?php echo $user["user_id"]; ?>">
                                                <input type="hidden" name="csrf_token" value="<?php echo $this->generateCSRFToken("user-delete"); ?>">
                                                <button type="submit" class="btn btn-danger">Delete</button>
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
    </div>
</div>
