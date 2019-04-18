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

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SafeMed Pharmacy - Edit Supplier Record</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

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
  .submit-footer {
    text-align: right;
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

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-text mx-3"><img src="logo_transparent.png" width='260' /></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Nav Item - Items Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link active" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-list"></i>
          <span>Items</span>
        </a>
        <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="inventory.php">Inventory</a>
            <a class="collapse-item" href="categories.php">Categories</a>
            <a class="collapse-item active" href="suppliers.php">Suppliers</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Stock Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-cube"></i>
          <span>Stock</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="near-expiry.php">Near Expiry</a>
            <a class="collapse-item" href="expired.php">Expired</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Purchases Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePagesPurchases" aria-expanded="true" aria-controls="collapsePagesPurchases">
          <i class="fas fa-fw fa-shopping-cart"></i>
          <span>Purchases</span>
        </a>
        <div id="collapsePagesPurchases" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="purchase-order.php">Purchase Order</a>
            <a class="collapse-item" href="purchase-invoice.php">Purchase Invoice</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Sales Invoice Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link" href="pos.php">
          <i class="fas fa-fw fa-dollar-sign"></i>
          <span>Point of Sales</span></a>
      </li>

<?php 
        if($login_type != "Super Admin" and $login_type != "Admin") {
          echo "<style>#cpanel { display: none; }</style>";
        }
?>

<!-- Nav Item - Control Panel Collapse Menu -->
      <li class="nav-item" id="cpanel">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagesControlPanel" aria-expanded="true" aria-controls="collapsePagesControlPanel">
          <i class="fas fa-fw fa fa-cog"></i>
          <span>Control Panel</span>
        </a>
        <div id="collapsePagesControlPanel" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="user-account.php">Users</a>
            <?php 
                    if($login_type == "Super Admin") {
                      echo '<a class="collapse-item" href="log-management.php">Log Management</a>
                            <a class="collapse-item" href="archive.php">Archive</a>
                            <a class="collapse-item" href="backup.php">Backup Database</a>';
                    }
            ?>
          </div>
        </div>
      </li>

    </ul>
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

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
