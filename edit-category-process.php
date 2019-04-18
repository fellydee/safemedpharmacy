<?php
$connect=mysqli_connect('localhost','root','','safemedpharmacy');

			$category_name = mysqli_real_escape_string($connect,$_POST['category_name']);
			$category_id = mysqli_real_escape_string($connect,$_POST['category_id']);
			
			$query = "UPDATE dim_category set 
			category_name = '$category_name'
			WHERE category_id = '$category_id'";

			if(mysqli_query($connect, $query)){
			header( "Location: categories.php" ); die;
			echo "<script>window.open('categories.php','_self')</script>";
			}
			if(mysqli_connect_errno($connect))
			{
				echo 'Failed to connect';
			}
		
			
?>

