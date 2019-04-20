<?php
$connect = mysqli_connect('localhost','root','','safemedpharmacy');

$name = mysqli_real_escape_string($connect,$_POST['name']);
$login_type = mysqli_real_escape_string($connect,$_POST['login_type']);
$category_name = mysqli_real_escape_string($connect,$_POST['category_name']);

date_default_timezone_set('Asia/Manila');
$date_today = date('F j, Y');

$query = "INSERT INTO dim_category(category_name, added_by, date_added) 
VALUES ('$category_name', '$name', '$date_today')";

if(mysqli_query($connect, $query)){
	header( "Location: categories.php" ); die;
	echo "<script>window.open('categories.php','_self')</script>";
}
if(mysqli_connect_errno($connect)) {
	echo 'Failed to connect';
}


?>

