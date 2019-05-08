<?php
include('connect.php');

$salesData = array();
$is_sold = false;

$query = "SELECT date_added, item_id, quantity FROM dim_orders WHERE sku=" . mysqli_escape_string($connect, $_POST['sku']);

$result_set = mysqli_query($connect, $query);

if (mysqli_num_rows($result_set) == 0) {
	// header('Location: stock-card.php');
	// die();

	// no products sold
} else {
	$is_sold = true;
	while($row = mysqli_fetch_assoc($result_set)) {
		$salesData[] = $row;
	}
}

?>