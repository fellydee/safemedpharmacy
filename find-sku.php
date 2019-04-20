<?php
	session_start();

	// Read CSV files
	$files = glob("dir/*.csv");
	$sku = $_POST['sku'];
	$productFound = false;

	foreach($files as $file) {
		if (($handle = fopen($file, "r")) !== FALSE) {
			while (($data = fgetcsv($handle, 4096, "\n")) !== FALSE) {
				$num = count($data);

				for ($c=0; $c < $num; $c++) {
					$row_content = ( explode(',', $data[$c]) );

					if ($sku === $row_content[0]) {
						$session_array = array(
							"SKU" => $row_content[0],
							"Supplier" => $row_content[1],
							"Brand Name" => $row_content[2],
							"Generic Name" => $row_content[3],
							"Uom" => $row_content[4],
							"Category" => $row_content[5],
							"Expiry Date" => $row_content[6],
							"Total Price" => $row_content[7],
							"Unit Price" => $row_content[8],
							"Selling Price" => $row_content[9]
						);
						$_SESSION['result'] = $session_array;
						$productFound = true;
					}
				}
			}
			fclose($handle);
		} else {
			echo "Could not open file: " . $file;
		}
	}

	$_SESSION['productFound'] = $productFound;

	header('Location: add-purchase-order.php');
	die();

?>