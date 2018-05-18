<?php 

class operation
{
	protected $con; # connect variable 

	public function __construct()
	{
		$this->connect();
		$this->authenticate();
	}

	protected function connect($server = 'localhost', $user = 'root', $password = 11111, $db = 'ecommerce')
	{
		$this->con = mysqli_connect($server,$user,$password,$db);
		if(!$this->con)
			die('Cann\'t connect the the DB');		
	}

	private function authenticate()
	{
		session_start();
		# redirect the user if not logged in # 
		if(!@$_SESSION['email'])
		{
			$_SESSION['url'] = 'admin';
			echo "<script>window.open('../login.php','_self')</script>";

		}

		# select the user form the DB #
		$selectUser = mysqli_query($this->con,"SELECT * FROM users WHERE email = '".$_SESSION['email']."'");
		$user = mysqli_fetch_object($selectUser);

		# check if the user is admin or not #
		$selectAdmin = mysqli_query($this->con,"SELECT * FROM admin WHERE user_id = '$user->id'");
		if(mysqli_num_rows($selectAdmin) < 1)
			echo "<script>window.open('../customer/my_account.php','_self')</script>";
	}

}

class product extends operation
{

	public function __construct()
	{
		$this->connect();
		$this->single();
		$this->all();
	}

	private function single()
	{
		// Handling The Product insertion & update //
		if(isset($_POST['send_product']))
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

				if(isset($_GET['product']))
					echo '<script>window.open("?product='.$_GET['product'].'","_self")</script>';

				echo '<script>window.open("?show=add_product","_self")</script>';
				exit;
			}

			$imageTmp  = $_FILES['image']['tmp_name'];
			$imageName = strtotime("now").".".$imageType;
			move_uploaded_file($imageTmp,'product_images/'.$imageName);
			// End Handling The Image //

			// Adding the product to the database //
			$query  = "insert into products (cat_id,brand_id,title,description,price,image,keywords) values ('$category','$brand','$title','$description','$price','$imageName','$keywords')";
			if(isset($_GET['product']))
				$query = "UPDATE products SET cat_id = '$category', brand_id = '$brand', title = '$title', description = '$description', price = '$price', image = '$imageName', keywords = '$keywords' WHERE id = '".$_GET['product']."'";

			$run_query = mysqli_query($this->con,$query);
			if($run_query)
			{
				echo '<script>alert("wow amazing you made it successfully")</script>';
				echo '<script>window.open("index.php","_self")</script>';
			}
			else
			{
				echo '<script>alert("try again later to add a new product")</script>';
				echo '<script>window.open("index.php","_self")</script>';
			}
			// Adding the product to the database //

		// End Handling The Product insertion & update //
		}


		// read	
		if(isset($_GET['product']))
		{
			$product = mysqli_fetch_object(mysqli_query($this->con,"SELECT * FROM products WHERE id = '".$_GET['product']."'"));
			$category = mysqli_fetch_object(mysqli_query($this->con,"SELECT * FROM categories WHERE id = '$product->cat_id'"));
			$brand = mysqli_fetch_object(mysqli_query($this->con,"SELECT * FROM brands WHERE id = '$product->brand_id'"));
			
			echo'
			<div class="box-header">
			  <h3 class="box-title">edit product</h3>
			</div>

			<div class="box-body">
				<form action="?product='.@$_GET['product'].'" method="post" enctype="multipart/form-data">
					<span>select category:</span> <select class="form-control" name="category">
						<option value="'.$category->id.'">'.$category->title.'</option>';
						$r = mysqli_query($this->con,"SELECT * FROM categories WHERE id != '$product->cat_id'");
						while($category = mysqli_fetch_object($r))
							echo '<option value="'.$category->id.'">'.$category->title.'</option>';

			echo'
					</select><br>

					<span>select brand:</span> <select class="form-control" name="brand">
						<option value="'.$brand->id.'">'.$brand->title.'</option>';
						$r = mysqli_query($this->con,"SELECT * FROM brands WHERE id != '$product->brand_id'");
						while($brand = mysqli_fetch_object($r))
							echo '<option value="'.$brand->id.'">'.$brand->title.'</option>';
			
			echo'
					</select><br>

					<input class="form-control" name="title" type="text" placeholder="Title" value="'.$product->title.'"><br>
					<input class="form-control" name="price" type="text" placeholder="Price" value="'.$product->price.'"><br>
					<input class="form-control" name="keywords" type="text" placeholder="Keywords" value="'.$product->keywords.'"><br>
					<span>the product image:</span> <input class="form-control" name="image" type="file"><br>

					<textarea class="form-control" name="description" type="text" placeholder="Description">'.$product->description.'</textarea><br>

					<input class="btn btn-primary btn-block" type="submit" name="send_product" value="Submit Now">
				</form>
			</div><!-- /.box-body -->
			';

		}

		// create
		if(@$_GET['show'] == 'add_product')
		{
			echo'
			<div class="box-header">
			  <h3 class="box-title">new product</h3>
			</div>

			<div class="box-body">
				<form action="'.$_SERVER['PHP_SELF'].'" method="post" enctype="multipart/form-data">
					<span>select category:</span> <select class="form-control" name="category">';
						$r = mysqli_query($this->con,"SELECT * FROM categories");
						while($category = mysqli_fetch_object($r))
							echo '<option value="'.$category->id.'">'.$category->title.'</option>';
					echo'
					</select><br>

					<span>select brand:</span> <select class="form-control" name="brand">';
						$r = mysqli_query($this->con,"SELECT * FROM brands");
						while($brand = mysqli_fetch_object($r))
							echo '<option value="'.$brand->id.'">'.$brand->title.'</option>';

					echo'
					</select><br>

					<input class="form-control" name="title" type="text" placeholder="Title"><br>
					<input class="form-control" name="price" type="text" placeholder="Price"><br>
					<input class="form-control" name="keywords" type="text" placeholder="Keywords"><br>
					<span>the product image:</span> <input class="form-control" name="image" type="file"><br>

					<textarea class="form-control" name="description" type="text" placeholder="Description"></textarea><br>

					<input class="btn btn-primary btn-block" type="submit" name="send_product" value="Submit Now">
				</form>
			</div><!-- /.box-body -->
			';		

		}

		// delete
		if(isset($_GET['del_product']))
		{
			$delete = mysqli_query($this->con,"DELETE FROM products WHERE id = '".$_GET['del_product']."'");
			if($delete)
			{
				echo '<script>alert("you deleted the product")</script>';
				echo '<script>window.open("index.php","_self")</script>';
			}
		}


	}

	private function all()
	{
		if(@$_GET['show']=='products')
		{
			$porducts = mysqli_query($this->con,"SELECT * FROM products");

			echo'
				<div class="box-header">
				  <h3 class="box-title">all products</h3>
				</div>

				<div class="box-body">
					<table class="table table-bordered text-center">
						<tr>
							<th>#</th>
							<th>name</th>
							<th>price</th>
							<th>category</th>
							<th>brand</th>
							<th>action</th>
						</tr>';

			while($obj = mysqli_fetch_object($porducts))
			{
				$category = mysqli_fetch_object(mysqli_query($this->con,"SELECT * FROM categories WHERE id = '$obj->cat_id'"));
				$brand = mysqli_fetch_object(mysqli_query($this->con,"SELECT * FROM brands WHERE id = '$obj->brand_id'"));
				echo'		
				<tr>
					<td>'.$obj->id.'</td>
					<td>'.$obj->title.'</td>
					<td>$'.$obj->price.'</td>
					<td>'.$category->title.'</td>
					<td>'.$brand->title.'</td>
					<td ><a href="?product='.$obj->id.'"><i class="fa fa-pencil"></i></a> <a href="?del_product='.$obj->id.'"><i class="fa fa-trash-o"></i></a></td>
				</tr>';					
			}

			echo '
					</table>
				</div><!-- /.box-body -->
				';

		}
	}
}

class category extends operation
{

	public function __construct()
	{
		$this->connect();
		$this->single();
		$this->all();
	}

	public function single()
	{

		// insert & update
		if(isset($_POST['send_category']))
		{
			$category = $_POST['category'];
			if($category != "")
			{
				$query  = "insert into categories (title) values ('$category')";
				if(@$_GET['category'])
					$query = "UPDATE categories SET title = '$category' WHERE id = '".$_GET['category']."'";

				$run_query = mysqli_query($this->con,$query);
				if($run_query)
				{
					echo '<script>alert("wow amazing you made it successfully")</script>';
					echo '<script>window.open("?categories","_self")</script>';
				}
			}
		}

		// read	
		if(isset($_GET['category']))
		{
			$category = mysqli_fetch_object(mysqli_query($this->con,"SELECT * FROM categories WHERE id = '".$_GET['category']."'"));		
			echo'
			<div class="box-header">
			  <h3 class="box-title">edit cateogry</h3>
			</div>

			<div class="box-body">
				<form action="?category='.@$_GET['category'].'" method="post">
					<input class="form-control" name="category" value="'.$category->title.'"><br>
					<input class="btn btn-primary btn-block" type="submit" name="send_category" value="Submit Now">
				</form>
			</div><!-- /.box-body -->
			';

		}

		// create
		if(@$_GET['show'] == 'add_category')
		{	
			echo'
			<div class="box-header">
			  <h3 class="box-title">new cateogry</h3>
			</div>

			<div class="box-body">
				<form action="'.$_SERVER['PHP_SELF'].'" method="post">
					<input class="form-control" name="category"><br>
					<input class="btn btn-primary btn-block" type="submit" name="send_category" value="Submit Now">
				</form>
			</div><!-- /.box-body -->
			';

		}

		// delete
		if(isset($_GET['del_category']))
		{
			$delete = mysqli_query($this->con,"DELETE FROM categories WHERE id = '".$_GET['del_category']."'");
			if($delete)
			{
				echo '<script>alert("you deleted successfully")</script>';
				echo '<script>window.open("index.php","_self")</script>';
			}
		}
	}

	public function all()
	{
		if(@$_GET['show']=='categories')
		{
			$categories = mysqli_query($this->con,"SELECT * FROM categories");

			echo'
				<div class="box-header">
				  <h3 class="box-title">all categories</h3>
				</div>

				<div class="box-body">
					<table class="table table-bordered text-center">
						<tr>
							<th>#</th>
							<th>name</th>
							<th>action</th>
						</tr>';

			while($obj = mysqli_fetch_object($categories))
			{
				echo'		
				<tr>
					<td>'.$obj->id.'</td>
					<td>'.$obj->title.'</td>
					<td ><a href="?category='.$obj->id.'"><i class="fa fa-pencil"></i></a> <a href="?del_category='.$obj->id.'"><i class="fa fa-trash-o"></i></a></td>
				</tr>';					
			}

			echo '
					</table>
				</div><!-- /.box-body -->
				';

		}		
	}
}




class brand extends operation
{

	public function __construct()
	{
		$this->connect();
		$this->single();
		$this->all();
	}

	public function single()
	{

		// insert & update
		if(isset($_POST['send_brand']))
		{
			$brand = $_POST['brand'];
			if($brand != "")
			{
				$query  = "insert into brands (title) values ('$brand')";
				if(@$_GET['brand'])
					$query = "UPDATE brands SET title = '$brand' WHERE id = '".$_GET['brand']."'";

				$run_query = mysqli_query($this->con,$query);
				if($run_query)
				{
					echo '<script>alert("wow amazing you made it successfully")</script>';
					echo '<script>window.open("?brands","_self")</script>';
				}
			}
		}

		// read	
		if(isset($_GET['brand']))
		{
			$brand = mysqli_fetch_object(mysqli_query($this->con,"SELECT * FROM brands WHERE id = '".$_GET['brand']."'"));		
			echo'
			<div class="box-header">
			  <h3 class="box-title">edit brand</h3>
			</div>

			<div class="box-body">
				<form action="?brand='.@$_GET['brand'].'" method="post">
					<input class="form-control" name="brand" value="'.$brand->title.'"><br>
					<input class="btn btn-primary btn-block" type="submit" name="send_brand" value="Submit Now">
				</form>
			</div><!-- /.box-body -->
			';

		}

		// create
		if(@$_GET['show'] == 'add_brand')
		{	
			echo'
			<div class="box-header">
			  <h3 class="box-title">new brand</h3>
			</div>

			<div class="box-body">
				<form action="'.$_SERVER['PHP_SELF'].'" method="post">
					<input class="form-control" name="brand"><br>
					<input class="btn btn-primary btn-block" type="submit" name="send_brand" value="Submit Now">
				</form>
			</div><!-- /.box-body -->
			';

		}

		// delete
		if(isset($_GET['del_brand']))
		{
			$delete = mysqli_query($this->con,"DELETE FROM brands WHERE id = '".$_GET['del_brand']."'");
			if($delete)
			{
				echo '<script>alert("you deleted successfully")</script>';
				echo '<script>window.open("index.php","_self")</script>';
			}
		}
	}

	public function all()
	{
		if(@$_GET['show']=='brands')
		{
			$brands = mysqli_query($this->con,"SELECT * FROM brands");

			echo'
				<div class="box-header">
				  <h3 class="box-title">all brands</h3>
				</div>

				<div class="box-body">
					<table class="table table-bordered text-center">
						<tr>
							<th>#</th>
							<th>name</th>
							<th>action</th>
						</tr>';

			while($obj = mysqli_fetch_object($brands))
			{
				echo'		
				<tr>
					<td>'.$obj->id.'</td>
					<td>'.$obj->title.'</td>
					<td ><a href="?brand='.$obj->id.'"><i class="fa fa-pencil"></i></a> <a href="?del_brand='.$obj->id.'"><i class="fa fa-trash-o"></i></a></td>
				</tr>';					
			}

			echo '
					</table>
				</div><!-- /.box-body -->
				';

		}		
	}
}

class customer extends operation
{

	public function __construct()
	{
		$this->connect();
		$this->single();
		$this->all();
	}	

	public function single()
	{
		// delete
		if(isset($_GET['del_customer']))
		{
			$delete = mysqli_query($this->con,"DELETE FROM users WHERE id = '".$_GET['del_customer']."'");
			if($delete)
			{
				echo '<script>alert("you deleted successfully")</script>';
				echo '<script>window.open("index.php","_self")</script>';
			}
		}
	}

	public function all()
	{
		if(@$_GET['show'] == 'customers')
		{
			$customers = mysqli_query($this->con,"SELECT * FROM users");

			echo'
				<div class="box-header">
				  <h3 class="box-title">all customers</h3>
				</div>

				<div class="box-body">
					<table class="table table-bordered text-center">
						<tr>
							<th>#</th>
							<th>name</th>
							<th>email</th>
							<th>action</th>
						</tr>';

			while($obj = mysqli_fetch_object($customers))
			{
				echo'		
				<tr>
					<td>'.$obj->id.'</td>
					<td>'.$obj->name.'</td>
					<td>'.$obj->email.'</td>
					<td><a href="?del_customer='.$obj->id.'"><i class="fa fa-trash-o"></i></a></td>
				</tr>';					
			}

			echo '
					</table>
				</div><!-- /.box-body -->
				';

		}		
	}	
}



class order extends operation
{

	public function __construct()
	{
		$this->connect();
		$this->all();
	}	

	public function all()
	{
		if(@$_GET['show'] == 'orders')
		{
			$orders = mysqli_query($this->con,"SELECT * FROM orders");

			echo'
				<div class="box-header">
				  <h3 class="box-title">all orders</h3>
				</div>

				<div class="box-body">
					<table class="table table-bordered text-center">
						<tr>
							<th>#</th>
							<th>invoice</th>
							<th>customer</th>
							<th>status</th>
							<th>date</th>
						</tr>';

			while($obj = mysqli_fetch_object($orders))
			{
				$user = mysqli_fetch_object(mysqli_query($this->con,"select * from users where id = '$obj->user_id'"));
				echo'		
				<tr>
					<td>'.$obj->id.'</td>
					<td>'.$obj->invoice_id.'</td>
					<td>'.$user->name.'</td>
					<td>'.$obj->status.'</td>
					<td>'.$obj->date.'</td>
				</tr>';					
			}

			echo '
					</table>
				</div><!-- /.box-body -->
				';

		}		
	}	
}


class payment extends operation
{

	public function __construct()
	{
		$this->connect();
		$this->all();
	}	

	public function all()
	{
		if(@$_GET['show'] == 'payments')
		{
			$payments = mysqli_query($this->con,"SELECT * FROM payments");

			echo'
				<div class="box-header">
				  <h3 class="box-title">all orders</h3>
				</div>

				<div class="box-body">
					<table class="table table-bordered text-center">
						<tr>
							<th>#</th>
							<th>Transaction</th>
							<th>customer</th>
							<th>amount</th>
							<th>currency</th>
							<th>date</th>
						</tr>';

			while($obj = mysqli_fetch_object($payments))
			{
				$user = mysqli_fetch_object(mysqli_query($this->con,"select * from users where id = '$obj->user_id'"));
				echo'		
				<tr>
					<td>'.$obj->id.'</td>
					<td>'.$obj->trx_id.'</td>
					<td>'.$user->name.'</td>
					<td>'.$obj->amount.'</td>
					<td>'.$obj->currency.'</td>
					<td>'.$obj->date.'</td>
				</tr>';					
			}

			echo '
					</table>
				</div><!-- /.box-body -->
				';

		}		
	}	
}
?>