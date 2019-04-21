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

    $result = $_SESSION['result'];

    // Clear session variable
    if (isset($_SESSION['sku'])) {
      unset($_SESSION['sku']);
    }

    if (isset($_SESSION['productFound'])) {
      unset($_SESSION['productFound']);
    }
?>

<head>

  <?php include('meta.php'); ?>

  <title>SafeMed Pharmacy - Add Purchase Order</title>

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
            <h1 class="h3 mb-0 text-gray-800">Add New Purchase Order</h1>
          </div>

          <form class="form" action="add-purchase-order-process.php" method="post">
            <div class="row">
              <div class="col-lg-6">
            <div class="card shadow mb-4">
              <div class="card-body">
                <div class="box-body">
                  <div class="form-group">
                    <label>SKU</label>
                    <input type="text" class="form-control" name="sku" value="<?php echo $result['SKU'] ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label>Brand Name</label>
                    <input type="text" class="form-control" name="brand_name" value="<?php echo $result['Brand Name'] ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label>Supplier</label>
                    <input type="text" class="form-control" name="supplier" value="<?php echo $result['Supplier'] ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label>Unit of Measurement</label>
                    <input type="text" class="form-control" name="uom" value="<?php echo $result['Uom'] ?>" readonly>
                  </div>                        
                  <div class="form-group">
                    <label>Defective Quantity</label>
                    <input type="text" class="form-control" name="defective_qty" value="0">
                  </div>  
                  <div class="form-group">
                    <label>Unit Price</label>
                    <input type="text" class="form-control" name="unit_price" value="<?php echo $result['Unit Price'] ?>" readonly>
                  </div>
                </div>
                <!-- /.box-body -->
              </div>
            </div>
          </div>

          <!-- Border Bottom Utilities -->
          <div class="col-lg-6">
            <div class="card shadow mb-4">
              <div class="card-body">
                <div class="box-body">
                  <div class="form-group">
                    <label>Generic Name</label>
                    <input type="text" class="form-control" name="generic_name" value="<?php echo $result['Generic Name'] ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label>Category</label>
                    <input type="text" class="form-control" name="category" value="<?php echo $result['Category'] ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label>Order Quantity</label>
                    <input type="text" class="form-control" name="order_qty" value="">
                  </div>
                  <div class="form-group">
                    <label>Expiration Date</label>
                    <input type="text" class="form-control" name="expiration_date" value="<?php echo $result['Expiry Date'] ?>" readonly>
                  </div>  
                  <div class="form-group">
                    <label>Selling Price</label>
                    <input type="text" class="form-control" name="selling_price" value="<?php echo $result['Selling Price'] ?>" readonly>
                  </div>     
                </div>
              </div>
            </div>

            <input type= "hidden" name = "name" value ="<?php echo $name ?>"/>
            <div class="submit-footer">
              <input type="submit" class="btn btn-primary" value="Submit" name="submit" />
              <a href="purchase-order.php" class="btn btn-primary">Cancel</a>
            </div>
          </div>

        </div>
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

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <?php include('scripts.php'); ?>

</body>

</html>
