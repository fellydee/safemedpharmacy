<!-- Suggest removing this page -->
<!-- Once user searches for SKU, must form-action into sku-process.php, then header
redirect to add-purchase-process.php, but this time enable the fields and display
the session variable values. -->

<!DOCTYPE html>
<html lang="en">

<?php

    $connect = mysqli_connect('localhost', 'root', '', 'safemedpharmacy');
    session_start();

   $sku = $_POST['sku'];
    


    if(!$_SESSION['username']) {
        header("Location: login.php");
    }
    else {
        $username = $_SESSION['username'];
        $name = $_SESSION['name'];
        $login_type = $_SESSION['login_type'];
    }



    // Get SKU value from POST
    // $sku = "";
    // $Supplier = $_POST['Supplier'];
    // Retrieves all .csv files in the said directory and stores it in variable $files
    $files = glob("dir/*.csv");

    foreach($files as $file) {
        if (($handle = fopen($file, "r")) !== FALSE) {
           // echo "<strong>Filename: " . basename($file) . "</strong><br><br>";
            // While there are data to be read
            while (($data = fgetcsv($handle, 4096, "\n")) !== FALSE) {
                // Just counts the length of the $data array
                $num = count($data);

                  // Runs a for loop through all the rows
                for ($c=0; $c < $num; $c++) {
                    // echo $data[$c] . "<br />\n"; // $data[$c] is the row/one row

                    // Delimit the row by commas to get each column value
                    $row_content = ( explode(',', $data[$c]) );

                    // Compare if the row's SKU is the same as the SKU that we are looking for
                    if ($sku === $row_content[0]) {
                        // Store the values in an associative array
                        $session_array = array(
                            "SKU" => $row_content[0],
                            "Supplier" => $row_content[1],
                            "Brand Name" => $row_content[2],
                            "Generic Name" => $row_content[3],
                            "Uom" => $row_content[4],
                            "Category" => $row_content[5],
                            "Expiry Date" => $row_content[6],
                            "Total Price" => $row_content[7],
                            "Unit Price" => $row_content[8],
                            "Selling Price" => $row_content[9]
                        );
                        $_SESSION['result'] = $session_array;
                    }
                }
                // echo "<br />";
            }
            fclose($handle);
        } else {
            echo "Could not open file: " . $file;
      }
   }



?>


<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SafeMed Pharmacy - Add Purchase Order</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

  <link href="css/style.css" rel="stylesheet">

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
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-list"></i>
          <span>Items</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="inventory.php">Inventory</a>
            <a class="collapse-item" href="categories.php">Categories</a>
            <a class="collapse-item" href="suppliers.php">Suppliers</a>
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
        <a class="nav-link active" href="#" data-toggle="collapse" data-target="#collapsePagesPurchases" aria-expanded="true" aria-controls="collapsePagesPurchases">
          <i class="fas fa-fw fa-shopping-cart"></i>
          <span>Purchases</span>
        </a>
        <div id="collapsePagesPurchases" class="collapse show" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item active" href="purchase-order.php">Purchase Order</a>
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
            <h1 class="h3 mb-0 text-gray-800">Add New Purchase Order</h1>
          </div>

          <!-- Content Row -->
          <div class="row">


            <!-- Border Left Utilities -->
              <div class="col-lg-6">
                <div class="card shadow mb-4">
                  <div class="card-body">
                    <div class="box-body">
                      <form class="form" action="add-purchase-order-process.php" method="post">
                        <div class="form-group">
                          <label>SKU</label>
                          <!-- <form action="add-purchase-order-process.php" method="post"> -->
                          <input type="text" class="form-control" name="sku" value="<?php echo $sku;?>" readonly>
                        <!-- </form> -->
                        </div>
                       
                        <div class="form-group">
                          <label>Brand Name</label>
                          <input type="text" class="form-control" name="brand_name" value="<?php echo $_SESSION['result']['Brand Name'];?>" readonly>
                        </div>
                        <div class="form-group">
                          <label>Supplier</label>
                          <input type="text" class="form-control" name="supplier" value="<?php echo $_SESSION['result']['Supplier'];?>" readonly>
                        </div>
                        <div class="form-group">
                          <label>Unit of Measurement</label>
                          <input type="text" class="form-control" name="uom" value="<?php echo $_SESSION['result']['Uom'];?>" readonly>
                        </div>                        
                        <div class="form-group">
                          <label>Defective Quantity</label>
                          <input type="text" class="form-control" name="defective_qty" value="" >
                        </div>  
                        <div class="form-group">
                          <label>Unit Price</label>
                          <input type="text" class="form-control" name="unit_price" value="<?php echo $_SESSION['result']['Unit Price'];?>" readonly>
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
                          <input type="text" class="form-control" name="generic_name" value="<?php echo $_SESSION['result']['Generic Name'];?>" readonly>
                        </div>
                         <div class="form-group">
                          <label>Category</label>
                          <input type="text" class="form-control" name="category" value="<?php echo $_SESSION['result']['Category'];?>" readonly>
                        <div class="form-group">
                          <label>Order Quantity</label>
                          <input type="text" class="form-control" name="order_qty" value="" required>
                        </div>
                        <div class="form-group">
                          <label>Expiration Date</label>
                          <input type="text" class="form-control" name="expiration_date" value="<?php echo $_SESSION['result']['Expiry Date'];?>" readonly>
                        </div>  
                        <div class="form-group">
                          <label>Selling Price</label>
                          <input type="text" class="form-control" name="selling_price" value="<?php echo $_SESSION['result']['Selling Price'];?>" readonly>
                        </div>     
                      </div>
                  </div>
                </div>

                  <input type= "hidden" name = "name" value ="<?php echo $name ?>"/>
                  
                  <div class="submit-footer">
                    <input type="submit" class="btn btn-primary" value="Submit" name="submit" />
                    <a href="purchase-order.php" class="btn btn-primary">Cancel</a>
                  </div>
                </form>
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


