<?php
require_once "BaseModel.php";
class Categories extends Base{
	public $table = "categories";

	// function get_categories(){
	// 	return $this->connection->query("SELECT * FROM " . $this->table)->fetch_all(MYSQLI_ASSOC);

	// }

	function get_categories(){
        $result = $this->connection->prepare("SELECT * FROM 3b_23_categories");
        $result->execute();
        $result = $result->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

	// function add_category(){
	// 	return $this->connection->query("INSERT INTO " . $this->table. "(category_name,description) VALUES(
	// 		'".$_POST["category_name"]."',
	// 		'".$_POST["description"]."')");
	// }

	function add_category(){
        if(!isset($_POST["category_name"]) || empty($_POST["category_name"])){
            $_SESSION["errors"]["category"]["insert"]["name"] = true;

        }

        if(!isset($_POST["description"]) || empty($_POST["description"])){
            $_SESSION["errors"]["category"]["insert"]["description"] = true;
        }

        if(empty($_SESSION["errors"]["category"]["insert"])){
            $result = $this->connection->prepare("INSERT INTO 3b_23_categories (category_name,description) VALUES (?,?)");
            $result->bind_param("ss",
                $_POST["category_name"],
                $_POST["description"]
            );

            if(!$result->execute()){
                $_SESSION["errors"]["category"]["insert"]["database"] = true;
            }
        }

        return empty($_SESSION["errors"]["category"]["insert"]);
    }


	// function update_category($id){
	// 	return $this->connection->query("UPDATE " . $this->table . " SET 
	// 		category_name='".$_POST["category_name"]."',
	// 		description='".$_POST["description"]."' 
	// 		WHERE category_id =". $id);
	// }


    function update_category($id){
        

        if(!isset($_POST["category_name"]) || empty($_POST["category_name"])){
            $_SESSION["errors"]["category"]["update"][$id]["name"] = true;
        }

        if(!isset($_POST["description"]) || empty($_POST["description"])){
            $_SESSION["errors"]["category"]["update"][$id]["description"] = true;
        }

        if(empty($_SESSION["errors"]["category"]["update"])){
            $result = $this->connection->prepare("UPDATE 3b_23_categories SET category_name = ? , description = ? WHERE category_id = ?");
            $result->bind_param("ssi",
                $_POST["category_name"],
                $_POST["description"],
                $id
            );

            if(!$result->execute()){
                $_SESSION["errors"]["category"]["update"][$id]["database"] = true;
            }
        }

        return empty($_SESSION["errors"]["category"]["update"][$id]);
    }

	// function delete_category($id){
	// 	return $this->connection->query("DELETE FROM " . $this->table . " WHERE category_id = " . $id);


	// }

	function delete_category($id) {
        $stmt = $this->connection->prepare("DELETE FROM 3b_23_categories WHERE category_id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

}

?>