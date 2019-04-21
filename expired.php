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

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SafeMed Pharmacy - Expired</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

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
            <h1 class="h3 mb-0 text-gray-800">Expired</h1>
            <div class="action-buttons"> </div>
          </div>

          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">List of Expired Items</h6>
            </div>
            <div class="card-body">

                <div class="mb-2">
                  <div class="card bg-primary text-white shadow">
                    <div class="card-body">
                      <span style="font-size: 0.80rem;">All expired products in the inventory are displayed in this section.</span>
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
                      $query = "SELECT * FROM `dim_inventory` WHERE `expiration_date` < CURDATE() AND (`order_qty` - `defective_qty`) >= 1";

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
                  customize: function ( doc ) {
                    doc.content.splice( 1, 0, {
                        margin: [ 0, 0, 0, 12 ],
                        alignment: 'center',
                        image: 'data:image/png;base64,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'
                       
                    } );
                },
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
