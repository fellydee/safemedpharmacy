<?php

session_start();

$connect = mysqli_connect('localhost','root','','safemedpharmacy');

$item_id = mysqli_real_escape_string($connect,$_POST['item_id']);
$sku = mysqli_real_escape_string($connect,$_POST['sku']);
$brand_name = mysqli_real_escape_string($connect,$_POST['brand_name']);
$generic_name = mysqli_real_escape_string($connect,$_POST['generic_name']);
$quantity = mysqli_real_escape_string($connect,$_POST['quantity']);
$selling_price = mysqli_real_escape_string($connect,$_POST['selling_price']);
$stock_count = mysqli_real_escape_string($connect,$_POST['stock_count']);
$stock_count -= $quantity;

date_default_timezone_set('Asia/Manila');
$date_added = date('Y-m-j');

if (isset($_POST['discount']) && $_POST['discount'] === 'yes') {
	$price = $quantity * $selling_price;
	$vat_exempt = $price / 1.12;
	$discount = $vat_exempt * .20;
	$final_price = $price - $discount;
	$vat = 0;

	$query = "INSERT INTO dim_orders (
				item_id
				, sku
				, brand_name
				, generic_name
				, quantity
				, discount
				, price
				, vat
				, vat_exempt
				, date_added
				) 
			VALUES (
				'$item_id'
				, '$sku'
				, '$brand_name'
				, '$generic_name'
				, '$quantity'
				, '$discount'
				, '$final_price'
				, '$vat'
				, '$vat_exempt'
				, '$date_added'
			)";
} else {
	$price = $quantity * $selling_price;
	$vat_exempt = $price / 1.12;
	$vat = $price - $vat_exempt;

	$query = "INSERT INTO dim_orders (
				item_id
				, sku
				, brand_name
				, generic_name
				, quantity
				, price
				, vat
				, vat_exempt
				, date_added
				) 
			VALUES (
				'$item_id'
				, '$sku'
				, '$brand_name'
				, '$generic_name'
				, '$quantity'
				, '$price'
				, '$vat'
				, '$vat_exempt'
				, '$date_added'
			)";
}

$update_stock_count_query = "UPDATE dim_inventory SET stock_count = $stock_count WHERE item_id = $item_id";

if ( mysqli_query($connect, $query) ) {
	if ( mysqli_query($connect, $update_stock_count_query) ) {
		$_SESSION['stock_count'] = $stock_count;
		$_SESSION['item_name'] = $generic_name . ' ' . $brand_name;

		header( "Location: pos.php" ); 
		die;
		echo "<script>window.open('pos.php','_self')</script>";
	} else {
		echo mysqli_error($connect);
	}
} else {
	echo mysqli_error($connect);
}

?>

<!-- $transaction = "SELECT MAX(transaction_id)+1 FROM dim_orders"; -->
			<!-- $transaction_id = mysqli_query($connect, $transaction); -->