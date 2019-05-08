<?php
include('connect.php');

$expiredData = array();
$is_expired = false;

// $query = "SELECT date_added, item_id, quantity FROM dim_orders WHERE sku=" . mysqli_escape_string($connect, $_POST['sku']);
$query = "SELECT 
			expiration_date
			, ref_num
			, stock_count
		FROM `dim_inventory` 
		WHERE `expiration_date` < CURDATE() 
		AND (`order_qty` - `defective_qty`) >= 1 
		AND sku=" . mysqli_escape_string($connect, $_POST['sku']);

$result_set = mysqli_query($connect, $query);

if (mysqli_num_rows($result_set) == 0) {
	// header('Location: stock-card.php');
	// die();
	// no products expired
} else {
	$is_expired = true;
	while($row = mysqli_fetch_assoc($result_set)) {
		$expiredData[] = $row;
	}
}

?>