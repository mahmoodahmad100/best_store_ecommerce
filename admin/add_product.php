<?php

include('../includes/db.php');
include('../includes/header.php');

?>
	<div class="mail animated wow zoomIn" data-wow-delay=".5s">
		<div class="container">
			<h3>Add New Product</h3>
			<p class="est">add new product so others can buy it and you can benefit it</p>
			<div class="mail-grids">
				<div class="col-md-12 mail-grid-left animated wow slideInLeft" data-wow-delay=".5s">
					<form action="add_product.php" method="post" enctype="multipart/form-data">
						<span>select the category:</span> <select class="form-controll" name="category">
							<?php 
							$query  = "SELECT * FROM categories";
							$result = mysqli_query($con,$query);

							while($obj = mysqli_fetch_object($result))
							{
								echo '<option value="'.$obj->id.'">'.$obj->title.'</option>';
							}
							?>
						</select><br>
						<span>select the brand:</span> <select name="brand">
							<?php 
							$query  = "SELECT * FROM brands";
							$result = mysqli_query($con,$query);

							while($obj = mysqli_fetch_object($result))
							{
								echo '<option value="'.$obj->id.'">'.$obj->title.'</option>';
							}
							?>
						</select><br>
						<input name="title" type="text" placeholder="Title" required="">
						<input name="price" type="text" placeholder="Price" required="">
						<input name="keywords" type="text" placeholder="Keywords" required="">
						<span>the product image:</span> <input name="image" type="file" required="">
						<textarea name="description" type="text" placeholder="Description"></textarea>
						<input type="submit" name="add" value="Submit Now" >
					</form>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
	<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
	<script>
		tinymce.init({ selector:'textarea' });
	</script>
	
<?php 
include('../includes/footer.php'); 

// Handling The Product insertion //
if(isset($_POST['add']))
{
	$category    = $_POST['category'];
	$brand       = $_POST['brand'];
	$title       = $_POST['title'];
	$price       = $_POST['price'];
	$keywords    = $_POST['keywords'];
	$description = $_POST['description'];

	// Handling The Image //
	$imageType = pathinfo($_FILES['image']['name'],PATHINFO_EXTENSION);
	if($imageType != "jpg" && $imageType != "png" && $imageType != "jpeg" && $imageType != "gif")
	{
		echo '<script>alert("you must upload an image")</script>';
		echo '<script>window.open("add_product.php","_self")</script>';
		exit;
	}

	$imageTmp  = $_FILES['image']['tmp_name'];
	$imageName = strtotime("now").".".$imageType;
	move_uploaded_file($imageTmp,'product_images/'.$imageName);
	// End Handling The Image //

	// Adding the product to the database //
	$query  = "insert into products (cat_id,brand_id,title,description,price,image,keywords) values ('$category','$brand','$title','$description','$price','$imageName','$keywords')";
	$insert = mysqli_query($con,$query);
	if($insert)
	{
		echo '<script>alert("wow amazing you just added a new product")</script>';
		echo '<script>window.open("add_product.php","_self")</script>';
	}
	else
	{
		echo '<script>alert("try again later to add a new product")</script>';
		echo '<script>window.open("add_product.php","_self")</script>';
	}
	// Adding the product to the database //

// End Handling The Product insertion //
}

?>