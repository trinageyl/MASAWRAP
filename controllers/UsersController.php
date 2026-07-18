<?php
require_once "BaseController.php";
class UsersController extends BaseController{

    private $model;
    // private $recipeModel;

    function __construct() {
        require_once "models/UsersModel.php";
        require_once "models/RecipeModel.php"; // Include RecipeModel here
        require_once "models/CategoriesModel.php";
        $this->users_model = new Users();
        $this->recipe_model = new Recipe(); // Initialize RecipeModel
        $this->categories_model = new Categories();
    }

    function show_register(){
        include "views/register.php";
    }

    // function do_register(){
    //     $result = $this->model->add_user();

    //     if ($result){
    //         header("Location:https://localhost/MASAWRAP");
    //     } else {
    //         header("Location:https://localhost/MASAWRAP/user/register");
    //     }
    // }

    function do_register(){
        $this->verifyCSRFToken("user-register");

        
        if($this->users_model->add_user()) {
            $_SESSION["success"]["user"]["insert"] = true;
            if(isset($_POST["from-dashboard"])){
                $this->redirect("user/dashboard");
            } else {
                $this->do_login();
            }
        } else {
            if(isset($_POST["from-dashboard"])){
                $this->redirect("user/dashboard");
            } else {
                $this->redirect("user/register");
            }
        }
    }

    function show_login(){
        include "views/login.php";
    }

    function do_login(){
        $result = $this->users_model->log_user_in();

        if(!is_null($result)){
            $_SESSION["user"]["first_name"] = $result["first_name"];
            $_SESSION["user"]["last_name"] = $result["last_name"];
            $_SESSION["user"]["id"] = $result["user_id"];
            $_SESSION["user"]["role"] = $result["role"];
            $this->redirect("user/dashboard");
        } else {
            $this->redirect("user/login");
        }
    }

    function authenticate($roles){
        // Allow admin to bypass the restriction
        // if (isset($_SESSION["user"]) && $_SESSION["user"]["role"] === 'administrator') {
        //     return; // Admin has full access, so do nothing
        // }

        // Check if the user's role is in the allowed roles
        if (!isset($_SESSION["user"]) || !in_array($_SESSION["user"]["role"], $roles)) {
            // Redirect to no-access page if the role is not allowed
            header("Location: https://localhost/MASAWRAP/no-access");
            die();
        }
    }

    function do_logout(){
        unset($_SESSION["user"]);
        header("Location:https://localhost/MASAWRAP");
    }

    function add_favorite($recipe, $user_id) {
        $result = $this->users_model->store_favorite($recipe, $user_id);

        if ($result) {
            $_SESSION["success"]["favorite"]["insert"] = true;

        // Redirect to the same dashboard or recipes page to reload the sidebar
            header("Location: http://localhost/MASAWRAP/user/dashboard");
            exit();
        }
    }


    function remove_from_favorite() {
        // Use the RecipeModel to remove the favorite
        $result = $this->users_model->remove_favorite();

        if ($result) {
            $_SESSION["success"]["favorite"]["delete"] = true;

            // Redirect to the favorites page if successful
            header("Location: http://localhost/MASAWRAP/user/dashboard");
            exit();
        } else {
            // Handle error
            echo "Error removing recipe from favorites.";
        }
    }

    function show_dashboard(){
        $categories = $this->categories_model->get_categories();

        if($_SESSION["user"]["role"] == "administrator"){
            $recipes = $this->recipe_model->get_all_recipe();
            $users = $this->users_model->get_all_users();
        }

        if ($_SESSION["user"]["role"] == "chef") {
            $recipes = $this->recipe_model->get_recipe_by_role($_SESSION["user"]["id"]);
        }

        if($_SESSION["user"]["role"] == "user"){
            $favorite_items = $this->users_model->get_favorite_items();
        }

        include "views/includes/admin-header.php";
        include "views/dashboard-".$_SESSION["user"]["role"].".php";
        include "views/includes/admin-footer.php";
    }

    function delete(){
        if($this->users_model->destroy()){
            $_SESSION["success"]["user"]["delete"] = true;
        }

        $this->redirect("user/dashboard");
    }

    function update(){
        $this->verifyCSRFToken("user-update-".$_POST["user_id"]);
        if($this->users_model->update($_POST["user_id"])){
            $_SESSION["success"]["user"]["update"] = true;
        }

        $this->redirect("user/dashboard");
    }
}
?>
