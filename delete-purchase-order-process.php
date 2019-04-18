<?php
$connect=mysqli_connect('localhost','root','','safemedpharmacy');

           	$item_id = $_POST['item_id'];

			$query = "DELETE FROM dim_inventory 
			WHERE item_id = '$item_id'";

			if(mysqli_query($connect, $query)){
			header( "Location: purchase-order.php" ); die;
			echo "<script>window.open('purchase-order.php','_self')</script>";
			}
			if(mysqli_connect_errno($connect))
			{
				echo 'Failed to connect';
			}
			
?>

