<?php

$connect = mysqli_connect('localhost','root','','safemedpharmacy');

$name = $_POST['name'];
$item_id = $_POST['item_id'];
$sku = $_POST['sku'];
$defective_qty = $_POST['defective_qty'];
$exp_date = $_POST["expiration_date"];
$expiration_date = date('Y-m-j', strtotime($exp_date));
$unit_price = $_POST['unit_price'];
$order_qty = $_POST['order_qty'];
$uom = $_POST['uom'];
$defective_qty = $_POST['defective_qty'];
$selling_price = $_POST['selling_price'];
$total_price1 = $order_qty - $defective_qty;
$total_price = $total_price1 * $unit_price;

$query = "UPDATE dim_inventory set 
expiration_date = '$expiration_date',
defective_qty = '$defective_qty',
unit_price = '$unit_price',
order_qty = '$order_qty',
uom = '$uom',
selling_price = '$selling_price',
total_price = '$total_price',
status = 'Received',
stock_count = $order_qty
WHERE sku = '$sku'";

if(mysqli_query($connect, $query)){
	header( "Location: purchase-order.php" ); die;
	echo "<script>window.open('purchase-order.php','_self')</script>";
} else {
	echo mysqli_error($connect);
}

if(mysqli_connect_errno($connect)) {
	echo 'Failed to connect';
}

?>

