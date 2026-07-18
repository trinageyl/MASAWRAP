<?php
require_once "includes/header.php"; 
?>
<div id="main">
	<div class="container-fluid page-header mb-5 position-relative overlay-bottom">
		<div class="d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5" style="min-height: 400px">
			<h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase">CATEGORIES</h1>
		</div>
	</div>

	<!-- Button section moved outside the header -->
	<div class="container">
		<div class="col d-flex justify-content-end align-items-center mb-4">
			<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
				Add Category
			</button>
		</div>
	</div>


	<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5" id="staticBackdropLabel">Add Category</h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form action="https://localhost/MASAWRAP/categories/insert" method="POST" id="add-category">
						<div class="mb-3">
							<label for="title">Category</label>
							<input type="text" class="form-control" id="title" name="category_name" >
						</div>
						<div class="mb-3">
							<label for="description">Description</label>
							<textarea class="form-control" id="description" name="description" rows="5" ></textarea>
						</div>
						<input type="hidden" name="csrf_token" value="<?php echo $this->generateCSRFToken("add-a-category"); ?>">
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
							<button type="submit" form="add-category" class="btn btn-primary">Submit</button> 
						</div>
					</form>

				</div>
				
			</div>
		</div>
	</div>

</div>
</div>
</div>



<table class="table">
	<thead>
		<tr>
			<th scope="col">ID</th>
			<th scope="col">Category</th>
			<th scope="col">Description</th>
			<th scope="col">Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($categories as $category):?>
			<tr>
				<th scope="row"><?php echo $category["category_id"]; ?></th>
				<td><?php echo $category["category_name"]; ?></td>
				<td><?php echo $category["description"]; ?></td>
				<td>
					
					<div class="d-flex">
						<button type="button" class="btn btn-warning mx-1" data-bs-toggle="modal" data-bs-target="#category-modal-<?php echo $category["category_id"]; ?>">
							Edit
						</button>

						<form action="https://localhost/MASAWRAP/categories/delete" method="POST" class="mx-1">
							<input type="hidden" name="category_id" value="<?php echo $category["category_id"]; ?>">
							<button type="submit" class="btn btn-danger" >
								Delete
							</button>
						</form>
					</div>


					<div class="modal fade" id="category-modal-<?php echo $category["category_id"]; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h1 class="modal-title fs-5">Edit Category</h1>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body">
									<form action="https://localhost/MASAWRAP/categories/update" method="POST" id="edit-category-<?php echo $category["category_id"]; ?>">
										<div class="mb-3">
											<label>Category</label>
											<input type="text" class="form-control" name="category_name" value="<?php echo $category["category_name"]; ?>">
										</div>
										<div class="mb-3">
											<label>Description</label>
											<textarea class="form-control" name="description" rows="5"><?php echo $category["description"]; ?></textarea>
										</div>

										<input type="hidden" name="category_id" value="<?php echo $category["category_id"]; ?>">
									</form>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
									<button type="submit" form="edit-category-<?php echo $category["category_id"]; ?>" class="btn btn-primary">Edit</button>
								</div>
							</div>
						</div>
					</div>
					
				</td>
			</tr>

		<?php endforeach;?>
	</tbody>
</table>

</div>
</div>

<?php 
require_once "includes/footer.php";
require_once "includes/java.php";
?>
