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

  <title>SafeMed Pharmacy - Edit Supplier Record</title>

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
                      <form class="form" action="edit-supplier-process.php" method="post">
                        <?php 
                        $supplier_id = $_POST['supplier_id'];
                                                    
                        $query = "SELECT * from dim_supplier where supplier_id = '$supplier_id'";
                        $result_set =  mysqli_query($connect, $query);

                        while($row = mysqli_fetch_array($result_set)) {
                        ?>
                        <div class="form-group">
                          <label>Supplier Name</label>
                          <input type="text" class="form-control" name="supplier_name" value="<?php echo $row['supplier_name']; ?>">
                        </div>
                        <div class="form-group">
                          <label>Location</label>
                          <input type="text" class="form-control" name="location" value="<?php echo $row['location']; ?>">
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
                          <label>Company</label>
                          <input type="text" class="form-control" name="company" value="<?php echo $row['company']; ?>">
                        </div>
                        <div class="form-group">
                          <label>Contact Details</label>
                          <input type="text" class="form-control" name="contact_details" value="<?php echo $row['contact_details']; ?>">
                        </div>
                      </div>
                  </div>
                </div>

                  <input type= "hidden" name = "supplier_id" value ="<?php echo $row['supplier_id']; ?>"/>
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

  <?php include('logout-modal.php'); ?>

  <?php include('scripts.php'); ?>

</body>

</html>
