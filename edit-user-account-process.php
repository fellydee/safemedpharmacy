<?php
$connect=mysqli_connect('localhost','root','','safemedpharmacy');

			$id = mysqli_real_escape_string($connect,$_POST['id']);
			$employee_name = mysqli_real_escape_string($connect,$_POST['employee_name']);
			$username = mysqli_real_escape_string($connect,$_POST['username']);
            $password = md5($_POST['password']);
           	$login_type = mysqli_real_escape_string($connect,$_POST['login_type']);
			
           	$password = mysqli_real_escape_string($connect, $password);

			$query = "UPDATE dim_login set name = '$employee_name',
			username = '$username',
			password = '$password',
			login_type = '$login_type'
			where id = '$id'";

			if(mysqli_query($connect, $query)){
			header( "Location: user-account.php" ); die;
			echo "<script>window.open('user-account.php','_self')</script>";
			}
			if(mysqli_connect_errno($connect))
			{
				echo 'Failed to connect';
			}
		
			
?>

