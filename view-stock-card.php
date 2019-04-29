<?php include('stock-card-process.php'); ?>
<?php include('fetch-sales-invoice-process.php'); ?>
<?php $tableData = array(); ?>
<?php $dataToInsert = array(); ?>

<!DOCTYPE html>
<html lang="en">

<head>

	<?php include('meta.php'); ?>

	<title>SafeMed Pharmacy - View Stock Card by SKU</title>

	<?php include('assets.php'); ?>

	<!-- Custom styles for this page -->
	<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

	<link href="css/style.css" rel="stylesheet">

	<?php include('head-actions.php'); ?>
</head>

<body id="page-top">

	<!-- Page Wrapper -->
	<div id="wrapper">

		<!-- Sidebar -->
		<?php include('sidebar.php'); ?>
		<!-- End of Sidebar -->

		<!-- Content Wrapper -->
		<div id="content-wrapper" class="d-flex flex-column">

			<!-- Main Content -->
			<div id="content">

				<!-- Topbar -->
				<?php include('top-bar.php'); ?>
				<!-- End of Topbar -->

				<!-- Begin Page Content -->
				<div class="container-fluid">

					<!-- Page Heading -->
					<div class="d-sm-flex align-items-center justify-content-between mb-4">
						<h1 class="h4 mb-0 text-gray-800">Stock Card for <?php echo $medicine_name; ?></h1>
					</div>

					<?php if (isset($_SESSION['productFound']) && $_SESSION['productFound'] === false): ?>
						<div class="alert alert-danger col-lg-5" role="alert">
							Product with SKU: <?php echo $_SESSION['sku']; ?> not found - please try again.
						</div>
					<?php endif; ?>

					<table class="table">
						<thead>
							<tr>
								<th scope="col">Date</th>
								<th scope="col">Particulars</th>
								<th scope="col">Reference Number</th>
								<th scope="col">IN</th>
								<th scope="col">OUT</th>
								<th scope="col">Expired</th>
								<th scope="col">Balance</th>
							</tr>
							<?php foreach ($data as $row):
								$dataToInsert = array(
									$row['date_added'],
									'Purchase',
									$row['ref_num'],
									$row['order_qty'],
									'',
									'',
								);

								array_push($tableData, $dataToInsert);
								?>
							<?php endforeach; ?>

							<?php foreach ($salesData as $row):
								$dataToInsert = array(
									$row['date_added'],
									'Sold',
									$row['item_id'] + 1000,
									'',
									$row['quantity'],
									'',
									'',
								);

								array_push($tableData, $dataToInsert);?>
							<?php endforeach; ?>

							<?php
							function date_compare($element1, $element2) { 
								$datetime1 = strtotime($element1[0]); 
								$datetime2 = strtotime($element2[0]); 
								return $datetime1 - $datetime2; 
							}  

							usort($tableData, 'date_compare'); 
							?>

							<?php $balance = 0; ?>
							<?php foreach ($tableData as $row): ?>
								<?php
								if ($row[3] != '' && $row[4] == '') {
									$balance += $row[3];
								} else {
									$balance -= $row[4];
								}
								?>
								<tr>
									<td><?php echo $row[0]; ?></td>
									<td><?php echo $row[1]; ?></td>
									<td><?php echo $row[2]; ?></td>
									<td><?php echo $row[3]; ?></td>
									<td><?php echo $row[4]; ?></td>
									<td><?php echo $row[5]; ?></td>
									<td><?php echo $balance; ?></td>
								</tr>
							<?php endforeach; ?>
						</thead>
					</table>

				</div>
				<!-- End of Main Content -->

			</div>
			<!-- End of Content Wrapper -->

			<!-- Footer -->
			<footer class="sticky-footer bg-white">
				<div class="container my-auto">
					<div class="copyright text-center my-auto">
						<span>Copyright &copy; SafeMed Pharmacy 2019</span>
					</div>
				</div>
			</footer>
			<!-- End of Footer -->

		</div>
		<!-- End of Page Wrapper -->

		<!-- Scroll to Top Button-->
		<a class="scroll-to-top rounded" href="#page-top">
			<i class="fas fa-angle-up"></i>
		</a>

		<?php include('logout-modal.php'); ?>

		<?php include('scripts.php'); ?>

	</body>

	</html>
