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

  <title>SafeMed Pharmacy - Near Expiry</title>

  <?php include('assets.php'); ?>

  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

  <link href="css/style-3.css" rel="stylesheet">

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
            <h1 class="h3 mb-0 text-gray-800">Near Expiry</h1>
            <div class="action-buttons"> </div>
          </div>

          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">List of Near Expiry</h6>
            </div>
            <div class="card-body">

                <div class="mb-2">
                  <div class="card bg-primary text-white shadow">
                    <div class="card-body">
                      <span style="font-size: 0.80rem;">All products in the inventory that are near the expiration date of 6 months will be displayed in this section.</span>
                    </div>
                  </div>
                </div>

              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th width="20%">Brand Name</th>
                      <th width="20%">Generic Name</th>
                      <th width="20%">Stock On Hand</th>
                      <th width="20%">Purchased On</th>
                      <th width="20%">Expiry Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <?php    
                      $query = "SELECT * FROM `dim_inventory` WHERE `expiration_date` BETWEEN CURDATE() and DATE_ADD(CURDATE(), INTERVAL 180 DAY) AND (`order_qty` - `defective_qty`) >= 1";

                      $result_set =  mysqli_query($connect, $query);
                      if(mysqli_num_rows($result_set) == 0) echo "<table><tbody><tr><p class='no-record'><center>No record can be found.</center></p></tr></tbody></table>
                                <style>tbody { display: none; } table.table-bordered.dataTable th:first-child { border-left-width: 1px; } table.table-bordered.dataTable th:last-child { border-right-width: 1px; } </style>";

                      while($row = mysqli_fetch_array($result_set)) {
                        $no_of_defective_qty = $row['defective_qty'];
                        $no_of_order_qty = $row['order_qty'];
                        $stock_on_hand = $no_of_order_qty - $no_of_defective_qty;
                      ?>
                      <td><?php echo $row['brand_name']; ?></td>
                      <td><?php echo $row['generic_name']; ?></td>
                      <td><?php echo $stock_on_hand; ?></td>
                      <td><?php echo $row['date_added']; ?></td>  
                      <td><?php echo $row['expiration_date']; ?></td>                     
                    </tr><?php } ?>
                  </tbody>
                </table>
              </div>
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

  <script type="text/javascript" src="vendor/datatables/dataTables.buttons.min.js"></script> 
  <script type="text/javascript" src="vendor/datatables/jszip.min.js"></script>
  <script type="text/javascript" src="vendor/datatables/buttons.html5.min.js"></script>
  <script type="text/javascript" src="vendor/datatables/pdfmake.min.js"></script>
  <script type="text/javascript" src="vendor/datatables/vfs_fonts.js"></script>

  <script>
  $(document).ready(function() {
      $('#dataTable').DataTable( {
          "order": [[ 3, "asc" ]],
          "bLengthChange": false,
                    dom: 'Bfrtip',
          buttons: [
              {
                  extend: 'excelHtml5',
                  exportOptions: {
                      columns: [ 0, 1, 2, 3, 4 ]
                  }
              },
              {
                  extend: 'pdfHtml5',
                  exportOptions: {
                      columns: [ 0, 1, 2, 3, 4 ]
                  }
              }
          ]
      } );
      $('div.dataTables_filter').appendTo('.card-header');
      $('div.dt-buttons').appendTo('.action-buttons');
  } );
  </script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
