<?php

// maglagay ka ng session start dito
 session_start();

$connect=mysqli_connect('localhost','root','','safemedpharmacy');

$ref_num = $_POST['ref_num'];
$_SESSION['ref_num'] = $ref_num;

$_SESSION['is_cancelled'] = FALSE;

$query = "DELETE FROM dim_inventory WHERE ref_num = $ref_num";

if (mysqli_query($connect, $query)) {
	$_SESSION['is_cancelled'] = TRUE;

	header( "Location: purchase-order.php" ); 
	die;
	echo "<script>window.open('purchase-order.php','_self')</script>";
} elseif(mysqli_connect_errno($connect)) {
	echo 'Failed to connect';
}

?>