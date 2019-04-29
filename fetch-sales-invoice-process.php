<?php
$connect = mysqli_connect('localhost','root','','safemedpharmacy');

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