<?php include('stock-card-process.php'); ?>

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
            <h1 class="h3 mb-0 text-gray-800">Stock Card for <?php echo $medicine_name; ?></h1>
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
            <?php foreach ($data as $row): ?>
              <?php $balance += $row['order_qty']; ?>
              <tr>
                <!-- first row should be beginning balance entry   -->
                <td><?php echo $row['date_added']; ?></td>
                <td><?php echo $row['status'] === 'Filed' ? 'Purchase' : ''; ?></td>
                <td><?php echo $row['ref_num']; ?></td>
                <td><?php echo $row['order_qty'];?></em></td>
                <td><?php echo $row['status'] === 'Filed' ? '' : 'sales qty here'; ?></td>
                <td></td> <!-- expired count goes here -->
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
