<?php
$connect=mysqli_connect('localhost','root','','safemedpharmacy');

$ref_num = $_POST['ref_num'];

$query = "DELETE FROM dim_inventory WHERE ref_num = $ref_num";

if(mysqli_query($connect, $query)){
	$item_id = mysqli_insert_id($connect);
	$ref_num += $item_id;
	header( "Location: purchase-order.php" ); die;
	echo "<script>window.open('purchase-order.php','_self')</script>";
} elseif(mysqli_connect_errno($connect)) {
	echo 'Failed to connect';
}

?>