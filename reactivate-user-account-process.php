<?php
$connect=mysqli_connect('localhost','root','','safemedpharmacy');

			$id = $_POST['id'];
			
			$query = "UPDATE dim_login set status = 'Active'
			where id = '$id'";

			if(mysqli_query($connect, $query)){
			header( "Location: archive.php" ); die;
			echo "<script>window.open('archive.php','_self')</script>";
			}
			if(mysqli_connect_errno($connect))
			{
				echo 'Failed to connect';
			}
		
			
?>

