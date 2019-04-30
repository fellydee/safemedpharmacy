<!DOCTYPE html>
<html lang="en">

<?php
$connect = mysqli_connect('localhost', 'root', '', 'safemedpharmacy');
session_start();

if(!$_SESSION['username']) {
	header("Location: login.php");
} else {
	$username = $_SESSION['username'];
	$name = $_SESSION['name'];
	$login_type = $_SESSION['login_type'];
}
?>

<head>

	<?php include('meta.php'); ?>

	<title>SafeMed Pharmacy - Point of Sale</title>

	<?php include('assets.php'); ?>

	<!-- Custom styles for this page -->
	<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

	<style>
		.sidebar {
			width: 16rem !important;
		}
		.bg-gradient-primary {
			background-color: #222d32;
			background-image: none !important;
		}
		.sidebar .nav-item .nav-link {
			width: 16em;
		}
		.sidebar .sidebar-brand {
			height: 9rem;
		}
		#dataTable tr td {
			vertical-align: middle;
		}
		.quantity-column {
			display: inline-block;
		}
		#dataTable_wrapper, .table-responsive {
			font-size: .80rem;
		}
		.dt-buttons {
			float: right;
			margin-left: 4px;
		}
		.dt-buttons button {
			display:inline-block;
			font-weight:400;
			font-size: .875rem;
			background-color: #4e73df;
			border-color: #4e73df;
			color:#fff;
			text-align:center;
			vertical-align:middle;
			-webkit-user-select:none;
			-moz-user-select:none;
			-ms-user-select:none;
			user-select:none;
			padding:.25rem .5rem;
			line-height:1.5;
			border-radius:.2rem;
			-webkit-transition:color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,-webkit-box-shadow .15s ease-in-out;
			transition:color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,-webkit-box-shadow .15s ease-in-out;
			transition:color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
			transition:color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out,-webkit-box-shadow .15s ease-in-out
		}
		.dataTables_info {
			display: inline-block;
		}
		.dataTables_paginate {
			float: right;
		}
		.control_button {
			display: inline-block;
		}
		#dataTable_filter {
			position: absolute;
			right: 20px;
			top: 10px;
		}
		#dataTable_filter input {
			display: inline-block;
			width: auto;
			margin-left: 0.5em;
		}
		#dataTable_filter label {
			font-size: .85rem;
		}
		.dataTables_filter {
			display: none;
		}
		.header-t .dataTables_filter {
			display: initial !important;
		}


		/* Quantity indicator */
		.sonar-wrapper {
			position: relative;
			z-index: 0;
			overflow: hidden;
			padding: 0.5rem 0.7rem;
			display: inline-block;
			margin: 0px 0px -8px 15px;
		}
		.sonar-emitter-goodqty {
			position: relative;
			margin: 0 auto;
			width: 10px;
			height: 10px;
			border-radius: 9999px;
			background-color: #0e9e0e;
		}
		.sonar-emitter-badqty {
			position: relative;
			margin: 0 auto;
			width: 10px;
			height: 10px;
			border-radius: 9999px;
			background-color: HSL(45,100%,50%);
		}
		.sonar-wave-goodqty {
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			border-radius: 9999px;
			background-color: #0e9e0e;
			opacity: 0;
			z-index: -1;
			pointer-events: none;
		} 
		.sonar-wave-badqty {
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			border-radius: 9999px;
			background-color: HSL(45,100%,50%);
			opacity: 0;
			z-index: -1;
			pointer-events: none;
		}
		.sonar-wave-goodqty {
			animation: sonarWave 2s linear infinite;
		}
		.sonar-wave-badqty {
			animation: sonarWave 2s linear infinite;
		}

		@keyframes sonarWave {
			from {
				opacity: 0.4;
			}
			to {
				transform: scale(3);
				opacity: 0;
			}
		}
	</style>

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
						<h1 class="h3 mb-0 text-gray-800">Point of Sale</h1>
					</div>

					<div class="card shadow mb-4">
						<div class="card-header header-t py-3">
							<h6 class="m-0 font-weight-bold text-primary">List of Inventory Items</h6>
						</div>
						<div class="card-body">

							<div class="mb-2">
								<div class="card bg-primary text-white shadow">
									<div class="card-body">
										<span style="font-size: 0.80rem;">A list of all pharmacy items are displayed in this section.</span>
									</div>
								</div>
							</div>

							<?php if ( isset($_SESSION['stock_count'] ) ):  ?>
								<div class="alert alert-warning col-lg-12" role="alert">
									Your buy order for <?php echo $_SESSION['item_name']; ?> is successful. Remaining stock on inventory: <?php echo $_SESSION['stock_count']; ?>
								</div>

								<?php unset( $_SESSION['stock_count'] ); ?>
							<?php endif; ?>

							<div class="table-responsive">
								<table class="table table-bordered t1" id="dataTable" width="100%" cellspacing="0">
									<thead>
										<tr>
											<th>Item ID</th>
											<th>Reference Number</th>
											<th>Brand Name</th>
											<th>Generic Name</th>
											<th>Price</th>
											<th>Quantity</th>
											<th>Discount</th>
											<th class="controls">Controls</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<?php    
											$query = "SELECT * FROM dim_inventory WHERE stock_count >= 1 AND status ='Received'";

											$result_set =  mysqli_query($connect, $query);

											if(mysqli_num_rows($result_set) == 0) echo "<table><tbody><tr><p class='no-record'><center>No record can be found.</center></p></tr></tbody></table>
											<style>.t1 tbody { display: none; } table.table-bordered.dataTable th:first-child { border-left-width: 1px; } table.table-bordered.dataTable th:last-child { border-right-width: 1px; } </style>";

											while($row = mysqli_fetch_array($result_set)) {
												?>
												<td><?php echo $row['item_id']; ?></td>
												<td><?php echo $row['ref_num']; ?></td>
												<td><?php echo $row['brand_name']; ?></td>
												<td><?php echo $row['generic_name']; ?></td>
												<td>₱<?php echo $row['selling_price']; ?></td>
												<td style="text-align: center;">
													<form class="form control_button" action="add-to-cart-pos-process.php" method="post">
														<input class="form-control" type="number" name="quantity" min="1" max="<?php echo $row['stock_count']; ?>" style="width: 70px; font-size: 0.80rem;">
													</td>
													<td>
														<center><input type="checkbox" name="discount" value="yes"></center>
													</td>
													<td class="controls"><center>
														<button type="submit" id="submit" name="add-to-cart" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-cart-plus fa-sm text-white-50"></i> Buy</button>
														<input type="hidden" name="item_id" value ="<?php echo $row['item_id']; ?>"/>
														<input type="hidden" name="sku" value ="<?php echo $row['sku']; ?>"/>
														<input type="hidden" name="brand_name" value ="<?php echo $row['brand_name']; ?>"/>
														<input type="hidden" name="generic_name" value ="<?php echo $row['generic_name']; ?>"/>
														<input type="hidden" name="selling_price" value ="<?php echo $row['selling_price']; ?>"/>
														<input type="hidden" name="stock_count" value ="<?php echo $row['stock_count']; ?>"/>
													</form>
												</center></td>                      
												</tr><?php } ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>

						</div>
						<!-- End of Main Content -->

						<hr class="pos-operator" />

						<?php if($login_type != "Super Admin") {
							echo "<style> .container-fluid.sales-inv, .pos-operator { display: none; } </style>"; 
						}

						else {
							echo "<style> .container-fluid.sales-inv, .pos-operator { display: inherit !important; } </style>"; 
						}

						?>

						<div class="container-fluid sales-inv">

							<!-- Page Heading -->
							<div class="d-sm-flex align-items-center justify-content-between mb-4">
								<h1 class="h3 mb-0 text-gray-800">Sales Invoice</h1>
								<div class="action-buttons"> </div>
							</div>

							<div class="card shadow mb-4">
								<div class="card-header py-3">
									<h6 class="m-0 font-weight-bold text-primary">List of Sales</h6>
								</div>
								<div class="card-body table1">

									<div class="mb-2">
										<div class="card bg-primary text-white shadow">
											<div class="card-body">
												<span style="font-size: 0.80rem;">All sales transactions are displayed in this section including the discount, vat and total sale.</span>
											</div>
										</div>
									</div>

									<div class="table-responsive">
										<table class="table table-bordered t2" id="dataTable1" width="100%" cellspacing="0">
											<thead>
												<tr>
													<th width="10%">Order ID</th>
													<th width="13%">Date</th>
													<th width="13%">Brand Name</th>
													<th width="13%">Generic Name</th>
													<th width="13%">Cash</th>
													<th width="13%">VAT</th>
													<th width="13%">Discount</th>    
													<td width="13%">Sales</td>    
												</tr>
											</thead>
											<tbody>
												<tr>
													<?php    
													$query1 = "SELECT * FROM dim_orders";

													$result_set1 =  mysqli_query($connect, $query1);

													if(mysqli_num_rows($result_set1) == 0) echo "<table><tbody><tr><p class='no-record'><center>No record can be found.</center></p></tr></tbody></table>
													<style>.t2 tbody { display: none; } table.table-bordered.dataTable th:first-child { border-left-width: 1px; } table.table-bordered.dataTable th:last-child { border-right-width: 1px; } </style>";

													while($row = mysqli_fetch_array($result_set1)) {
														$cash = $row['price'] - $row['discount'];
														?>
														<td><?php echo $row['order_id']; ?></td>
														<td><?php echo $row['date_added']; ?></td>
														<td><?php echo $row['brand_name']; ?></td>
														<td><?php echo $row['generic_name']; ?></td>
														<td>₱<?php echo $cash; ?></td>
														<td>₱<?php echo $row['vat']; ?></td>
														<td>₱<?php echo $row['discount']; ?></td>
														<td>₱<?php echo $row['vat_exempt']; ?></td>                    
														</tr><?php } ?>
													</tbody>
												</table>
											</div>
										</div>
									</div>

								</div>



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

						<!-- Bootstrap core JavaScript-->
						<script src="vendor/jquery/jquery.min.js"></script>
						<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
						<script>
							$(document).ready(function() {
								setInterval(timestamp, 1000);
							});

							function timestamp() {
								$.ajax({
									url: 'timezone.php',
									success: function(data) {
										$('#timestamp').html(data);
									},
								});
							}
						</script>

						<!-- Core plugin JavaScript-->
						<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

						<!-- Page level plugins -->
						<script src="vendor/datatables/jquery.dataTables.min.js"></script>
						<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

						<script type="text/javascript" src="vendor/datatables/dataTables.buttons.min.js"></script> 
						<script type="text/javascript" src="vendor/datatables/jszip.min.js"></script>
						<script type="text/javascript" src="vendor/datatables/buttons.html5.min.js"></script>
						<script type="text/javascript" src="vendor/datatables/pdfmake.min.js"></script>
						<script type="text/javascript" src="vendor/datatables/vfs_fonts.js"></script>

						<script>
							$(document).ready(function() {
								$('#dataTable').DataTable( {
									"order": [[ 0, "asc" ]],
									"bLengthChange": false,
									"columnDefs": [
									{
										"targets": [ 0 ],
										"visible": false,
										"searchable": false
									}
									]
								} );
								$('div.dataTables_filter').appendTo('.header-t');
							} );

							$(document).ready(function() {
								$('#dataTable1').DataTable( {
									"order": [[ 0, "desc" ]],
									"bLengthChange": false,
									dom: 'Bfrtip',
									buttons: [
									{
										extend: 'excelHtml5',
										exportOptions: {
											columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
										}
									},
									{
										extend: 'pdfHtml5',
										exportOptions: {
											columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
										}
									}
									], "columnDefs": [
									{
										"targets": [ 0 ],
										"visible": false,
										"searchable": false
									}
									]
								} );
								$('div.dt-buttons').appendTo('.action-buttons');
							} );
						</script>

						<!-- Custom scripts for all pages-->
						<script src="js/sb-admin-2.min.js"></script>

					</body>

					</html>
