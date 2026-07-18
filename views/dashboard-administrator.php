<div class="container-fluid h-100">
	<div class="row h-100">
		<div class="col-md-2 dash-sidebar text-center d-flex flex-column h-100 py-3 position-fixed">
			<img src="<?php $this->assets('img','logoo.png'); ?>" alt="" class="dash-logo img-fluid d-block m-auto">
			<div  class="dash-nav flex-fill mt-3 d-flex justify-content-between flex-column text-start">
				<ul class="list-unstyled">
					<li><i class="fa fa-book" aria-hidden="true"></i> <a href="#recipes">Recipes</a></li>
					<li><i class="fa fa-tags" aria-hidden="true"></i> <a href="#categories">Categories</a></li>
					<li><i class="fa fa-users" aria-hidden="true"></i> <a href="#users">Users</a></li>
					<li><i class="fa fa-long-arrow-left" aria-hidden="true"></i> <a href="<?php $this->url();?>">Visit Site<</a></li>
				</ul>
				<ul class="list-unstyled">
					<!-- <li><i class="fa fa-id-card" aria-hidden="true"></i> Account</li> -->
					<li><i class="fa fa-sign-out" aria-hidden="true"></i> <a href="<?php $this->url('user/logout');?>">Log Out</a></li>
				</ul>
			</div>
		</div>
		<div class="col-md-2">
			<!-- spacer -->
		</div>
		<div class="col-md-10 dash-main">
			<?php
				include "includes/dash-section-recipe.php"; 
				include "includes/dash-section-categories.php"; 
				include "includes/dash-section-users.php"; 
			?>
		</div>
	</div>
</div>