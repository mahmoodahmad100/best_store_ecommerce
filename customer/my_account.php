<?php 
include('../includes/db.php');
include('../functions/functions.php');
include('../includes/header.php');
 ?>
<!-- user account -->
<div class="container">
	<div class="col-md-4 products-left">
		<div class="categories animated wow slideInUp" data-wow-delay=".5s">
			<h3>my account</h3>
			<ul class="cate">
				<li><a href="my_account.php?orders">orders</a></li>
				<li><a href="my_account.php?settings">settings</a></li>
			</ul>
		</div>
	</div>
	<div class="col-md-8 text-center" style="margin-top:43px;">
		<?php update_account(); ?>
		<?php account(); ?>
	</div>
	<div class="clearfix"> </div>
</div>
<!-- //user account -->

<?php include('../includes/footer.php'); ?>