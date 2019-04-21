<!DOCTYPE html>
<html lang="en">

<?php
    $connect = mysqli_connect('localhost', 'root', '', 'safemedpharmacy');
    session_start();

    if(!$_SESSION['username']) {
        header("Location: login.php");
    }
    else {
        $username = $_SESSION['username'];
        $name = $_SESSION['name'];
        $login_type = $_SESSION['login_type'];
    }
?>

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
            <h1 class="h3 mb-0 text-gray-800">View Stock Card by SKU</h1>
          </div>

        <?php if (isset($_SESSION['productFound']) && $_SESSION['productFound'] === false): ?>
          <div class="alert alert-danger col-lg-5" role="alert">
            Product with SKU: <?php echo $_SESSION['sku']; ?> not found - please try again.
          </div>
        <?php endif; ?>

        <form class="form-inline" action="view-stock-card.php" method="post">
          <div class="form-group mx-sm-3 mb-2">
            <label for="productSKU" class="sr-only">Product SKU</label>
            <input type="number" class="form-control" id="productSKU" placeholder="Input product SKU..." name="sku">
          </div>
          <button type="submit" class="btn btn-primary mb-2">Search</button>
        </form>

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

  <?php if ( isset($_SESSION['productFound']) ): ?>
      <?php unset($_SESSION['productFound']); ?> 
  <?php endif; ?>

</body>

</html>
