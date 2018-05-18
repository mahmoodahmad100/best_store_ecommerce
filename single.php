<?php 
include('includes/db.php');
include('includes/header.php');	
 ?>
<!-- single -->
	<div class="single">
 	<?php 
	if(isset($_GET['id']))
	{	
		$product_id = $_GET['id'];
		$query  = "SELECT * FROM products WHERE id = '$product_id'";
		$result = mysqli_query($con,$query);

		if(mysqli_num_rows($result) < 1)
			die("There is no product like that");

		while($obj = mysqli_fetch_object($result))
		{
	?>
		<div class="container">
			<div class="col-md-12 single-right">
				<div class="col-md-5 single-right-left animated wow slideInUp" data-wow-delay=".5s">
					<div class="flexslider">
						<ul class="slides">
							<li data-thumb="admin/product_images/<?php echo $obj->image; ?>">
								<div class="thumb-image"> <img src="admin/product_images/<?php echo $obj->image; ?>" data-imagezoom="true" class="img-responsive"> </div>
							</li>
						</ul>
					</div>
					<!-- flixslider -->
						<script defer src="js/jquery.flexslider.js"></script>
						<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />
						<script>
						// Can also be used with $(document).ready()
						$(window).load(function() {
						  $('.flexslider').flexslider({
							animation: "slide",
							controlNav: "thumbnails"
						  });
						});
						</script>
					<!-- flixslider -->
				</div>
				<div class="col-md-7 single-right-left simpleCart_shelfItem animated wow slideInRight" data-wow-delay=".5s">
					<h3><?php echo $obj->title; ?></h3>
					<h4><span class="item_price"><?php echo $obj->price; ?> $</span></h4>
					<div class="description">
						<h5><i>Description</i></h5>
						<p><?php echo $obj->description; ?></p>
					</div>
					<div class="occasion-cart">
						<a class="item_add" href="#">add to cart </a>
					</div>
				</div>
			</div>
			<div class="clearfix"> </div>
		</div>
	<?php		
		} #end while	
	}
	else
	{
		die("you are not allowed to go to the previus page");
	}
	?>
	</div>
<!-- //single -->
<?php 
include('includes/footer.php');	
 ?>