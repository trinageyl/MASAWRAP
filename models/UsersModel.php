<?php
require_once "BaseModel.php";
class Users extends Base{
	// public $table = "users";
	// public $favorites = "favorites";


	function add_user(){
        if(!isset($_POST["first_name"]) || empty($_POST["first_name"])){
            $_SESSION["errors"]["user"]["insert"]["first_name"] = true;
        }

        if(!isset($_POST["last_name"]) || empty($_POST["last_name"])){
            $_SESSION["errors"]["user"]["insert"]["last_name"] = true;
        }

        if(!isset($_POST["username"]) || empty($_POST["username"])){
            $_SESSION["errors"]["user"]["insert"]["username"] = true;
        }

        $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/';
        if(!isset($_POST["password"]) || empty($_POST["password"]) || !preg_match($pattern, $_POST["password"])){
            $_SESSION["errors"]["user"]["insert"]["password"] = true;
        }


        if(empty($_SESSION["errors"]["user"]["insert"])){
            $result = $this->connection->prepare("INSERT INTO 3b_23_users (first_name,last_name,username,password,role) VALUES (?,?,?,?,?)");
            $result->bind_param("sssss",
                $_POST["first_name"],
                $_POST["last_name"],
                $_POST["username"],
                password_hash($_POST["password"], PASSWORD_DEFAULT),
                $_POST["role"]
            );

            if(!$result->execute()){
                $_SESSION["errors"]["user"]["insert"]["database"] = true;
            }
        }

        return empty($_SESSION["errors"]["user"]["insert"]);
    }


	function log_user_in() {
    // Validate username
    if (!isset($_POST["username"]) || empty(trim($_POST["username"]))) {
        $_SESSION["errors"]["user"]["login"]["username"] = true;
    }

    // Validate password with a strong pattern
    $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/';
    if (!isset($_POST["password"]) || empty($_POST["password"]) || !preg_match($pattern, $_POST["password"])) {
        $_SESSION["errors"]["user"]["login"]["password"] = true;
    }

    // Proceed if no errors
    if (empty($_SESSION["errors"]["user"]["login"])) {
        $result = $this->connection->prepare("SELECT * FROM 3b_23_users WHERE username = ?");
        $result->bind_param("s", $_POST["username"]);
        $result->execute();
        $result = $result->get_result();
        $user = $result->fetch_assoc();

        // Verify the password
        if (!is_null($user) && !password_verify($_POST["password"], $user["password"])) {
            $user = null;
        }
    } else {
        $user = null;
    }

    return $user;
}

    function get_all_users(){
        $result = $this->connection->prepare("SELECT user_id,first_name,last_name,username,role FROM 3b_23_users");
        $result->execute();
        $result = $result->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }


	function store_favorite($recipe_id, $user_id) {
    // Prepare the SQL statement with the table name hardcoded
    $stmt = $this->connection->prepare("INSERT INTO 3b_23_favorites (user_id, recipe_id) VALUES (?, ?)");

    // Bind parameters to prevent SQL injection
    $stmt->bind_param("ii", $user_id, $recipe_id);

    // Execute the query and store the result
    $success = $stmt->execute();

    // Close the statement
    $stmt->close();

    // Return whether the operation was successful
    return $success;
    }

    
    function get_favorite_items() {
        $query = "
            SELECT 
                3b_23_favorites.favorite_id,
                3b_23_favorites.user_id AS user_id,
                3b_23_recipe.id AS recipe_id,
                3b_23_recipe.name,
                3b_23_recipe.description,
                3b_23_recipe.image,
                3b_23_recipe.ingredients,
                3b_23_recipe.procedure,
                GROUP_CONCAT(3b_23_recipes_categories.category_id SEPARATOR ',') AS selected_categories,
                CONCAT(3b_23_users.first_name, ' ', 3b_23_users.last_name) AS chef
            FROM 3b_23_favorites
            INNER JOIN 3b_23_recipe ON 3b_23_favorites.recipe_id = 3b_23_recipe.id
            LEFT JOIN 3b_23_users ON 3b_23_recipe.chef = 3b_23_users.user_id
            LEFT JOIN 3b_23_recipes_categories ON 3b_23_recipe.id = 3b_23_recipes_categories.recipe_id
            WHERE 3b_23_favorites.user_id = ?
            GROUP BY 3b_23_favorites.favorite_id, 3b_23_recipe.id;
        ";

        $result = $this->connection->prepare($query);
        $result->bind_param("i", $_SESSION["user"]["id"]);
        $result->execute();
        $result = $result->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    function update($id){
        if(!isset($_POST["first_name"]) || empty($_POST["first_name"])){
            $_SESSION["errors"]["user"]["update"][$id]["first_name"] = true;
        }

        if(!isset($_POST["last_name"]) || empty($_POST["last_name"])){
            $_SESSION["errors"]["user"]["update"][$id]["last_name"] = true;
        }

        //changing of passwords is optional
        if(!isset($_POST["password"]) || empty($_POST["password"])){
            $change_pass = false;
        } else {
            $change_pass = true;
        }


        if($change_pass){
            //validate and check if we want to change password
            $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/';
            if(!preg_match($pattern, $_POST["password"])){
                $_SESSION["errors"]["user"]["update"][$id]["password"] = true;
            }
        } 

        if(empty($_SESSION["errors"]["user"]["update"][$id])){
            if($change_pass){
                $result = $this->connection->prepare("UPDATE 3b_23_users SET first_name = ? , last_name = ? , password = ? WHERE user_id = ?");
                $result->bind_param("sssi",
                    $_POST["first_name"],
                    $_POST["last_name"],
                    password_hash($_POST["password"], PASSWORD_DEFAULT),
                    $id
                );
            } else {
                $result = $this->connection->prepare("UPDATE 3b_23_users SET first_name = ? , last_name = ? WHERE user_id = ?");
                $result->bind_param("ssi",
                    $_POST["first_name"],
                    $_POST["last_name"],
                    $id
                );
            }

            if(!$result->execute()){
                $_SESSION["errors"]["user"]["update"][$id]["database"] = true;
            }
        }

        return empty($_SESSION["errors"]["user"]["update"][$id]);
    }

    function remove_favorite(){
        $result = $this->connection->prepare("DELETE FROM 3b_23_favorites WHERE favorite_id = ?");
        $result->bind_param("i",$_POST["favorite_id"]);
        return $result->execute();
    }

    function destroy(){
        $result = $this->connection->prepare("DELETE FROM 3b_23_users WHERE user_id = ?");
        $result->bind_param("i", $_POST["user_id"]);
        return $result->execute();
    }
}

