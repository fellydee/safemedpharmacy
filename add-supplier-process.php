<?php
$connect=mysqli_connect('localhost','root','','safemedpharmacy');

			$supplier_name = mysqli_real_escape_string($connect,$_POST['supplier_name']);
			$company = mysqli_real_escape_string($connect,$_POST['company']);
			$location = mysqli_real_escape_string($connect,$_POST['location']);
			$contact_details = mysqli_real_escape_string($connect,$_POST['contact_details']);


			$query = "INSERT INTO dim_supplier(supplier_name, company, location, contact_details) 
			VALUES ('$supplier_name', '$company', '$location', '$contact_details')";


			if(mysqli_query($connect, $query)){
			header( "Location: suppliers.php" ); die;
			echo "<script>window.open('suppliers.php','_self')</script>";
			}
			if(mysqli_connect_errno($connect))
			{
				echo 'Failed to connect';
			}
		
			
?>

