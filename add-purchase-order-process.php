<?php
session_start();

$connect = mysqli_connect('localhost','root','','safemedpharmacy');

$name = $_SESSION['name'];
$name = mysqli_real_escape_string($connect,$_POST['name']);
$sku = mysqli_real_escape_string($connect,$_POST['sku']);
$brand_name = mysqli_real_escape_string($connect,$_POST['brand_name']);
$supplier = mysqli_real_escape_string($connect,$_POST['supplier']);
$defective_qty = mysqli_real_escape_string($connect,$_POST['defective_qty']);
$generic_name = mysqli_real_escape_string($connect,$_POST['generic_name']);
$uom = mysqli_real_escape_string($connect,$_POST['uom']);
$category = mysqli_real_escape_string($connect,$_POST['category']);
$order_qty = mysqli_real_escape_string($connect,$_POST['order_qty']); 
$selling_price = mysqli_real_escape_string($connect,$_POST['selling_price']); 
$unit_price = mysqli_real_escape_string($connect,$_POST['unit_price']); 
$expiration_date = mysqli_real_escape_string($connect,$_POST['expiration_date']); 
$total_price = $unit_price * $order_qty;

date_default_timezone_set('Asia/Manila');
$date_today = date('Y-m-j');	

$query = "INSERT INTO dim_inventory(
			brand_name 
			, generic_name
			, uom
			, supplier
			, defective_qty
			, order_qty
			, unit_price
			, selling_price
			, total_price
			, category
			, expiration_date
			, added_by
			, date_added
			, status
			, sku
		) VALUES (
			'$brand_name'
			, '$generic_name'
			, '$uom'
			, '$supplier'
			, '$defective_qty'
			, '$order_qty'
			, '$unit_price'
			, '$selling_price'
			, '$total_price'
			, '$category'
			, STR_TO_DATE('$expiration_date','%d/%m/%Y')
			, '$name'
			, '$date_today'
			, 'Filed'
			, '$sku'
		)";

if(mysqli_query($connect, $query)){
	header( "Location: purchase-order.php" );
	die();
	echo "<script>window.open('purchase-order.php','_self')</script>";
} else if(mysqli_connect_errno($connect)) {
	echo 'Failed to connect';
} else {
  printf("error: %s\n", mysqli_error($connect));
}

?>