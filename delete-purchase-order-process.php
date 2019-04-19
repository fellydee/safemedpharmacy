<?php
$connect=mysqli_connect('localhost','root','','safemedpharmacy');

           	$sku = $_POST['sku'];

			$query = "DELETE FROM dim_inventory 
			WHERE sku = '$sku'";

			if(mysqli_query($connect, $query)){
			header( "Location: purchase-order.php" ); die;
			echo "<script>window.open('purchase-order.php','_self')</script>";
			}
			if(mysqli_connect_errno($connect))
			{
				echo 'Failed to connect';
			}
			
?>

