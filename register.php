<?php 
include('includes/db.php');
include('functions/functions.php');
include('includes/header.php');
 ?>

<!-- register -->
	<div class="register">
		<div class="container">
			<h3 class="animated wow zoomIn" data-wow-delay=".5s">Register Here</h3>
			<p class="est animated wow zoomIn" data-wow-delay=".5s">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia 
				deserunt mollit anim id est laborum.</p>
			<div class="login-form-grids">
				<?php register(); ?>
				<h6 class="animated wow slideInUp" data-wow-delay=".5s">your information</h6>
				<form  action="register.php" method="post" class="animated wow slideInUp" data-wow-delay=".5s">
					<input name="name" type="text" placeholder="Full Name" required=" " style="margin-bottom: 15px;">
					<input name="email" type="email" placeholder="Email Address" required=" " >
					<input name="password" type="password" placeholder="Password" required=" " >
					<input name="re_pass" type="password" placeholder="Password Confirmation" required=" " >
					<div class="register-check-box">
						<div class="check">
							<label class="checkbox"><input type="checkbox" name="checkbox"><i> </i>I accept the terms and conditions</label>
						</div>
					</div>
					<input type="submit" value="Register" name="register">
				</form>
			</div>
			<div class="register-home animated wow slideInUp" data-wow-delay=".5s">
				<a href="index.php">Home</a>
			</div>
		</div>
	</div>
<!-- //register -->

<?php include('includes/footer.php'); ?>