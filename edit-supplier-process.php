<?php
$connect=mysqli_connect('localhost','root','','safemedpharmacy');

			$supplier_id = mysqli_real_escape_string($connect,$_POST['supplier_id']);
			$supplier_name = mysqli_real_escape_string($connect,$_POST['supplier_name']);
			$company = mysqli_real_escape_string($connect,$_POST['company']);
			$location = mysqli_real_escape_string($connect,$_POST['location']);
			$contact_details = mysqli_real_escape_string($connect,$_POST['contact_details']);
			
			$query = "UPDATE dim_supplier set 
			supplier_name = '$supplier_name',
			company = '$company',
			location = '$location',
			contact_details = '$contact_details'
			WHERE supplier_id = '$supplier_id'";

			if(mysqli_query($connect, $query)){
			header( "Location: suppliers.php" ); die;
			echo "<script>window.open('suppliers.php','_self')</script>";
			}
			if(mysqli_connect_errno($connect))
			{
				echo 'Failed to connect';
			}
		
			
?>

