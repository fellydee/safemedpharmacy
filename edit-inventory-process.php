<?php
$connect=mysqli_connect('localhost','root','','safemedpharmacy');

			$item_id = mysqli_real_escape_string($connect,$_POST['item_id']);
			$name = mysqli_real_escape_string($connect,$_POST['name']);
			$brand_name = mysqli_real_escape_string($connect,$_POST['brand_name']);
           	$supplier = mysqli_real_escape_string($connect,$_POST['supplier']);
			$defective_qty = mysqli_real_escape_string($connect,$_POST['defective_qty']);
            $generic_name = mysqli_real_escape_string($connect,$_POST['generic_name']);
           	$uom = mysqli_real_escape_string($connect,$_POST['uom']);
			$category = mysqli_real_escape_string($connect,$_POST['category']);
            $order_qty = mysqli_real_escape_string($connect,$_POST['order_qty']);
            $expiration_date = mysqli_real_escape_string($connect,$_POST['expiration_date']);
			
			$query = "UPDATE dim_inventory set 
			brand_name = '$brand_name', 
			generic_name = '$generic_name', 
			uom = '$uom', 
			supplier = '$supplier', 
			defective_qty = '$defective_qty', 
			order_qty = '$order_qty', 
			category = '$category', 
			added_by = '$name',
			expiration_date = '$expiration_date' 
			WHERE item_id = '$item_id'";

			if(mysqli_query($connect, $query)){
			header( "Location: inventory.php" ); die;
			echo "<script>window.open('inventory.php','_self')</script>";
			}
			if(mysqli_connect_errno($connect))
			{
				echo 'Failed to connect';
			}
		
			
?>

