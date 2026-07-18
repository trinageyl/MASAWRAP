<?php
include "includes/header.php";
?>

<!-- Page Header Start -->
<div class="container-fluid page-header mb-5 position-relative overlay-bottom">
    <div class="d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5" style="min-height: 400px">
        <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase">Login</h1>
    </div>
</div>

<div id="main">
    <div class="column">
        <h1 class="pg-header ta-center">Login</h1>

        <form action="https://localhost/MASAWRAP/user/do_login" method="POST" enctype="multipart/form-data" class="recipe-manage">
            <?php if (isset($_SESSION["errors"]["user"]["login"])): ?>
                <div class="text-danger fs-6">Username or password incorrect*</div>
            <?php endif; ?>

            <div class="mb-3">
                <label for="username">Username</label>
                <input name="username" type="text" class="form-control" id="username">
            </div>

            <div class="mb-3">
                <label for="password">Password</label>
                <input name="password" type="password" class="form-control" id="password">
            </div>

            <?php
                // Clear login error after displaying it
                if (isset($_SESSION["errors"]["user"]["login"])) {
                    unset($_SESSION["errors"]["user"]["login"]);
                }
            ?>

            <div class="mb-3">
                <input type="submit" value="Login" class="cstm-btn">
                <button type="button" onclick="window.location.href='cancel-url';" class="cstm-btn-secondary">Cancel</button>
            </div>
        </form>
    </div>
</div>

<?php 
include "includes/footer.php";
require_once "includes/java.php"
?>