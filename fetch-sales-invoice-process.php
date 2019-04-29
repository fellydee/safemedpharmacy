<?php

// screenshot: https://i.imgur.com/uXReD8z.png

// session_start();
$connect = mysqli_connect('localhost','root','','safemedpharmacy');
// $_SESSION['productFound'] = false;

if(!$_SESSION['username']) {
    header("Location: login.php");
}
else {
    $username = $_SESSION['username'];
    $name = $_SESSION['name'];
    $login_type = $_SESSION['login_type'];
}

$salesData = array();
$_SESSION['sku'] = $_POST['sku'];
$is_sold = false;
// $medicine_name = '';
// $balance = 0;

// Add the ff. into database table structure:
// reference number
// beginning balance (where to get this?)
// where to get number of expired?

// $query = "SELECT date_added, brand_name, generic_name, ref_num, status, order_qty FROM dim_inventory WHERE sku=" . mysqli_escape_string($connect, $_POST['sku']);
$query = "SELECT date_added, item_id, quantity FROM dim_orders WHERE sku=" . mysqli_escape_string($connect, $_POST['sku']);

$result_set = mysqli_query($connect, $query);

if (mysqli_num_rows($result_set) == 0) {
	header('Location: stock-card.php');
	die();
} else {
	$is_sold = true;
	while($row = mysqli_fetch_assoc($result_set)) {
		$salesData[] = $row;
	}
}

?>