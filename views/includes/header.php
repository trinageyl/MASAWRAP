<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>MASA WRAP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?php $this->assets('img', 'favicon.ico'); ?>">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="<?php $this->assets('css', 'bootstrap.css'); ?>">
    <link rel="stylesheet" href="<?php $this->assets('css', 'style.min.css'); ?>">
    <link rel="stylesheet" href="<?php $this->assets('lib', 'font-awesome/css/font-awesome.min.css'); ?>">
    <link rel="stylesheet" href="<?php $this->assets('lib', 'owlcarousel/assets/owl.carousel.min.css'); ?>">
    <link rel="stylesheet" href="<?php $this->assets('lib', 'tempusdominus/css/tempusdominus-bootstrap-4.min.css'); ?>">
</head>
<body>

<?php
// Safely get the current user's role
$role = $_SESSION['user']['role'] ?? null;
?>

<!-- Navbar Start -->
<div id="header">
    <div class="container-fluid p-0 nav-bar">
        <nav class="navbar navbar-expand-lg navbar-dark py-2">

            <a href="<?php $this->url('home'); ?>" class="navbar-brand px-lg-4 m-0">
                <img class="w-25" src="<?php $this->assets('img', 'logoo.png'); ?>" alt="MASA WRAP Logo">
            </a>

            <button
                type="button"
                class="navbar-toggler"
                data-toggle="collapse"
                data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">

                <ul class="navbar-nav ml-auto flex-wrap">

                    <li>
                        <a href="<?php $this->url('home'); ?>" class="nav-item nav-link">
                            Home
                        </a>
                    </li>

                    <li>
                        <a href="<?php $this->url('recipes'); ?>" class="nav-item nav-link">
                            Recipes
                        </a>
                    </li>

                    <li>
                        <a href="<?php $this->url('about'); ?>" class="nav-item nav-link">
                            About
                        </a>
                    </li>

                    <li>
                        <a href="<?php $this->url('contact'); ?>" class="nav-item nav-link">
                            Contact
                        </a>
                    </li>

                    <?php if (!isset($_SESSION["user"])): ?>

                        <li>
                            <a href="<?php $this->url('user/register'); ?>" class="nav-item nav-link">
                                Register
                            </a>
                        </li>

                        <li>
                            <a href="<?php $this->url('user/login'); ?>" class="nav-item nav-link">
                                Login
                            </a>
                        </li>

                    <?php else: ?>

                        <?php if ($role === "chef"): ?>

                            <li>
                                <a href="<?php $this->url('add'); ?>" class="nav-item nav-link">
                                    Add
                                </a>
                            </li>

                        <?php elseif ($role === "user"): ?>

                            <li>
                                <a href="<?php $this->url('user/favorites'); ?>" class="nav-item nav-link">
                                    Favorites
                                </a>
                            </li>

                        <?php endif; ?>

                        <li>
                            <a href="<?php $this->url('user/dashboard'); ?>" class="nav-item nav-link">
                                Dashboard
                            </a>
                        </li>

                        <li>
                            <a href="<?php $this->url('user/logout'); ?>" class="nav-item nav-link">
                                Logout
                            </a>
                        </li>

                        <?php if ($role === "administrator"): ?>
                            <!-- Administrator-only menu items go here -->
                        <?php endif; ?>

                    <?php endif; ?>

                </ul>

            </div>

        </nav>
    </div>
</div>
<!-- Navbar End -->

<!-- Main Content Start -->
<div class="container main-content">
    <!-- Your page content -->
</div>
<!-- Main Content End -->

</body>
</html>