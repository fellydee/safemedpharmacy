<!-- Currently bugging out on this page - I suspect a change in database structure is causing this -->

<?php
$connect=mysqli_connect('localhost','root','','safemedpharmacy');
$sku = $_POST['sku'];

$name = mysqli_real_escape_string($connect,$_POST['name']);
$sku = mysqli_real_escape_string($connect,$_POST['sku']);
$brand_name = mysqli_real_escape_string($connect,$_POST['brand_name']);
$supplier = mysqli_real_escape_string($connect,$_POST['supplier']);
$defective_qty = mysqli_real_escape_string($connect,$_POST['defective_qty']);
$generic_name = mysqli_real_escape_string($connect,$_POST['generic_name']);
$uom = mysqli_real_escape_string($connect,$_POST['uom']);
$category = mysqli_real_escape_string($connect,$_POST['category']);
$order_qty = mysqli_real_escape_string($connect,$_POST['order_qty']); 

date_default_timezone_set('Asia/Manila');
$date_today = date('Y-m-j');

$query = "INSERT INTO dim_inventory(brand_name, generic_name, uom, supplier, defective_qty, order_qty, unit_price, selling_price, total_price, category, expiration_date, added_by, date_added, status, sku) 
VALUES ('$brand_name', '$generic_name', '$uom', '$supplier', '$defective_qty', '$order_qty', 123, 456, 789, '$category', '1992-11-13', 'Added by', '$date_today', 'Filed', $sku')";


if(mysqli_query($connect, $query)){
	header( "Location: purchase-order.php" );
	die();
	echo "<script>window.open('purchase-order.php','_self')</script>";
} else if(mysqli_connect_errno($connect)) {
	echo 'Failed to connect';
}

?>