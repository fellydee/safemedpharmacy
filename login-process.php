<?php

$username = $_POST['username'];
$password = md5($_POST['password']);

include('connect.php');

	$username = stripcslashes($username);
	$password = stripcslashes($password);
	$username = mysqli_real_escape_string($connect, $username);
	$password = mysqli_real_escape_string($connect, $password);

$query = mysqli_query($connect, "SELECT id, username, password, name, login_type, status FROM dim_login WHERE username = '$username' and password = '$password'") or die("User not found".mysqli_error());
$result = mysqli_fetch_array($query);

if($result['username'] == $username && $result['password'] == $password && $result['status'] == 'Active') {
	session_start();
	$_SESSION['login_type'] = $result['login_type'];
	$_SESSION['username'] = $username;
	$_SESSION['name'] = $result['name'];
	$login_type = $_SESSION['login_type'];
	$name = $_SESSION['name'];

	date_default_timezone_set('Asia/Manila');
	$date_today = date('F j, Y g:i:a  ');

	$log_history = mysqli_query($connect, "INSERT INTO dim_loghistory(username, name, login_type, date_login) VALUES ('$username', '$name', '$login_type', '$date_today')");

	header("Location: index.php"); die;
}

else {
	header("Location: login-error.php");
}

?>