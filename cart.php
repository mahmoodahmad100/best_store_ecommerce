<?php 
include('includes/db.php');
include('functions/functions.php');
include('includes/header.php');
 ?>
<!-- checkout -->
	<div class="checkout">
		<div class="container">
		<form method="post">
			<div class="checkout-right animated wow slideInUp" data-wow-delay=".5s">
				<table class="timetable_sub">
					<thead>
						<tr>
							<th>SL No.</th>	
							<th>Product</th>
							<th>Quantity</th>
							<th>Product Name</th>
							<th>Total Price</th>
							<th>Remove</th>
						</tr>
					</thead>
					
					<?php cartInfo(); ?>
					<?php updateCart(); ?>

					<!--quantity-->
						<script>
						$('.value-plus').on('click', function(){
							var divUpd = $(this).parent().find('.value'), newVal = parseInt(divUpd.text(), 10)+1;
							divUpd.text(newVal);
							$(this).parent().find('.quantityValue').val(newVal);
						});

						$('.value-minus').on('click', function(){
							var divUpd = $(this).parent().find('.value'), newVal = parseInt(divUpd.text(), 10)-1;
							if(newVal>=1)
							{
								divUpd.text(newVal);
								$(this).parent().find('.quantityValue').val(newVal);
							} 
							
						});
						</script>
					<!--quantity-->
				</table>
			</div>
			<div class="text-center" style="margin-top: 20px;">
				<a class="btn btn-info" href="index.php">continue shoping</a>
				<input type="submit" class="btn btn-warning" value="update the cart" name="update">
				<a class="btn btn-success" href="checkout.php">checkout</a>
			</div>
			</form>
		</div>
	</div>
<!-- //checkout -->
<?php include('includes/footer.php'); ?>