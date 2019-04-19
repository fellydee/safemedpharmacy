<?php
$connect=mysqli_connect('localhost','root','','safemedpharmacy');
// print_r($_POST);
// die();
 
 // $sku = $_SESSION['result']['sku'];
 $sku = $_POST['sku'];

			$name = mysqli_real_escape_string($connect,$_POST['name']);
			$sku = mysqli_real_escape_string($connect,$_POST['sku']);
			$brand_name = mysqli_real_escape_string($connect,$_POST['brand_name']);
           	$supplier = mysqli_real_escape_string($connect,$_POST['supplier']);
			$defective_qty = mysqli_real_escape_string($connect,$_POST['defective_qty']);
            $generic_name = mysqli_real_escape_string($connect,$_POST['generic_name']);
           	$uom = mysqli_real_escape_string($connect,$_POST['uom']);
			$category = mysqli_real_escape_string($connect,$_POST['category']);
            $order_qty = mysqli_real_escape_string($connect,$_POST['order_qty']); 
			


			date_default_timezone_set('Asia/Manila');
			$date_today = date('Y-m-j');


			$query = "INSERT INTO dim_inventory(sku, brand_name, generic_name, uom, supplier, defective_qty, order_qty, category, added_by, date_added, status) 
			VALUES ('$sku', '$brand_name', '$generic_name', '$uom', '$supplier', '$defective_qty', '$order_qty', '$category', '$name', '$date_today', 'Filed')";


			if(mysqli_query($connect, $query)){
			header( "Location: purchase-order.php" ); die;
			echo "<script>window.open('purchase-order.php','_self')</script>";
			}
			if(mysqli_connect_errno($connect))
			{
				echo 'Failed to connect';
			} 
		
			
?>