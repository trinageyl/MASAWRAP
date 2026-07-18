<?php
require_once "BaseController.php";
class RecipeController extends BaseController{
    private $model;

    function __construct() {
        require_once "models/RecipeModel.php";
        require_once "models/CategoriesModel.php";
        $this->model = new Recipe();
        $this->categories_model = new Categories();
    }

    function index(){
        $recipes = $this->model->get_all_recipe();
        include "views/index.php";
    }

    function recipes(){
        $recipes = $this->model->get_all_recipe();
        include "views/recipe.php";
    }

    function favorite(){
        $recipes = $this->model->get_all_recipe();
        include "views/favorites.php";
    }

    function show($id){
        $recipes = $this->model->get_recipe($id);
        include "views/product1.php";
    }

    function create(){
        $categories = $this->categories_model->get_categories();
        include "views/add.php";
    }

    function store() {
    // Verify CSRF token
    $this->verifyCSRFToken("add");

    // Perform database insert
    if ($this->model->add_recipe()) {
        // Upload file
        if (move_uploaded_file($_FILES["image"]["tmp_name"], "assets/img/" . $_FILES["image"]["name"])) {
            // Add session variable to indicate success in DB insert and file upload
            $_SESSION["success"]["recipe"]["insert"] = true;

            // Redirect to appropriate view
            if (isset($_POST["from-dashboard"])) {
                $this->redirect("user/dashboard");
            } else {
                $this->redirect("recipes");
            }

        } else {
            // Add session variable to indicate error in uploading file
            $_SESSION["errors"]["recipe"]["insert"]["upload"] = true;

            // Redirect to appropriate view
            if (isset($_POST["from-dashboard"])) {
                $this->redirect("user/dashboard");
            } else {
                $this->redirect("add");
            }
        }
    } else {
        // If there is an error in inserting the recipe, error messages are handled in the model

        // Redirect to appropriate view
        if (isset($_POST["from-dashboard"])) {
            $this->redirect("user/dashboard");
        } else {
            $this->redirect("add");
        }
    }
}


function edit($id){
    if(isset($id)){
            // Fetch the recipe data
        $categories = $this->categories_model->get_categories();
        $recipes = $this->model->get_recipe($id);

        if (isset($_SESSION["user"]) && ($_SESSION["user"]["role"] == 'chef' || $_SESSION["user"]["role"] == 'administrator')){  include "views/edit.php";
        } else {
                $this->redirect("no-access");
            }
        }
    } // Closing edit function

    // function update($id){
    //     if (!empty($_POST)){
    //         $results = $this->model->update_recipe($id);

    //         if ($results) {
    //             header("Location: https://localhost/MASAWRAP/recipes");
    //         }
    //     }
    // }

    function update($id){
                //verify token
        $this->verifyCSRFToken("edit-recipe-".$id);

                //fetch book details
        $recipe = $this->model->get_recipe($id);

                //check proper authorization
        if($_SESSION["user"]["role"] == "administrator" || ($_SESSION["user"]["role"] == "chef" && $recipe["user_id"] == $_SESSION["user"]["id"])) {
                    //perform db insert
            if($this->model->update_recipe($id)){
                        //check if there is a new image
                if(isset($_FILES["image"])){
                    move_uploaded_file($_FILES["image"]["tmp_name"], "assets/img/" . $_FILES["image"]["name"]);
                }

                        //add session variable to inidicate success in db insert and file
                $_SESSION["success"]["recipe"]["update"][$id] = true;

            }

                    //redirect to appropriate view
            if (isset($_POST["from-dashboard"])){
                $this->redirect("user/dashboard");
            } else {
                $this->redirect("edit/".$id);

            }
        } else {
            $this->redirect("no-access");

        }
    }


    // function destroy($id){
    //     $results = $this->model->delete_recipe($id);
    //     if($results){
    //         header("Location: https://localhost/MASAWRAP/recipes#recipe");
    //     }
    // }

function destroy($id) {
    // Attempt to delete the recipe and store the result
    $results = $this->model->delete_recipe($id);

    // If deletion is successful, redirect to the recipes page
    if ($results) {
        $_SESSION["success"]["recipe"]["delete"] = true;
        $image = "assets/img/".$recipe["image"];
        if(file_exists($image)){
            unlink($image);
        }

        if(isset($_POST["from-dashboard"])){
            $this->redirect("user/dashboard");
        } else {
            $this->redirect("recipes");
        }
        exit(); // Add exit after header to stop script execution
    }
}


function search() {
    if(isset($_GET["by"])){
        $by = $_GET["by"];
    } else {
        $by = "none";
    }

    $term = isset($_GET["term"]) ? $_GET["term"] : "";
    $results = $this->model->get_recipes_by($by, $term);
    include "views/search.php";
}

    // function addFavorite($recipe_id){
    // if (isset($_SESSION['user'])) {
    //     $user_id = $_SESSION['user']['id'];
    //     $result = $this->model->add_to_favorites($user_id, $recipe_id);
    //     if ($result) {
    //         header("Location: https://localhost/MASAWRAP/recipes");
    //     } else {
    //         echo "Failed to add to favorites.";
    //     }
    // } else {
    //     header("Location: https://localhost/MASAWRAP/login");
    // }

    // function showFavorites() {
    // if (isset($_SESSION['user'])) {
    //     $user_id = $_SESSION['user']['id'];
    //     $favorites = $this->model->get_user_favorites($user_id);
    //     include "views/favorites.php";
    // } else {
    //     header("Location: https://localhost/MASAWRAP/login");
    // }
}

