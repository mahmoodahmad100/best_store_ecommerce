<?php 
# getting the home url (the root folder) 
function home_base_url()
{   
// first get http protocol if http or https
$base_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']!='off') ? 'https://' : 'http://';

// get default website root directory
$tmpURL = dirname(__FILE__);
// when use dirname(__FILE__) will return value like this "C:\xampp\htdocs\my_website",

//convert value to http url use string replace, 
// replace any backslashes to slash in this case use chr value "92"
$tmpURL = str_replace(chr(92),'/',$tmpURL);

// now replace any same string in $tmpURL value to null or ''
// and will return value like /localhost/my_website/ or just /my_website/
$tmpURL = str_replace($_SERVER['DOCUMENT_ROOT'],'',$tmpURL);

// delete any slash character in first and last of value
$tmpURL = ltrim($tmpURL,'/');
$tmpURL = rtrim($tmpURL, '/');


// check again if we find any slash string in value then we can assume its local machine
if (strpos($tmpURL,'/'))
{
	// explode that value and take only first value
	$tmpURL = explode('/',$tmpURL);
	$tmpURL = $tmpURL[0];
}

// assign protocol in first value
if ($tmpURL !== $_SERVER['HTTP_HOST'])
	// if protocol its http then like this
	$base_url .= $_SERVER['HTTP_HOST'].'/'.$tmpURL.'/';
else
	// else if protocol is https
	$base_url .= $tmpURL.'/';

// give return value
return $base_url; 
}

# getting all the Categories
function getCategories()
{
	global $con;

	$query  = "SELECT * FROM categories";
	$result = mysqli_query($con,$query);

	while($obj = mysqli_fetch_object($result))
	{
		echo '<li><a href="index.php?category='.$obj->id.'">'.$obj->title.'</a></li>';
	}
}


# getting all the Brands
function getBrands()
{
	global $con;
	
	$query  = "SELECT * FROM brands";
	$result = mysqli_query($con,$query);

	while($obj = mysqli_fetch_object($result))
	{
		echo '<li><a href="index.php?brand='.$obj->id.'">'.$obj->title.'</a></li>';
	}
}



function getProducts()
{
	global $con;

	# getting all the products in the same category
	if(isset($_GET['category']))
	{
		$category = $_GET['category'];
		$query  = "SELECT * FROM products WHERE cat_id = '$category'";
		$result = mysqli_query($con,$query);

		if(mysqli_num_rows($result) < 1)
			echo '<h3 class="text-center">There Are No Products Yet</h3>';

		while($obj = mysqli_fetch_object($result))
		{
		  echo	'<div class="col-md-4 products-right-grids-bottom-grid">
					<div class="new-collections-grid1 products-right-grid1 animated wow slideInUp" data-wow-delay=".5s">
						<div class="new-collections-grid1-image">
							<a href="single.php?id='.$obj->id.'" class="product-image"><img src="admin/product_images/'.$obj->image.'" alt="no image" class="img-responsive"></a>
							<div class="new-collections-grid1-image-pos products-right-grids-pos">
								<a href="single.php?id='.$obj->id.'">Quick View</a>
							</div>
						</div>
						<h4><a href="single.php?id='.$obj->id.'">'.$obj->title.'</a></h4>
						<div class="simpleCart_shelfItem products-right-grid1-add-cart">
							<p><span class="item_price">'.$obj->price.' $</span><a class="item_add" href="index.php?add_cart='.$obj->id.'">add to cart </a></p>
						</div>
					</div>
				</div>';
		}	
	}


	# getting all the products in the same brand
	elseif(isset($_GET['brand']))
	{
		$brand = $_GET['brand'];
		$query  = "SELECT * FROM products WHERE brand_id = '$brand'";
		$result = mysqli_query($con,$query);

		if(mysqli_num_rows($result) < 1)
			echo '<h3 class="text-center">There Are No Products Yet</h3>';

		while($obj = mysqli_fetch_object($result))
		{
		  echo	'<div class="col-md-4 products-right-grids-bottom-grid">
					<div class="new-collections-grid1 products-right-grid1 animated wow slideInUp" data-wow-delay=".5s">
						<div class="new-collections-grid1-image">
							<a href="single.php?id='.$obj->id.'" class="product-image"><img src="admin/product_images/'.$obj->image.'" alt="no image" class="img-responsive"></a>
							<div class="new-collections-grid1-image-pos products-right-grids-pos">
								<a href="single.php?id='.$obj->id.'">Quick View</a>
							</div>
						</div>
						<h4><a href="single.php?id='.$obj->id.'">'.$obj->title.'</a></h4>
						<div class="simpleCart_shelfItem products-right-grid1-add-cart">
							<p><span class="item_price">'.$obj->price.' $</span><a class="item_add" href="index.php?add_cart='.$obj->id.'">add to cart </a></p>
						</div>
					</div>
				</div>';
		}	
	}


	# getting Random 6 products
	else
	{
		$query  = "SELECT * FROM products ORDER BY RAND() LIMIT 0,6";
		$result = mysqli_query($con,$query);

		while($obj = mysqli_fetch_object($result))
		{
		  echo	'<div class="col-md-4 products-right-grids-bottom-grid">
					<div class="new-collections-grid1 products-right-grid1 animated wow slideInUp" data-wow-delay=".5s">
						<div class="new-collections-grid1-image">
							<a href="single.php?id='.$obj->id.'" class="product-image"><img src="admin/product_images/'.$obj->image.'" alt="no image" class="img-responsive"></a>
							<div class="new-collections-grid1-image-pos products-right-grids-pos">
								<a href="single.php?id='.$obj->id.'">Quick View</a>
							</div>
						</div>
						<h4><a href="single.php?id='.$obj->id.'">'.$obj->title.'</a></h4>
						<div class="simpleCart_shelfItem products-right-grid1-add-cart">
							<p><span class="item_price">'.$obj->price.' $</span><a class="item_add" href="index.php?add_cart='.$obj->id.'">add to cart </a></p>
						</div>
					</div>
				</div>';
		}
	}
}

# getting all the products
function getAllProducts()
{
	global $con;

	$query  = "SELECT * FROM products";
	$result = mysqli_query($con,$query);

	while($obj = mysqli_fetch_object($result))
	{
	  echo	'<div class="col-md-4 products-right-grids-bottom-grid">
				<div class="new-collections-grid1 products-right-grid1 animated wow slideInUp" data-wow-delay=".5s">
					<div class="new-collections-grid1-image">
						<a href="single.php?id='.$obj->id.'" class="product-image"><img src="admin/product_images/'.$obj->image.'" alt="no image" class="img-responsive"></a>
						<div class="new-collections-grid1-image-pos products-right-grids-pos">
							<a href="single.php?id='.$obj->id.'">Quick View</a>
						</div>
					</div>
					<h4><a href="single.php?id='.$obj->id.'">'.$obj->title.'</a></h4>
					<div class="simpleCart_shelfItem products-right-grid1-add-cart">
						<p><span class="item_price">'.$obj->price.' $</span><a class="item_add" href="index.php?add_cart='.$obj->id.'">add to cart </a></p>
					</div>
				</div>
			</div>';
	}
}


# getting all the products from the query (search form)
function getResult()
{
	if(isset($_GET['query']))
	{
		$search_query = $_GET['query'];
		global $con;

		$query  = "SELECT * FROM products WHERE keywords LIKE '%$search_query%'";
		$result = mysqli_query($con,$query);

		if(mysqli_num_rows($result) <  1)
			die('you are searching for: <b>'.$search_query.'</b> and there is no product like that in the website');

		while($obj = mysqli_fetch_object($result))
		{
		  echo	'<div class="col-md-4 products-right-grids-bottom-grid">
					<div class="new-collections-grid1 products-right-grid1 animated wow slideInUp" data-wow-delay=".5s">
						<div class="new-collections-grid1-image">
							<a href="single.php?id='.$obj->id.'" class="product-image"><img src="admin/product_images/'.$obj->image.'" alt="no image" class="img-responsive"></a>
							<div class="new-collections-grid1-image-pos products-right-grids-pos">
								<a href="single.php?id='.$obj->id.'">Quick View</a>
							</div>
						</div>
						<h4><a href="single.php?id='.$obj->id.'">'.$obj->title.'</a></h4>
						<div class="simpleCart_shelfItem products-right-grid1-add-cart">
							<p><span class="item_price">'.$obj->price.' $</span><a class="item_add" href="index.php?add_cart='.$obj->id.'">add to cart </a></p>
						</div>
					</div>
				</div>';
		}
	}
	else
	{
		die("you are not allowed to go to the previus page");
	}
}

# getting the use ip
function get_ip() 
{
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
 
    return $ipaddress;
}

# adding products to the cart
function addToCart()
{
	if(isset($_GET['add_cart']))
	{
		$ip = get_ip();
		if($ip == 'UNKNOWN')
			echo '<script>alert("please try again later")</script>';
		else
		{
			$product = $_GET['add_cart'];
			global $con;

			$select = "SELECT * FROM cart WHERE product_id = '$product' AND ip_address = '$ip'";
			$result = mysqli_query($con,$select);

			if(mysqli_num_rows($result) > 0)
				echo '<script>alert("you already added this product to the cart")</script>';
			else
			{
				$selectProduct = mysqli_query($con,"SELECT * FROM products WHERE id = '$product'");

				if(mysqli_num_rows($selectProduct) > 0)
				{
					$insert = "INSERT INTO cart (product_id,ip_address,quantity) VALUES ('$product','$ip',1)";
					$result = mysqli_query($con,$insert); 

					if($result)
					{
						echo '<script>alert("you added this product to the cart successfully")</script>';
						echo '<script>window.open("index.php","_self")</script>';
					}
					else
						echo '<script>alert("please try again later")</script>';
				}

				else
					echo '<script>alert("There is no product like that")</script>';
			}
		}
	}
}

# displaying the products in the cart
function cartInfo()
{
	global $con;
	$ip = get_ip();

	if(isset($_SESSION['email']))
	{
		$selectUser = mysqli_query($con,"SELECT * FROM users WHERE email = '".$_SESSION['email']."'");
		while($user = mysqli_fetch_object($selectUser))
			$cartInfo = mysqli_query($con,"SELECT * FROM cart WHERE ip_address = '$user->ip_address'");
	}
	else
		$cartInfo = mysqli_query($con,"SELECT * FROM cart WHERE ip_address = '$ip'");		

	while($cart = mysqli_fetch_object($cartInfo))
	{
		$productInfo = mysqli_query($con,"SELECT * FROM products WHERE id = '$cart->product_id'");
		while($product = mysqli_fetch_object($productInfo))
		{
			echo    '<tr>
						<td class="invert">'.$product->id.'</td>
						<td class="invert-image"><a href="single.php?id='.$product->id.'"><img src="admin/product_images/'.$product->image.'" class="img-responsive" /></a></td>
						<td class="invert">
							 <div class="quantity"> 
								<div class="quantity-select">                           
									<div class="entry value-minus">&nbsp;</div>
									
									<div class="entry value"><span>'.$cart->quantity.'</span></div>
									<input class="quantityValue" value="'.$cart->quantity.'" type="hidden" name="quantity[]">
									<input type="hidden" name="product_id[]" value="'.$product->id.'">

									<div class="entry value-plus active">&nbsp;</div>
								</div>
							</div>
						</td>
						<td class="invert">'.$product->title.'</td>
						<td class="invert">$'.$product->price * $cart->quantity.'</td>
						<td class="invert">
							<div class="rem">
								<a href="cart.php?delete='.$product->id.'"><div class="close1"> </div></a>
							</div>
						</td>
					</tr>';
		}
	}
}

# updating the cart
function updateCart()
{
	global $con;
	$ip = get_ip();

	// delete a product from the cart  
	if(isset($_GET['delete']))
	{
		$id = $_GET['delete'];
		$delete = mysqli_query($con, "DELETE FROM cart WHERE product_id = '$id' AND ip_address = '$ip'");
		echo '<script>window.open("cart.php","_self")</script>';
	}

	// 	update the cart with the new quantity
	$cartInfo = mysqli_query($con,"SELECT * FROM cart WHERE ip_address = '$ip'");
	if(isset($_POST['update']))
	{
		$products = $_POST['product_id'];
		$q = $_POST['quantity'];
		$i = 0; 
		foreach($products as $product)
		{
			$update = mysqli_query($con,"UPDATE cart SET quantity = '$q[$i]' WHERE product_id ='$product' AND ip_address = '$ip'");
			if($update)
			{
				echo "<script>alert('the cart is updated')</script>";
				echo "<script>window.open('cart.php','_self')</script>";
			}

			$i++;
		}
	}
}

# checkout
function checkout()
{
	global $con;
	$ip = get_ip();

	if(isset($_SESSION['email']))
	{
		$selectUser = mysqli_query($con,"SELECT * FROM users WHERE email = '".$_SESSION['email']."'");
		while($user = mysqli_fetch_object($selectUser))
			$cartInfo = mysqli_query($con,"SELECT * FROM cart WHERE ip_address = '$user->ip_address'");
	}
	else
		$cartInfo = mysqli_query($con,"SELECT * FROM cart WHERE ip_address = '$ip'");		
		$total = 0;
		$i = 0;
	while($cart = mysqli_fetch_object($cartInfo))
	{
		$productInfo = mysqli_query($con,"SELECT * FROM products WHERE id = '$cart->product_id'");
		while($product = mysqli_fetch_object($productInfo))
		{
			$total += $product->price * $cart->quantity;
			$object[$i] = ['name' => $product->title , 'price' => $product->price , 'quantity' => $cart->quantity , 'currency' => 'USD'];
			$i++;
		}
	}

	echo $total."<br>";
	echo json_encode($object);
}

// Register a New User
function register()
{
	if(isset($_POST['register']))
	{	
		$ip = get_ip();
		if($ip == 'UNKNOWN')
			die ('<script>alert("please try again later")</script>');

		global $con;
		$errors = [];
		$name     = $_POST['name'];
		$email    = $_POST['email'];
		$password = md5($_POST['password']);
		$re_pass  = md5($_POST['re_pass']);

		if($name == "" || $email == "" || $password == "" || $re_pass == "")
			$errors['empty'] = "please fill out all the feilds";
		else
		{
			if (!filter_var($email, FILTER_VALIDATE_EMAIL))
				$errors['email'] = "Invalid email";
			else
			{	
				// check if the email is in the database
				$select = "SELECT * FROM users WHERE email = '$email'";
				$result = mysqli_query($con,$select);
				if(mysqli_num_rows($result) > 0)
					$errors['email'] = "This email exists";
			}

			if($password != $re_pass)
				$errors['password'] = "please type the same password";			
		}

		if(count($errors) > 0)
		{
			echo   '<div class="alert alert-danger">
						<ul>';
			foreach($errors as $error)
			{

				echo '<li>'.$error.'</li>';
			}
			echo 		'</ul>
					</div>';
		}
		else
		{
			$insert = "INSERT INTO users (ip_address,name,email,password) VALUES ('$ip','$name','$email','$password')";
			$result = mysqli_query($con,$insert);
			if($result)
			{
				$_SESSION['email'] = $email;
				echo "<script>window.open('index.php','_self')</script>";
			}
		}
	}
}

// Login a User
function login()
{
	if(isset($_POST['login']))
	{	
		global $con;
		$errors = [];
		$email    = $_POST['email'];
		$password = md5($_POST['password']);

		if($email == "" || $password == "")
			$errors['empty'] = "please fill out all the feilds";
		else
		{
			if (!filter_var($email, FILTER_VALIDATE_EMAIL))
				$errors['email'] = "Invalid email";
			else
			{	
				// check if the user is in the database
				$select = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
				$result = mysqli_query($con,$select);
				if(mysqli_num_rows($result) < 1)
					$errors['email'] = "The email or the password is wrong";
			}	
		}

		if(count($errors) > 0)
		{
			echo   '<div class="alert alert-danger">
						<ul>';
			foreach($errors as $error)
			{

				echo '<li>'.$error.'</li>';
			}
			echo 		'</ul>
					</div>';
		}
		else
		{
			// check if the user is in the database
			$select = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
			$result = mysqli_query($con,$select);
			if(mysqli_num_rows($result) == 1)
			{
				$_SESSION['email'] = $email;
				if($_SESSION['url'] == 'admin')
					echo "<script>window.open('admin/index.php','_self')</script>";
				elseif($_SESSION['url'] == 'checkout')
					echo "<script>window.open('checkout.php','_self')</script>";
				else
					echo "<script>window.open('index.php','_self')</script>";
			}
		}
	}
}

// user account 
function account()
{
	global $con;
	$select = "SELECT * FROM users WHERE email = '".$_SESSION['email']."'";
	$result = mysqli_query($con,$select);
	$user   = mysqli_fetch_object($result);

	# show what the user want to do #
	if(isset($_GET['orders']))
	{
		$orders = mysqli_query($con,"SELECT * FROM orders WHERE user_id = '$user->id'");
		echo '<h3 style="margin-bottom:20px;">my orders</h3>
			<table class="table table-bordered text-center">
				<tr>
					<th>#</th>
					<th>invoice</th>
					<th>status</th>
					<th>date</th>
				</tr>';	

		while($obj = mysqli_fetch_object($orders))
		{
			echo'		
			<tr>
				<td>'.$obj->id.'</td>
				<td>'.$obj->invoice_id.'</td>
				<td>'.$obj->status.'</td>
				<td>'.$obj->date.'</td>
			</tr>';					
		}

		echo '
				</table>
			</div><!-- /.box-body -->
			';	

	}

	elseif(isset($_GET['settings']))
	{
		echo '<form action="my_account.php?settings" method="post">
			<h2><i>user info</i></h2>	

			<label style="margin-top:15px;" for="">name</label>
			<input style="margin-top:5px;" class="form-control" name="name" value="'.$user->name.'">

			<label style="margin-top:15px;" for="">email</label>
			<input style="margin-top:5px;" class="form-control" name="email" value="'.$user->email.'">
			
			<button type="submit" name="user_info" style="margin-top:15px; margin-bottom:10px;" class="btn btn-info btn-block"><b>update</b></button>
		</form>
		<form action="my_account.php?settings" method="post">
			<h2><i>password info</i></h2>	

			<label style="margin-top:15px;" for="">current password</label>
			<input style="margin-top:5px;" class="form-control" name="password" type="password">

			<label style="margin-top:15px;" for="">New Password</label>
			<input style="margin-top:5px;" class="form-control" name="new_pass" type="password">

			<label style="margin-top:15px;" for="">Password Confirmation</label>
			<input style="margin-top:5px;" class="form-control" name="re_pass" type="password">
			
			<button type="submit" name="password_info" style="margin-top:15px; margin-bottom:10px;" class="btn btn-warning btn-block"><b>update</b></button>
		</form>';
	}

	else
		echo "<h3>welcome to your account</h3>";
}

// updating the user account
function update_account()
{
	global $con;
	$select = "SELECT * FROM users WHERE email = '".$_SESSION['email']."'";
	$result = mysqli_query($con,$select);
	$user   = mysqli_fetch_object($result);
	$errors = [];

	if(isset($_POST['user_info']))
	{
		$name   = $_POST['name'];
		$email  = $_POST['email'];	

		if($email == "" || $name == "")
			$errors['empty'] = "please fill out all the feilds";
		else
		{
			$email_ex = mysqli_query($con,"SELECT * FROM users WHERE email = '$email'");

			if (!filter_var($email, FILTER_VALIDATE_EMAIL))
				$errors['email'] = "Invalid email";

			elseif(mysqli_num_rows($email_ex) > 0 && $email != $_SESSION['email'])
				$errors['email_ex'] = "this email exists in the website";

			else
			{	
				// update the user info 
				$update = mysqli_query($con,"UPDATE users SET name = '$name', email = '$email' WHERE email = '".$_SESSION['email']."'");
				if($update)
				{
					echo "<script>alert('your info is updated')</script>";
					echo "<script>window.open('my_account.php?settings','_self')</script>";
					$_SESSION['email'] = $email;
				}
			}	
		}
	}

	if(isset($_POST['password_info']))
	{
		$pass   = $_POST['password'];
		$n_pass = $_POST['new_pass'];
		$r_pass = $_POST['re_pass'];

		if($pass == "" || $n_pass == "" || $r_pass == "")
			$errors['empty'] = "please fill out all the feilds";
		elseif($user->password != md5($pass))
			$errors['old_pass'] = "the password is wrong";	
		elseif($n_pass != $r_pass)
			$errors['password'] = "please type the same password";			
		else
		{	
			// update the user password 
			$n_pass = md5($_POST['new_pass']);
			$update = mysqli_query($con,"UPDATE users SET password = '$n_pass' WHERE email = '".$_SESSION['email']."'");
			if($update)
			{
				echo "<script>alert('you have changed your password!')</script>";
				echo "<script>window.open('my_account.php?settings','_self')</script>";
			}
		}
	}

	# show all the errors #
	if(count($errors) > 0)
	{
		echo   '<div class="alert alert-danger">
					<ul>';
		foreach($errors as $error)
		{

			echo '<li>'.$error.'</li>';
		}
		echo 		'</ul>
				</div>';
	}
}

 ?>
