<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<title>Best Store a Ecommerce Online Shopping Category Flat Bootstrap Responsive Website Template | Home :: w3layouts</title>
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Best Store Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //for-mobile-apps -->
<link href="http://localhost/ecommerce-website/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="http://localhost/ecommerce-website/css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- js -->
<script src="http://localhost/ecommerce-website/js/jquery.min.js"></script>
<!-- //js -->
<!-- cart -->
<script src="http://localhost/ecommerce-website/js/simpleCart.min.js"></script>
<!-- cart -->
<!-- for bootstrap working -->
<script type="text/javascript" src="http://localhost/ecommerce-website/js/bootstrap-3.1.1.min.js"></script>
<!-- //for bootstrap working -->
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- timer -->
<link rel="stylesheet" href="http://localhost/ecommerce-website/css/jquery.countdown.css" />
<!-- //timer -->
<!-- animation-effect -->
<link href="http://localhost/ecommerce-website/css/animate.min.css" rel="stylesheet"> 
<script src="http://localhost/ecommerce-website/js/wow.min.js"></script>
<script>
 new WOW().init();
</script>
<!-- //animation-effect -->
</head>

<?php 
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
 ?>

<body>
<!-- header -->
	<div class="header">
		<div class="container">
			<div class="header-grid">
				<div class="header-grid-left animated wow slideInLeft" data-wow-delay=".5s">
					<ul>
						<li><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i><a href="mailto:info@example.com">info@example.com</a></li>
						<li><i class="glyphicon glyphicon-earphone" aria-hidden="true"></i>+1234 567 892</li>

						<?php if(!isset($_SESSION['email'])){ ?>
						<li><i class="glyphicon glyphicon-log-in" aria-hidden="true"></i><a href="<?php echo $base_url; ?>login.php">Login</a></li>
						<li><i class="glyphicon glyphicon-book" aria-hidden="true"></i><a href="<?php echo $base_url; ?>register.php">Register</a></li>
						<?php 
						}
						else
							echo '<li><i class="glyphicon glyphicon-log-out" aria-hidden="true"></i><a href="'.$base_url.'logout.php">Logout</a></li>';
						 ?>

					</ul>
				</div>
				<div class="clearfix"> </div>
			</div>
			<div class="logo-nav">
				<div class="logo-nav-left animated wow zoomIn" data-wow-delay=".5s">
					<h1><a href="<?php echo $base_url; ?>index.php">Best Store <span>Shop anywhere</span></a></h1>
				</div>
				<div class="logo-nav-left1">
					<nav class="navbar navbar-default">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header nav_2">
						<button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div> 
					<div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
						<ul class="nav navbar-nav">
							<li class="active"><a href="<?php echo $base_url; ?>index.php" class="act">Home</a></li>	
							<li class="active"><a href="<?php echo $base_url; ?>products.php" class="act">Products</a></li>	
							<?php 
							if(isset($_SESSION['email'])) 
								echo '<li><a href="'.$base_url.'customer/my_account.php">My Account</a></li>';
							?>
							<li><a href="<?php echo $base_url; ?>mail.php">Mail Us</a></li>
						</ul>
					</div>
					</nav>
				</div>
				<div class="logo-nav-right">
					<div class="search-box">
						<div id="sb-search" class="sb-search">
							<form action="<?php echo $base_url; ?>result.php" method="get">
								<input class="sb-search-input" placeholder="Enter your search term..." type="search" name="query" id="search">
								<input class="sb-search-submit" type="submit" value="">
								<span class="sb-icon-search"> </span>
							</form>
						</div>
					</div>
						<!-- search-scripts -->
						<script src="<?php echo $base_url; ?>js/classie.js"></script>
						<script src="<?php echo $base_url; ?>js/uisearch.js"></script>
							<script>
								new UISearch( document.getElementById( 'sb-search' ) );
							</script>
						<!-- //search-scripts -->
				</div>
				<div class="header-right">
					<div class="cart box_1">
						<a href="<?php echo $base_url; ?>cart.php">
							<h3> <div class="total">
							<?php 
								$page = basename($_SERVER['SCRIPT_NAME'],'.php');
								if($page == "my_account")
									include("../includes/db.php");
								else
									include("includes/db.php");

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

								$select = mysqli_query($con,"SELECT * FROM cart WHERE ip_address = '$ipaddress'");
								$items  = mysqli_num_rows($select);
								$price  = 0; 

								while($cart = mysqli_fetch_object($select))
								{
									$selectProduct = mysqli_query($con,"SELECT * FROM products WHERE id = '$cart->product_id'");
									while($product = mysqli_fetch_object($selectProduct)) 
									{	
									    $price += $product->price * $cart->quantity;
									}
								}
								echo '$'.$price.' ('.$items,($items == 1 ? ' item)' : ' items)');

								if(isset($_GET['empty_cart']))
								{
									$delete = mysqli_query($con,"DELETE FROM cart WHERE ip_address = '$ipaddress'");
									if($delete)
									{
										echo '<script>alert("the cart is empty now")</script>';
										echo '<script>window.open("'.$base_url.'index.php","_self")</script>';
									}	
								}
							 ?>
								</div>
								<img src="<?php echo $base_url; ?>images/bag.png" alt="" />
							</h3>
						</a>
						<p><a href="<?php echo $base_url; ?>index.php?empty_cart" class="simpleCart_empty">Empty Cart</a></p>
						<div class="clearfix"> </div>
					</div>	
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
<!-- //header -->

<!-- breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
				<li><a href="<?php echo $base_url; ?>index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
				<li class="active">Short Codes</li>
			</ol>
		</div>
	</div>
<!-- //breadcrumbs -->