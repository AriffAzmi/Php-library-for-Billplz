<?php 
	
	include '../lib/lib.class.php';

	$billplz = new Billplz();
	
	if (isset($_REQUEST['product']) && isset($_REQUEST['p'])) {
		
		$product = str_replace(" ' ", "", $_REQUEST['product']);
		$amount = $_REQUEST['p'];

		$description = $_REQUEST['description'];

		$create_bill = $billplz->CreateBill('John Doe','john.doe@gmail.com','+60123456789',$amount,'http://example.com/payment-gateway/',$description);

		$bill_id = $create_bill->id;
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-6 col-md-offset-3">
					<h1>Confirm your check out and your product details:</h1>

					Product name = <?=$product;?>
					<img src="http://store.storeimages.cdn-apple.com/4973/as-images.apple.com/is/image/AppleInc/aos/published/images/i/ph/iphone6/plus/iphone6-plus-box-silver-2014_GEO_US?wid=478&hei=595&fmt=jpeg&qlt=95&op_sharpen=0&resMode=bicub&op_usm=0.5,0.5,0,0&iccEmbed=0&layer=comp&.v=1453545546605" alt="Iphone" class="img-responsive">
					<br>
					<a class="btn btn-success" href="https://www.billplz.com/bills/<?=$bill_id;?>">Pay Now</a>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
