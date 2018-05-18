<?php 
# Connect to the DB 'ecommerce'
$con = mysqli_connect('localhost','root',11111,'ecommerce');
if(!$con)
	die('Cann\'t connect the the DB');
?>