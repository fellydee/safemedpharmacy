<!DOCTYPE html>
<html lang="en">

<?php
    include('connect.php');
    session_start();

    if(!$_SESSION['username']) {
        header("Location: login.php");
    }
    else {
        $username = $_SESSION['username'];
        $name = $_SESSION['name'];
        $login_type = $_SESSION['login_type'];

        if($login_type != "Super Admin") {
          header("Location: index.php");
        }
    }
?>

<head>

  <?php include('meta.php'); ?>

  <title>SafeMed Pharmacy - Add User Account</title>

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
            <h1 class="h3 mb-0 text-gray-800">Add New User Account</h1>
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Border Left Utilities -->
              <div class="col-lg-6">
                <div class="card shadow mb-4">
                  <div class="card-body">
                    <div class="box-body">
                      <form class="form" action="add-user-account-process.php" method="post">
                        <div class="form-group">
                          <label>Employee Name</label>
                          <input type="text" class="form-control" name="employee_name" value="">
                        </div>
                        <div class="form-group">
                          <label>Password</label>
                          <input type="password" class="form-control" name="password" value="">
                        </div>                    
                      </div>
                      <!-- /.box-body -->
                  </div>
                </div>
              </div>

              <div class="col-lg-6">
                <div class="card shadow mb-4">
                  <div class="card-body">
                    <div class="box-body">
                      <form class="form" action="add-category-process.php" method="post">
                        <div class="form-group">
                          <label>Username</label>
                          <input type="text" class="form-control" name="username" value="">
                        </div>
                        <div class="form-group">
                          <label>User Type</label>
                          <!-- <input type="text" class="form-control" name="category" value=""> -->
                          <select class="form-control" name="login_type">
                            <option value="Owner">Super Admin</option>
                            <option value="Owner">Owner</option>
                            <option value="Admin">Admin</option>
                            <option value="Pharmacist Assistant">Pharmacist Assistant</option>
                          </select>
                        </div>
                    </div>
                      <!-- /.box-body -->
                  </div>
                </div>

                  <div class="submit-footer">
                    <input type="submit" class="btn btn-primary" value="Submit" name="submit" />
                    <a href="user-account.php" class="btn btn-primary">Cancel</a>
                  </div>

              </div>

            </form>
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
