<?php
include('includes/db.php');
include('functions/functions.php');
include('includes/header.php');

if(!isset($_SESSION['email']))
{
	$_SESSION['url'] = 'checkout';
	echo "<script>window.open('login.php','_self')</script>";
}

 ?>
<div class="container">
	<div class="col-md-12 text-center" style="margin-top:43px; margin-bottom: 43px;">
		<h2 style="margin-bottom: 20px;">pay with:</h2>
		<div id="paypal-button"></div>
	</div>
	<div class="clearfix"> </div>
</div>

<?php

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

 ?>

<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script>
    paypal.Button.render({

        env: 'sandbox', // Or 'sandbox'

        client: {
            sandbox:    'AcqHgXnAE1Dd2g2_hrA3VArkqzjyznPmraamsaqzlU-bWpJQpicHnhZ7ZvlQL8nn3EwnCN2AY5wcWfXh',
            production: 'AY6Zfk8ayPvm1WAzxPAEVyuzKYL3kA-V_LvmOdX1JXE7DTD3Hk47yiXVPlKMFj72l0D6bJogh8L9AeKw'
        },

        commit: true, // Show a 'Pay Now' button

        payment: function(data, actions) {
            return actions.payment.create({
                payment: {
                    transactions: [
                        {
                            amount: { total: <?php echo $total ?>, currency: 'USD' },
                            item_list:{
                            	items: <?php echo json_encode($object) ?>
                            }
                        }
                    ]
                }
            });
        },

        onAuthorize: function(data, actions) {
            return actions.payment.execute().then(function(payment) {
            	 window.location.href='?trx=1&token=' + data.paymentToken;
            });
        }

    }, '#paypal-button');
</script>


<?php 

if(@$_GET['trx'] == 1)
{
	global $con;
	$invoice = 'inv-'.strtotime("now");
	$token   = $_GET['token'];
	$user    = mysqli_fetch_object(mysqli_query($con,"SELECT * FROM users WHERE email = '".$_SESSION['email']."'")); 

	$insertOrder   = mysqli_query($con,"INSERT INTO orders (invoice_id,user_id,status,date) VALUES ('$invoice','$user->id','in progress',NOW())");	
	$insertPayment = mysqli_query($con,"INSERT INTO payments (trx_id,user_id,amount,currency,date) VALUES ('$token','$user->id','$total','USD',NOW())");
	$deleteCart    = mysqli_query($con, "DELETE FROM cart WHERE ip_address = '$user->ip_address'");


	#send email
	$to = $user->email;
	$subject = "order done!!!";
	$txt = "your order has done successfully and the you spend $".$total;
	$headers = "From: localhost@localhost.com" . "\r\n";
	mail($to,$subject,$txt,$headers); 

	echo '<script>window.open("customer/my_account.php?orders","_self")</script>';	
}
	
 ?>

<?php include('includes/footer.php'); ?>