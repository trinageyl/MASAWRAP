<?php
session_start();


if (isset($_GET["url"])) {
    $url = explode("/", $_GET["url"]);
} else {
    $url = ["home"];
}

require_once "controllers/BaseController.php";
require_once "controllers/RecipeController.php";
require_once "controllers/CategoriesController.php";
require_once "controllers/UsersController.php";
$base_controller = new BaseController();
$recipe_controller = new RecipeController();
$categories_controller = new CategoriesController();
$users_controller = new UsersController();

if (($url[0] == "home" && !isset($url[1])) || $url == "home") {
    $recipe_controller->index();
}

else if ($url[0] == "account") {
    include "views/account.php";
}

else if ($url[0] == "recipes" && !isset($url[1])) {
    $recipe_controller->recipes();
}

else if ($url[0] == "recipe" && isset($url[1]) && ctype_digit($url[1]) && !isset($url[2])) {
    $recipe_controller->show($url[1]);
}

else if ($url[0] == "edit" && isset($url[1])) {
    $users_controller->authenticate(array("chef", "administrator"));
    $recipe_controller->edit($url[1]);
}

else if ($url[0] == "recipe" && isset($url[1]) && ctype_digit($url[1]) && $url[2] == "update" && !isset($url[3])) {
    $users_controller->authenticate(array("chef", "administrator"));
    $recipe_controller->update($url[1]);
}

else if ($url[0] == "recipe" && isset($url[1]) && ctype_digit($url[1]) && $url[2] == "delete" && !isset($url[3])) {
    $users_controller->authenticate(array("chef", "administrator"));
    $recipe_controller->destroy($url[1]);
}

else if ($url[0] == "recipes" && isset($url[1]) && $url[1] == "insert" && !isset($url[2])) {
	$users_controller->authenticate(array("chef"));
    $recipe_controller->store();
}

else if (($url[0] == "about" || $url[0] == "about") && !isset($url[1]) ){
    $base_controller->render("about");
}

else if ($url[0] == "categories" && isset($url[1]) && $url[1] == "insert" && !isset($url[2])) {
    $users_controller->authenticate(array("administrator"));
    $categories_controller->store();
}

else if (($url[0] == "contact" || $url[0] == "contact") && !isset($url[1]) ){
    $base_controller->render("contact");
}

else if ($url[0] == "add") {
    $users_controller->authenticate(array("chef"));
    $recipe_controller->create();
}

else if ($url[0] == "search") {
    $categories_controller->search();
}

else if ($url[0] == "categories" && !isset($url[1])) {
    $users_controller->authenticate(array("administrator"));
    $categories_controller->index();
}

else if ($url[0] == "categories" && isset($url[1]) && $url[1] == "update" && !isset($url[2])) {
    $users_controller->authenticate(array("administrator"));
    $categories_controller->update();
}

else if ($url[0] == "categories" && isset($url[1]) && $url[1] == "delete" && !isset($url[2])) {
    $users_controller->authenticate(array("administrator"));
    $categories_controller->destroy();
}

else if ($url[0] == "user" && $url[1] == "register" && !isset($url[2])) {
    $users_controller->show_register();
}

else if ($url[0] == "user" && $url[1] == "do_register" && !isset($url[2])) {
    $users_controller->do_register();
}

else if ($url[0] == "user" && $url[1] == "login" && !isset($url[2])) {
    $users_controller->show_login();
}

else if ($url[0] == "user" && $url[1] == "do_login" && !isset($url[2])) {
    $users_controller->do_login();
}

else if ($url[0] == "user" && $url[1] == "logout" && !isset($url[2])) {
    $users_controller->do_logout();
}

else if ($url[0] == "user" && $url[1] == "test" && !isset($url[2])) {
    echo "<pre>"; var_dump($_SESSION); echo "</pre>";
}

else if ($url[0] == "user" && $url[1] == "update" && !isset($url[2])) {
    $users_controller->authenticate(array("administrator"));
    $users_controller->update();
}

else if ($url[0] == "user" && $url[1] == "delete" && !isset($url[2])) {
    $users_controller->authenticate(array("administrator"));
    $users_controller->delete();
}

else if ($url[0] == "user" && $url[1] == "dashboard" && !isset($url[2])) {
    $users_controller->authenticate(array("user","chef","administrator"));
    $users_controller->show_dashboard();
}

else if ($url[0] == "favorites" && isset($url[1]) && $url[1] == "delete" && !isset($url[2])) {
    $users_controller->authenticate(array("user"));
    $users_controller->remove_from_favorite();
}

// Restrict access to favorites for both chefs and administrators
else if ($url[0] == "user" && $url[1] == "favorites" && !isset($url[2])) {
    // Check if the user is logged in and is not an administrator or chef
    if (isset($_SESSION['user']) && $_SESSION['user']['role'] != 'administrator' && $_SESSION['user']['role'] != 'chef') {
        $recipe_controller->favorite();
    } else {
        // Redirect admins, chefs, or unauthorized users to the no-access page
        header("Location: /no-access");
        exit();
    }
}

else if ($url[0] == "recipe" && ctype_digit($url[1]) && $url[2] == "to-favorite" && !isset($url[3])) {
    if (isset($_SESSION['user']) && $_SESSION['user']['role'] != 'administrator' && $_SESSION['user']['role'] != 'chef') {
        $user_id = $_SESSION['user']['id'];
        $users_controller->add_favorite($url[1], $user_id);
    } else {
        header("Location: /no-access");
        exit();
    }
}

// Remove from Favorites
else if ($url[0] == "recipe" && ctype_digit($url[1]) && $url[2] == "remove-favorite" && !isset($url[3])) {
    if (isset($_SESSION['user']) && $_SESSION['user']['role'] != 'administrator' && $_SESSION['user']['role'] != 'chef') {
        $user_id = $_POST['user_id'];
        $users_controller->remove_favorite($url[1], $user_id);
    } else {
        header("Location: /no-access");
        exit();
    }
}

else if ($url[0] == "no-access"  && !isset($url[1]) ){
    $base_controller->render("no-access");
}

else if ($url[0] == "hash-previous-users"  && !isset($url[1]) ){
    $connection = new mysqli("localhost","root","","db_masawrap");
    $users = $connection->query("SELECT * FROM 3b_23_users WHERE user_id IN (8,9)")->fetch_all(MYSQLI_ASSOC); //ids of previous users
    
    foreach($users as $user){
        $connection->query("UPDATE 3b_23_users SET password='".password_hash($user["password"], PASSWORD_DEFAULT)."' WHERE user_id = " . $user["user_id"]);
    }
}


else {
    $base_controller->render("404");
}
