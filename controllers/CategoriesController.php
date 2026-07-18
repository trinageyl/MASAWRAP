<?php
require_once "BaseController.php";
class CategoriesController extends BaseController {

    private $model;

    function __construct() {
        require_once "models/CategoriesModel.php";
        $this->model = new Categories();
    }

    function index(){
        $categories = $this->model->get_categories();
        include "views/categories.php";
    }

    function store(){
        $this->verifyCSRFToken("add-a-category");
        
        if($this->model->add_category()) {
            $_SESSION["success"]["category"]["insert"] = true;
        }

        $this->redirect("user/dashboard");
    }

    // function update(){
    //     if(!empty($_POST)){
    //         $results = $this->model->update_category($_POST["category_id"]);
    //         if($results){
    //             header("Location: https://localhost/MASAWRAP/categories");
    //         }
    //     }
    // }

    function update(){
        $this->verifyCSRFToken("edit-category-".$_POST["category_id"]);
        
        if($this->model->update_category($_POST["category_id"])){
            $_SESSION["success"]["category"]["update"] = true;
        } else {
            $_SESSION["errors"]["category"]["update"][$_POST["category_id"]]["upload"] = true;
        }

        $this->redirect("user/dashboard");
    }

    function destroy() {
        $this->verifyCSRFToken("delete-category-".$_POST["category_id"]);

        if($this->model->delete_category($_POST["category_id"])){
            $_SESSION["success"]["category"]["delete"] = true;
        }

        $this->redirect("user/dashboard");
    }

    // function recipes(){
    //     $recipes = $this->model->get_all_recipe();
    //     include "views/recipe.php";
    // }

    // function create(){
    //     include "views/add.php";
    // }
}
