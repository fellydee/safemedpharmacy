<?php
	session_start();
	
	unset($_SESSION['username']);
	unset($_SESSION['password']);
	unset($_SESSION['name']);
	unset($_SESSION['login_type']);
	session_destroy();
	session_write_close();
	
	die(header('Location:login.php'));
?>