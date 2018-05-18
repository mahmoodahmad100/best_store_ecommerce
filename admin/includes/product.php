<div class="box-header">
  <h3 class="box-title"></h3>
</div>

<div class="box-body">
	<form action="<?php echo $_SERVER['php_self'] ?>" method="post" enctype="multipart/form-data">
		<span>select category:</span> <select class="form-control" name="category">

		</select><br>

		<span>select brand:</span> <select class="form-control" name="brand">

		</select><br>

		<input class="form-control" name="title" type="text" placeholder="Title"><br>
		<input class="form-control" name="price" type="text" placeholder="Price"><br>
		<input class="form-control" name="keywords" type="text" placeholder="Keywords"><br>
		<span>the product image:</span> <input class="form-control" name="image" type="file"><br>

		<textarea class="form-control" name="description" type="text" placeholder="Description"></textarea><br>

		<input class="btn btn-primary btn-block" type="submit" name="add" value="Submit Now">
	</form>
</div><!-- /.box-body -->
