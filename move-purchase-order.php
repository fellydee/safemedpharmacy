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

    // print_r($_POST);
   $sku = $_POST['sku'];    

    
    // For removal
    $files = glob("dir/*.csv");
    // $sku = $_SESSION['result']['SKU'];
    // $unit_price = $_SESSION['result']['Unit Price'];


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

  <?php include('meta.php'); ?>

  <title>SafeMed Pharmacy - Edit Purchase Order</title>

  <?php include('assets.php'); ?>

  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  
  <!-- Tinanggal na styles -->
  <link href="./css/style.css" rel="stylesheet">

 

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
                      <form class="form" action="move-purchase-order-process.php" method="post">
                        <?php 
                       $query = "SELECT * from dim_inventory where sku = '$sku'";
                        $result_set =  mysqli_query($connect, $query);

                        while($row = mysqli_fetch_array($result_set)) {
                        ?>
                        <div class="form-group">
                        <label>SKU</label>
                        <input readonly type="text" class="form-control" name="sku" value="<?php echo $row['sku']; ?>">
                        </div>
                        <div class="form-group">
                          <label>Brand Name</label>
                          <input readonly type="text" class="form-control" name="brand_name" value="<?php echo $row['brand_name']; ?>">
                        </div>
                        <div class="form-group">
                          <label>Supplier</label>
                          <!-- <input type="text" class="form-control" name="supplier" value=""> -->
                          <input readonly type="text" class="form-control" name="supplier" value="<?php echo $row['supplier']; ?>">
                        </div>
                        <div class="form-group">
                          <label>Unit of Measurement</label>
                          <input readonly type="text" class="form-control" name="uom" value="<?php echo $row['uom']; ?>">
                        </div>                        
                        <div class="form-group">
                          <label>Defective Quantity</label>
                          <input type="text" class="form-control" name="defective_qty" value="0" >
                        </div>  
                        <div class="form-group">
                          <label>Unit Price</label>
                          <input readonly type="text" class="form-control" name="unit_price" value="<?php echo $row['unit_price']; ?>" >
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
                          <input readonly type="text" class="form-control" name="generic_name" value="<?php echo $row['generic_name']; ?>">
                        </div>
                        <div class="form-group">
                          <label>Category</label>
                          <!-- <input type="text" class="form-control" name="category" value=""> -->
                          <input readonly type="text" class="form-control" name="category" value="<?php echo $row['category']; ?>">
                        </div>
                         <div class="form-group">
                          <label>Order Quantity</label>
                          <input readonly type="text" class="form-control" name="order_qty" value="<?php echo $row['order_qty']; ?>">
                        </div>      
                        <div class="form-group">
                          <label>Expiration Date</label>
                          <input readonly type="text" class="form-control" name="expiration_date" value="<?php echo $row['expiration_date']; ?> ">
                        </div>  
                        <div class="form-group">
                          <label>Selling Price</label>
                         <input readonly type="text" class="form-control" name="selling_price" value="<?php echo $row['selling_price']; ?> ">
                        </div>    
                      </div>
                  </div>
                </div>


                  <input type= "hidden" name = "name" value ="<?php echo $name ?>"/>
                  <input type= "hidden" name = "order_qty" value ="<?php echo $row['order_qty'] ?>"/>
                  <input type= "hidden" name = "item_id" value ="<?php echo $row['item_id']; ?>"/>
                   <input type="hidden" name="sku" value="<?php echo $row['sku']; ?>">
                   <input type="hidden" name="supplier" value="<?php echo $row['supplier']; ?>">
                   <input type="hidden" name="brand_name" value="<?php echo $row['brand_name']; ?>">
                   <input type="hidden" name="generic_name" value="<?php echo $row['generic_name']; ?>">
                    <input type="hidden" name="uom" value="<?php echo $row['uom']; ?>">
                    <input type="hidden" name="category" value="<?php echo $row['category']; ?>">
                    <input type="hidden" name="expiration_date" value="<?php echo $row['expiration_date']; ?>">
                    <input type="hidden" name="unit_price" value="<?php echo $row['unit_price']; ?>">
                    <input type="hidden" name="selling_price" value="<?php echo $row['selling_price']; ?>">
                 
                  <div class="submit-footer">
                    <input type="submit" class="btn btn-primary" value="Submit" name="submit" />
                    <a href="purchase-order.php" class="btn btn-primary">Cancel</a>
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
