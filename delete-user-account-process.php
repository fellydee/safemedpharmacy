<?php
$connect=mysqli_connect('localhost','root','','safemedpharmacy');

           	$id = $_POST['id'];
           	$id = mysqli_real_escape_string($connect,$_POST['id']);
			// $employee_name = mysqli_real_escape_string($connect,$_POST['employee_name']);
			// $username = mysqli_real_escape_string($connect,$_POST['username']);
   //          $password = md5($_POST['password']);
   //         	$login_type = mysqli_real_escape_string($connect,$_POST['login_type']);

			$query = "DELETE FROM dim_login 
			-- username = '$username',
			-- password = '$password',
			-- login_type = '$login_type'
			WHERE id = '$id'";

			if(mysqli_query($connect, $query)){
			header( "Location: archive.php" ); die;
			echo "<script>window.open('archive.php','_self')</script>";
			}
			if(mysqli_connect_errno($connect))
			{
				echo 'Failed to connect';
			}
			
?>

