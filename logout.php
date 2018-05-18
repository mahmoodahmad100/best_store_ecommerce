<?php 
session_start();

if(isset($_SESSION['email']))
	session_destroy();

echo "<script>window.open('index.php','_self')</script>";
 ?>