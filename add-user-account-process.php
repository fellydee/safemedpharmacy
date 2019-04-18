<?php
$connect=mysqli_connect('localhost','root','','safemedpharmacy');

			$employee_name = mysqli_real_escape_string($connect,$_POST['employee_name']);
			$username = mysqli_real_escape_string($connect,$_POST['username']);
			$password = mysqli_real_escape_string($connect,$_POST['password']);
			$login_type = mysqli_real_escape_string($connect,$_POST['login_type']);


			$query = "INSERT INTO dim_login(username, password, name, login_type, status) 
			VALUES ('$username', md5('$password'), '$employee_name', '$login_type', 'active')";

			if(mysqli_query($connect, $query)){
			header( "Location: user-account.php" ); die;
			echo "<script>window.open('user-account.php','_self')</script>";
			}
			if(mysqli_connect_errno($connect))
			{
				echo 'Failed to connect';
			}
		
			
?>

