<!DOCTYPE html>
<html lang="en">

<?php
session_start();

$connect = mysqli_connect('localhost', 'root', '', 'safemedpharmacy');
$is_admin = false;
$body_class = '';

if(!$_SESSION['username']) {
	header("Location: login.php");
} else {
	$username = $_SESSION['username'];
	$name = $_SESSION['name'];
	$login_type = $_SESSION['login_type'];

	if ( strcmp($login_type, 'Super Admin') === 0 ) {
		$is_admin = true;
		$body_class = 'super-admin';
	} elseif( strcmp($login_type, 'Owner') === 0 ) {
		$is_admin = true;
		$body_class = 'super-admin';
	} else {
		$body_class = 'not-super-admin';
	}
}
?>

<head>

	<?php include('meta.php'); ?>

	<title>SafeMed Pharmacy - Dashboard</title>

	<?php include('assets.php'); ?>

	<!-- Homepage styles -->
	<link href="css/homepage-style.css" rel="stylesheet">

	<?php include('head-actions.php'); ?>
</head>

<body id="page-top" <?php echo "class=" . $body_class; ?>>

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
				<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

					<!-- Sidebar Toggle (Topbar) -->
					<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
						<i class="fa fa-bars"></i>
					</button>

					<!-- Time -->
					<span class="ml-2 d-none d-lg-inline text-gray-600 small">
						<div id="timestamp"></div>
					</span>


					<!-- Topbar Navbar -->
					<ul class="navbar-nav ml-auto">

						<!-- Nav Item - Search Dropdown (Visible Only XS) -->
						<li class="nav-item dropdown no-arrow d-sm-none">
							<a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="fas fa-search fa-fw"></i>
							</a>
							<!-- Dropdown - Messages -->
							<div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
								<form class="form-inline mr-auto w-100 navbar-search">
									<div class="input-group">
										<input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
										<div class="input-group-append">
											<button class="btn btn-primary" type="button">
												<i class="fas fa-search fa-sm"></i>
											</button>
										</div>
									</div>
								</form>
							</div>
						</li>

						<!-- Nav Item - User Information -->
						<li class="nav-item dropdown no-arrow">
							<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="mr-2 d-none d-lg-inline text-gray-600 small">Welcome back <b><?php echo $username;?></b> (<?php echo $name;?>)</span>
								<img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
							</a>
							<!-- Dropdown - User Information -->
							<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
								<a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
									<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
									Logout
								</a>
							</div>
						</li>

					</ul>

				</nav>
				<!-- End of Topbar -->

				<!-- Begin Page Content -->
				<div class="container-fluid">

					<!-- Page Heading -->
					<div class="d-sm-flex align-items-center justify-content-between mb-4">
						<h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
					</div>

					<!-- Content Row -->
					<div class="row financial-earnings">

						<!-- Profit (Monthly) Card Example -->
						<div class="col-xl-3 col-md-6 mb-4">
							<div class="card border-left-primary shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Profit (Monthly)</div>
											<div class="h5 mb-0 font-weight-bold text-gray-800">
												<?php 
												$count = mysqli_query($connect, "SELECT SUM(price) from dim_orders where MONTH(date_added) = MONTH(CURRENT_DATE()) AND YEAR(date_added) = YEAR(CURDATE())");
												$row = mysqli_fetch_array($count);

												$total = $row[0];
												echo '₱'.$total;
												?>
											</div>
										</div>
										<div class="col-auto">
											<i class="fas fa-calendar fa-2x text-gray-300"></i>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- Profit (Monthly) Card Example -->
						<div class="col-xl-3 col-md-6 mb-4">
							<div class="card border-left-success shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-success text-uppercase mb-1">Profit (Annual)</div>
											<div class="h5 mb-0 font-weight-bold text-gray-800">
												<?php 
												$count = mysqli_query($connect, "SELECT SUM(price) from dim_orders where YEAR(date_added) = YEAR(CURDATE())
													");
												$row = mysqli_fetch_array($count);

												$total = $row[0];
												echo '₱'.$total;
												?>
											</div>
										</div>
										<div class="col-auto">
											<i class="far fa-money-bill-alt fa-2x text-gray-300"></i>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- Profit (Monthly) Card Example -->
						<div class="col-xl-3 col-md-6 mb-4">
							<div class="card border-left-info shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Inventory Stocks</div>
											<div class="row no-gutters align-items-center">
												<div class="col-auto">
													<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
														<?php 
														$count = mysqli_query($connect, "SELECT SUM(order_qty-defective_qty) FROM dim_inventory");
														$row = mysqli_fetch_array($count);

														$total = $row[0];
														echo $total;
														?>
													</div>
												</div>
											</div>
										</div>
										<div class="col-auto">
											<i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- Pending Requests Card Example -->
						<div class="col-xl-3 col-md-6 mb-4">
							<div class="card border-left-warning shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Number of User Accounts</div>
											<div class="h5 mb-0 font-weight-bold text-gray-800">
												<?php 
												$count = mysqli_query($connect, "SELECT count(1) FROM dim_login WHERE status = 'Active'");
												$row = mysqli_fetch_array($count);

												$total = $row[0];
												echo $total;
												?>
											</div>
										</div>
										<div class="col-auto">
											<i class="fas fa-user fa-2x text-gray-300"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- Content Row -->

					<div class="row">

						<!-- Area Chart -->
						<div class="col-xl-6 col-lg-5">
							<div class="card shadow mb-4 h-100">
								<!-- Card Header - Dropdown -->
								<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
									<h6 class="m-0 font-weight-bold text-primary">Latest Inventory Items</h6>
								</div>
								<!-- Card Body -->
								<div class="card-body">

									<div class="table-responsive">
										<table class="table" id="dataTable" width="100%" cellspacing="0" style="text-align: center;">
											<thead>
												<tr>
													<th width="33.33%">Brand Name</th>
													<th width="33.33%">Generic Name</th>
													<th width="33.33%">Number of Stock</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<?php    
													$query = "SELECT * FROM dim_inventory WHERE status = 'Received' ORDER BY item_id DESC LIMIT 5";

													$result_set =  mysqli_query($connect, $query);
													if(mysqli_num_rows($result_set) == 0) echo "<table class='t1'><tbody><tr><p class='no-record'><center>No record can be found.</center></p></tr></tbody></table>
													<style>.t1 tbody { display: none; } table.table-bordered.dataTable th:first-child { border-left-width: 1px; } table.table-bordered.dataTable th:last-child { border-right-width: 1px; } </style>";

													while($row = mysqli_fetch_array($result_set)) {
														$no_of_defective_qty = $row['defective_qty'];
														$no_of_order_qty = $row['order_qty'];
														$stock_on_hand = $no_of_order_qty - $no_of_defective_qty;
														?>
														<td><?php echo $row['brand_name']; ?></td>
														<td><?php echo $row['generic_name']; ?></td>
														<td><?php echo $stock_on_hand; ?></td>
														</tr><?php } ?>
													</tbody>
												</table>
											</div>

										</div>
									</div>
								</div>

								<!--  -->
								<div class="col-xl-6 col-lg-5">
									<div class="card shadow mb-4 h-100">
										<!-- Card Header - Dropdown -->
										<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
											<h6 class="m-0 font-weight-bold text-primary">Latest Purchase Orders</h6>
										</div>
										<!-- Card Body -->
										<div class="card-body">

											<div class="table-responsive">
												<table class="table" id="dataTable" width="100%" cellspacing="0" style="text-align: center;">
													<thead>
														<tr>
															<th width="33.33%">Brand Name</th>
															<th width="33.33%">Generic Name</th>
															<th width="33.33%">Number of Stock</th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<?php    
															$query = "SELECT * FROM dim_inventory WHERE status = 'Filed' ORDER BY item_id DESC LIMIT 5";

															$result_set =  mysqli_query($connect, $query);
															if(mysqli_num_rows($result_set) == 0) echo "<table class='t2'><tbody><tr><p class='no-record'><center>No record can be found.</center></p></tr></tbody></table>
															<style>.t2 tbody { display: none; } table.table-bordered.dataTable th:first-child { border-left-width: 1px; } table.table-bordered.dataTable th:last-child { border-right-width: 1px; } </style>";

															while($row = mysqli_fetch_array($result_set)) {
																$no_of_defective_qty = $row['defective_qty'];
																$no_of_order_qty = $row['order_qty'];
																$stock_on_hand = $no_of_order_qty - $no_of_defective_qty;
																?>
																<td><?php echo $row['brand_name']; ?></td>
																<td><?php echo $row['generic_name']; ?></td>
																<td><?php echo $stock_on_hand; ?></td>
																</tr><?php } ?>
															</tbody>
														</table>
													</div>

												</div>
											</div>
										</div>
									</div>


								</div>
								<!-- /.container-fluid -->

							</div>
							<!-- End of Main Content -->

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
						<!-- End of Content Wrapper -->

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

					<!-- Custom scripts for all pages-->
					<script src="js/sb-admin-2.min.js"></script>

				</body>

				</html>
