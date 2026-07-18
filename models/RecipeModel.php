<?php
require_once "BaseModel.php";
class Recipe extends Base {
    public $table = "recipe";

    function get_all_recipe() {
    // Prepare the query without an ID since this retrieves all recipes
        $result = $this->connection->prepare("
            SELECT 
            recipe_user.id, 
            recipe_user.name, 
            recipe_user.description, 
            recipe_user.image, 
            recipe_user.chef, 
            recipe_user.user_id,  
            recipe_user.ingredients,  
            recipe_user.`procedure`,  
            GROUP_CONCAT(DISTINCT result.category_name SEPARATOR ', ') AS categories,
            GROUP_CONCAT(DISTINCT 3b_23_favorites.user_id SEPARATOR ', ') AS favorited_by_users
            FROM (
                SELECT 
                3b_23_recipe.id AS id, 
                3b_23_recipe.name, 
                3b_23_recipe.description, 
                3b_23_recipe.image, 
                3b_23_recipe.ingredients,  
                3b_23_recipe.`procedure`,  
                CONCAT(3b_23_users.first_name, ' ', 3b_23_users.last_name) AS chef, 
                3b_23_recipe.chef AS user_id
                FROM 3b_23_recipe 
                LEFT JOIN 3b_23_users ON 3b_23_users.user_id = 3b_23_recipe.chef
                ) AS recipe_user
            LEFT JOIN (
                SELECT 
                3b_23_recipes_categories.recipe_id, 
                3b_23_categories.category_name
                FROM 3b_23_recipes_categories 
                LEFT JOIN 3b_23_categories ON 3b_23_categories.category_id = 3b_23_recipes_categories.category_id
                ) AS result ON recipe_user.id = result.recipe_id
            LEFT JOIN 3b_23_favorites ON recipe_user.id = 3b_23_favorites.recipe_id
            GROUP BY recipe_user.id
            ");

    // Execute the statement
        $result->execute();

    // Get the result and fetch all records as an associative array
        $result = $result->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    function get_recipe($id) {
    // Prepare the query with a placeholder for the recipe ID
        $result = $this->connection->prepare("
            SELECT id, 
            name, 
            description, 
            image, 
            chef, 
            user_id, 
            ingredients,  
            `procedure`,  
            GROUP_CONCAT(category_id SEPARATOR ',') AS selected_categories
            FROM (
                SELECT 3b_23_recipe.id AS id, 
                3b_23_recipe.name, 
                3b_23_recipe.description, 
                3b_23_recipe.image, 
                3b_23_recipe.ingredients,  
                `procedure`,  
                CONCAT(3b_23_users.first_name, ' ', 3b_23_users.last_name) AS chef, 
                3b_23_recipe.chef AS user_id
                FROM 3b_23_recipe 
                LEFT JOIN 3b_23_users ON 3b_23_users.user_id = 3b_23_recipe.chef
                ) AS recipe_user
            LEFT JOIN (
                SELECT 3b_23_recipes_categories.category_id, 3b_23_recipes_categories.recipe_id 
                FROM 3b_23_recipes_categories 
                ) AS result ON recipe_user.id = result.recipe_id
            WHERE recipe_user.id = ?
            GROUP BY id
            ");

    // Bind the recipe ID to the prepared statement
        $result->bind_param("i", $id);

    // Execute the statement
        $result->execute();

    // Get the result and fetch it as an associative array
        $result = $result->get_result();
        return $result->fetch_assoc();
    }

    function add_recipe() {
    // Validate input data
        if (!isset($_POST["name"]) || empty($_POST["name"])) {
            $_SESSION["errors"]["recipe"]["insert"]["name"] = true;
        }

        if (!isset($_POST["description"]) || empty($_POST["description"])) {
            $_SESSION["errors"]["recipe"]["insert"]["description"] = true;
        }

        if (empty($_FILES["image"]["name"]) || !($_FILES["image"]["type"] == "image/jpeg" || $_FILES["image"]["type"] == "image/png")) {
            $_SESSION["errors"]["recipe"]["insert"]["image"] = true;
        }

        if (!isset($_POST["ingredients"]) || empty($_POST["ingredients"])) {
            $_SESSION["errors"]["recipe"]["insert"]["ingredients"] = true;
        }

        if (!isset($_POST["procedure"]) || empty($_POST["procedure"])) {
            $_SESSION["errors"]["recipe"]["insert"]["procedure"] = true;
        }

        if (!isset($_POST["categories"]) || !is_array($_POST["categories"]) || count($_POST["categories"]) === 0) {
            $_SESSION["errors"]["recipe"]["insert"]["categories"] = true;
        }

    // If there are errors, stop further processing
        if (!empty($_SESSION["errors"]["recipe"]["insert"])) {
            return false;
        }

    // Process the input and insert the data into the database
        $imageName = $_FILES["image"]["name"];
        $stmt = $this->connection->prepare("INSERT INTO 3b_23_recipe (name, description, image, ingredients, `procedure`, chef) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param(
            "sssssi",
            $_POST["name"],
            $_POST["description"],
            $imageName,
            $_POST["ingredients"],
            $_POST["procedure"],
            $_SESSION["user"]["id"]
        );

        if ($stmt->execute()) {
            $recipe_id = $stmt->insert_id;

        // Insert categories
            $category_stmt = $this->connection->prepare("INSERT INTO 3b_23_recipes_categories (recipe_id, category_id) VALUES (?, ?)");
            $category_stmt->bind_param("ii", $recipe_id, $category);

            foreach ($_POST["categories"] as $category) {
                if (!$category_stmt->execute()) {
                    $_SESSION["errors"]["recipe"]["insert"]["database"] = true;
                    break;
                }
            }
        } else {
            $_SESSION["errors"]["recipe"]["insert"]["database"] = true;
        }

    // Return success if there are no errors
        return empty($_SESSION["errors"]["recipe"]["insert"]);
    }

    function update_recipe($id) {
    // Validate input fields
        if (!isset($_POST["name"]) || empty($_POST["name"])) {
            $_SESSION["errors"]["recipe"]["update"][$id]["name"] = true;
        }

        if (!isset($_POST["description"]) || empty($_POST["description"])) {
            $_SESSION["errors"]["recipe"]["update"][$id]["description"] = true;
        }

        if (!isset($_POST["ingredients"]) || empty($_POST["ingredients"])) {
            $_SESSION["errors"]["recipe"]["update"][$id]["ingredients"] = true;
        }

        if (!isset($_POST["procedure"]) || empty($_POST["procedure"])) {
            $_SESSION["errors"]["recipe"]["update"][$id]["procedure"] = true;
        }

    // Check if a new image is uploaded
        if(empty(($_FILES["image"]["name"]))){
            $recipe_image = $this->get_recipe($id)["image"];
        } else {
            if( $_FILES["image"]["type"] == "image/jpeg" || $_FILES["image"]["type"] == "image/png"){
                $recipe_image = $_FILES["image"]["name"];
            } else {
                $_SESSION["errors"]["recipe"]["update"][$id]["image"] = true;

            }
        }

    // Proceed only if validation passed
        if (empty($_SESSION["errors"]["recipe"]["update"][$id])) {
        // Prepare the main update query
            $stmt = $this->connection->prepare("UPDATE 3b_23_recipe SET name = ?, description = ?, ingredients = ?, `procedure` = ?, image = ? WHERE id = ?");

                $stmt->bind_param(
                    "sssssi",
                    $_POST["name"],
                    $_POST["description"],
                    $_POST["ingredients"],
                    $_POST["procedure"],
                    $recipe_image,
                    $id
                );


        // Execute the update statement
            if ($stmt->execute()) {
            // Delete old categories for the recipe
                $deleteStmt = $this->connection->prepare("DELETE FROM 3b_23_recipes_categories WHERE recipe_id = ?");
                $deleteStmt->bind_param("i", $id);
                if ($deleteStmt->execute()) {
                // Insert new categories
                    $insertStmt = $this->connection->prepare("INSERT INTO 3b_23_recipes_categories (recipe_id, category_id) VALUES (?, ?)");
                    $insertStmt->bind_param("ii", $id, $category);

                    foreach ($_POST["categories"] as $category) {
                        if (!$insertStmt->execute()) {
                            $_SESSION["errors"]["recipe"]["update"][$id]["database"] = true;
                        }
                    }
                } 
            } else {
               $_SESSION["errors"]["recipe"]["update"][$id]["database"] = true;
            }
        }

        return empty($_SESSION["errors"]["recipe"]["update"][$id]);
    }

    function delete_recipe($id) {
    // First, delete any associated records in the recipes_categories table
        $category_stmt = $this->connection->prepare("DELETE FROM 3b_23_recipes_categories WHERE recipe_id = ?");
        $category_stmt->bind_param("i", $id);
        $category_stmt->execute();

    // Then, delete the recipe from the recipe table
        $result = $this->connection->prepare("DELETE FROM 3b_23_recipe WHERE id = ?");
        $result->bind_param("i", $id);

    // Execute the delete and return the result
        return $result->execute();
    }
    
    function removeFromFavorites($recipe_id, $user_id) {
    // Prepare the SQL query with placeholders
        $result = $this->connection->prepare("DELETE FROM 3b_23_favorites WHERE recipe_id = ? AND user_id = ?");
        
    // Bind parameters to the placeholders
        $result->bind_param("ii", $recipe_id, $user_id);
        
    // Execute the query
        $execution_result = $result->execute();
        
    // Close the result object
        $result->close();
        
        return $execution_result;
    }


    function get_recipe_by_role($user_id) {
    // Prepare the query to retrieve recipes created by a specific chef (user_id)
        $query = "
        SELECT 
        3b_23_recipe.id AS id, 
        3b_23_recipe.name, 
        3b_23_recipe.description, 
        3b_23_recipe.image, 
        3b_23_recipe.ingredients,  
        3b_23_recipe.procedure,  
        CONCAT(3b_23_users.first_name, ' ', 3b_23_users.last_name) AS chef, 
        3b_23_recipe.chef AS user_id,
        GROUP_CONCAT(DISTINCT 3b_23_categories.category_name SEPARATOR ', ') AS categories
        FROM 
        3b_23_recipe 
        LEFT JOIN 
        3b_23_users ON 3b_23_users.user_id = 3b_23_recipe.chef
        LEFT JOIN 
        3b_23_recipes_categories ON 3b_23_recipe.id = 3b_23_recipes_categories.recipe_id
        LEFT JOIN 
        3b_23_categories ON 3b_23_recipes_categories.category_id = 3b_23_categories.category_id
        WHERE 
        3b_23_recipe.chef = ?
        GROUP BY 
        3b_23_recipe.id, 3b_23_recipe.name, 3b_23_recipe.description, 3b_23_recipe.image, 3b_23_recipe.ingredients, 3b_23_recipe.procedure, chef, user_id;
        ";

    // Prepare the query with a placeholder for the chef ID
        $stmt = $this->connection->prepare($query);

    // Bind the user ID parameter to the query
        $stmt->bind_param("i", $user_id);

    // Execute the query
        $stmt->execute();

    // Fetch the results and return them as an associative array
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }



    function get_recipes_by($by, $term) {
        // Prepare the search term for LIKE queries
        $term = "%" . $term . "%";

        // Validate the `$by` parameter to allow only specific column references
        $allowed = ["categories", "description", "user_id", "none"];
        if (!in_array($by, $allowed)) {
            return null; // If `$by` is invalid, return null
        }

        // Base query to retrieve recipes and their associated data
        $query = "SELECT 
        3b_23_recipe.id, 
        3b_23_recipe.name, 
        3b_23_recipe.description, 
        3b_23_recipe.image, 
        CONCAT(3b_23_users.first_name, ' ', 3b_23_users.last_name) AS chef,
        3b_23_recipe.ingredients, 
        3b_23_recipe.`procedure`,
        GROUP_CONCAT(DISTINCT 3b_23_categories.category_name SEPARATOR ', ') AS categories
        FROM 3b_23_recipe
        LEFT JOIN 3b_23_users ON 3b_23_recipe.chef = 3b_23_users.user_id
        LEFT JOIN 3b_23_recipes_categories ON 3b_23_recipe.id = 3b_23_recipes_categories.recipe_id
        LEFT JOIN 3b_23_categories ON 3b_23_recipes_categories.category_id = 3b_23_categories.category_id";

        // Add a WHERE clause only if a specific filter is applied
        if ($by !== "none") {
            $query .= " WHERE $by LIKE ?";
        }

        // Group by recipe ID to aggregate category data
        $query .= " GROUP BY 3b_23_recipe.id";

        // Prepare the query
        $stmt = $this->connection->prepare($query);

        // Bind the parameter if a WHERE clause was added
        if ($by !== "none") {
            $stmt->bind_param("s", $term);
        }

        // Execute the query
        $stmt->execute();

        // Fetch the results as an associative array
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

}
?>
