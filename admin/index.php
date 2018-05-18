<?php 
require 'admin.php';

$admin = new operation();

require 'includes/header.php';

if(!@$_GET['show'] && !@$_GET['del_product'] && !@$_GET['product'])
	require 'includes/main.php';

$product  = new product();
$category = new category();
$brand    = new brand();
$customer = new customer();
$order    = new order();
$payment  = new payment();

require 'includes/footer.php';

 ?>
