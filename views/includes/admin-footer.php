<script src="<?php $this->assets('scripts','bootstrap.bundle.js'); ?>"></script>
<?php 

// *******************************************
// TRIGGER ADD A BOOK MODAL
// *******************************************
if (isset($_SESSION["errors"]["recipe"]["insert"])) : ?>
	<script type="text/javascript">
		var add_recipe = new bootstrap.Modal(document.getElementById("add-recipe-modal"), {});
		document.onreadystatechange = function () {
			add_recipe.show();
		};
	</script>
	<?php
	//unset the entire errors array
	unset($_SESSION["errors"]["recipe"]["insert"]);
endif;

// *******************************************
// TRIGGER EDIT A BOOK MODAL
// *******************************************
if (isset($_SESSION["errors"]["recipe"]["update"])):
	// We are editing books one at a time, get the the id of the book with error
	$error_bk = array_keys($_SESSION["errors"]["recipe"]["update"])[0];
	?>
	<script type="text/javascript">
		var edit_recipe_modal = new bootstrap.Modal(document.getElementById("recipe-modal-<?php echo $error_bk; ?>"), {});
		document.onreadystatechange = function () {
			edit_recipe_modal.show();
		};
	</script>

	<?php
	unset($_SESSION["errors"]["recipe"]["update"]);
endif;


// *******************************************
// TRIGGER EDIT A CATEGORY MODAL
// *******************************************
if (isset($_SESSION["errors"]["category"]["insert"])) : ?>
	<script type="text/javascript">
		var add_category = new bootstrap.Modal(document.getElementById("add-category-modal"), {});
		document.onreadystatechange = function () {
			add_category.show();
		};
	</script>
	<?php
	//unset the entire errors array
	unset($_SESSION["errors"]["category"]["insert"]);
endif;


// *******************************************
// TRIGGER EDIT A CATEGORY MODAL
// *******************************************
if (isset($_SESSION["errors"]["category"]["update"])):
	// We are editing categories one at a time, get the the id of the category with error
	$error_ctg = array_keys($_SESSION["errors"]["category"]["update"])[0];
	?>
	<script type="text/javascript">
		var edit_category_modal = new bootstrap.Modal(document.getElementById("edit-category-<?php echo $error_ctg; ?>"), {});
		document.onreadystatechange = function () {
			edit_category_modal.show();
		};
	</script>

	<?php
	unset($_SESSION["errors"]["category"]["update"]);
endif;


// *******************************************
// TRIGGER ADD A USER MODAL
// *******************************************
if (isset($_SESSION["errors"]["user"]["insert"])) : ?>
	<script type="text/javascript">
		var add_user_modal = new bootstrap.Modal(document.getElementById("add-user-modal"), {});
		document.onreadystatechange = function () {
			add_user_modal.show();
		};
	</script>
	<?php
	//unset the entire errors array
	unset($_SESSION["errors"]["user"]["insert"]);
endif;

// *******************************************
// TRIGGER EDIT A USER MODAL
// *******************************************
if (isset($_SESSION["errors"]["user"]["update"])):
	// We are editing categories one at a time, get the the id of the category with error
	$error_us = array_keys($_SESSION["errors"]["user"]["update"])[0];
	?>
	<script type="text/javascript">
		var edit_user_modal = new bootstrap.Modal(document.getElementById("user-modal-<?php echo $error_us; ?>"), {});
		document.onreadystatechange = function () {
			edit_user_modal.show();
		};
	</script>

	<?php
	unset($_SESSION["errors"]["user"]["update"]);
endif;
?>

</body>
</html>