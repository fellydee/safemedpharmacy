<?php
$connect=mysqli_connect('localhost','root','','safemedpharmacy');

			$query = "TRUNCATE table dim_loghistory";


			if(mysqli_query($connect, $query)){
			header( "Location: log-management.php" ); die;
			echo "<script>window.open('log-management.php','_self')</script>";
			}
			if(mysqli_connect_errno($connect))
			{
				echo 'Failed to connect';
			}
		
			
?>

