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

        if($login_type != "Super Admin" and $login_type != "Admin") {
          header("Location: index.php");
        }
    }
?>

<head>

  <?php include('meta.php'); ?>

  <title>SafeMed Pharmacy - Edit Inventory Record</title>

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
            <h1 class="h3 mb-0 text-gray-800">Add New Inventory Item</h1>
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Border Left Utilities -->
              <div class="col-lg-6">
                <div class="card shadow mb-4">
                  <div class="card-body">
                    <div class="box-body">
                      <form class="form" action="edit-inventory-process.php" method="post">
                        <?php 
                        $item_id = $_POST['item_id'];
                                                    
                        $query = "SELECT * from dim_inventory where item_id = '$item_id'";
                        $result_set =  mysqli_query($connect, $query);

                        while($row = mysqli_fetch_array($result_set)) {
                        ?>
                        <div class="form-group">
                          <label>Brand Name</label>
                          <input type="text" class="form-control" name="brand_name" value="<?php echo $row['brand_name']; ?>">
                        </div>
                        <div class="form-group">
                          <label>Supplier</label>
                          <!-- <input type="text" class="form-control" name="supplier" value=""> -->
                          <select class="form-control" name="supplier">
                            <option value="<?php echo $row['supplier']; ?>"><?php echo $row['supplier']; ?></option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label>Unit of Measurement</label>
                          <input type="text" class="form-control" name="uom" value="<?php echo $row['uom']; ?>">
                        </div>                        
                        <div class="form-group">
                          <label>Available Quantity</label>
                          <input type="text" class="form-control" name="order_qty" value="<?php echo $row['order_qty']; ?>">
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
                          <input type="text" class="form-control" name="generic_name" value="<?php echo $row['generic_name']; ?>">
                        </div>
                        <div class="form-group">
                          <label>Category</label>
                          <!-- <input type="text" class="form-control" name="category" value=""> -->
                          <select class="form-control" name="category">
                            <option value="<?php echo $row['category']; ?>"><?php echo $row['category']; ?></option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label>Defective Quantity</label>
                          <input type="text" class="form-control" name="defective_qty" value="<?php echo $row['defective_qty']; ?>">
                        </div>        
                        <div class="form-group">
                          <label>Expiration Date</label>
                          <input type="date" class="form-control" name="expiration_date" value="<?php echo $row['expiration_date']; ?>">
                        </div>               
                      </div>
                  </div>
                </div>

                  <input type= "hidden" name = "name" value ="<?php echo $name ?>"/>
                  <input type= "hidden" name = "item_id" value ="<?php echo $row['item_id']; ?>"/>
                  <div class="submit-footer">
                    <input type="submit" class="btn btn-primary" value="Submit" name="submit" />
                    <a href="inventory.php" class="btn btn-primary">Cancel</a>
                  </div>
                 <?php } ?></form>
              </div>

          </div>

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

<script>
$(document).ready(function() {
    $('#dataTable').DataTable( {
        "order": [[ 3, "desc" ]]
    } );
} );
</script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
