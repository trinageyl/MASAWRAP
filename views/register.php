<?php
include "includes/header.php";
?>

<!-- Page Header Start -->
<div class="container-fluid page-header mb-5 position-relative overlay-bottom">
    <div class="d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5" style="min-height: 400px">
        <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase">Register</h1>
    </div>
</div>
<!-- Page Header End -->

<div class="container-fluid py-5">
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Basic Information</h4>
                        <p class="card-title-desc">Fill all information below</p>

                        <form enctype="multipart/form-data" action="<?php $this->url('user/do_register'); ?>" method="POST">
                            <!-- Error Display -->
                            <?php if (isset($_SESSION["errors"]["user"]["insert"]["database"])): ?>
                                <div class="text-danger fs-6">Something went wrong. Please contact your administrator*</div>
                            <?php endif; ?>

                            <div class="row">
                                <!-- First Name -->
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <?php if (isset($_SESSION["errors"]["user"]["insert"]["first_name"])): ?>
                                            <div class="text-danger fs-6">First name is required *</div>
                                        <?php endif; ?>
                                        <label for="first_name" class="mb-2">First Name</label>
                                        <input name="first_name" id="first_name" type="text" class="form-control">
                                    </div>
                                </div>

                                <!-- Last Name -->
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <?php if (isset($_SESSION["errors"]["user"]["insert"]["last_name"])): ?>
                                            <div class="text-danger fs-6">Last name is required *</div>
                                        <?php endif; ?>
                                        <label for="last_name" class="mb-2">Last Name</label>
                                        <input name="last_name" id="last_name" type="text" class="form-control">
                                    </div>
                                </div>

                                <!-- Username -->
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <?php if (isset($_SESSION["errors"]["user"]["insert"]["username"])): ?>
                                            <div class="text-danger fs-6">Username is required *</div>
                                        <?php endif; ?>
                                        <label for="username" class="mb-2">Username</label>
                                        <input name="username" id="username" type="text" class="form-control">
                                    </div>
                                </div>

                                <!-- Password -->
                                <div class="col-sm-6">
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
                                        <label for="password" class="mb-2">Password</label>
                                        <input name="password" id="password" type="password" class="form-control">
                                    </div>
                                </div>

                                <!-- Role -->
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="role" class="mb-2">Role</label>
                                        <select class="form-select" id="role" name="role">
                                            <option value="administrator">Administrator</option>
                                            <option value="chef">Chef</option>
                                            <option value="user">User</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- CSRF Token -->
                            <input type="hidden" name="csrf_token" value="<?php echo $this->generateCSRFToken('user-register'); ?>">

                            <!-- Submit Buttons -->
                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary me-1 waves-effect waves-light">Register</button>
                                <button type="reset" class="btn btn-secondary waves-effect">Cancel</button>
                            </div>
                        </form>

                        <?php
                        // Clear errors
                        if (isset($_SESSION["errors"]["user"]["insert"])) {
                            unset($_SESSION["errors"]["user"]["insert"]);
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include "includes/footer.php";
?>
