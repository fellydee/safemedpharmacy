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

  <title>SafeMed Pharmacy - Suppliers</title>

  <?php include('assets.php'); ?>

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
  .dt-buttons {
    float: right;
    margin-left: 4px;
  }
  .dt-buttons button {
    display:inline-block;
    font-weight:400;
    font-size: .875rem;
    background-color: #4e73df;
    border-color: #4e73df;
    color:#fff;
    text-align:center;
    vertical-align:middle;
    -webkit-user-select:none;
    -moz-user-select:none;
    -ms-user-select:none;
    user-select:none;
    padding:.25rem .5rem;
    line-height:1.5;
    border-radius:.2rem;
    -webkit-transition:color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,-webkit-box-shadow .15s ease-in-out;
    transition:color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,-webkit-box-shadow .15s ease-in-out;
    transition:color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    transition:color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out,-webkit-box-shadow .15s ease-in-out
  }
  .dataTables_info {
    display: inline-block;
  }
  .dataTables_paginate {
    float: right;
  }
  .control_button {
    display: inline-block;
  }
  #dataTable_filter {
    position: absolute;
    right: 15px;
    top: 10px;
  }
  #dataTable_filter input {
    display: inline-block;
    width: auto;
    margin-left: 0.5em;
  }
  #dataTable_filter label {
    font-size: .85rem;
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
            <h1 class="h3 mb-0 text-gray-800">Suppliers</h1>
            <div class="action-buttons"><a href="add-supplier.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i>  Add Record</a> </div>
          </div>

          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">List of Suppliers</h6>
            </div>
            <div class="card-body">

                <div class="mb-2">
                  <div class="card bg-primary text-white shadow">
                    <div class="card-body">
                      <span style="font-size: 0.80rem;">Different suppliers of the business can be recorded and displayed in this section.</span>
                    </div>
                  </div>
                </div>

              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th width="20%">Supplier Name</th>
                      <th width="20%">Company</th>                      
                      <th width="20%">Location</th>
                      <th width="20%">Contact Details</th>
                      <th width="20%">Controls</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <?php    
                      $query = "SELECT * FROM dim_supplier";

                      $result_set =  mysqli_query($connect, $query);
                      if(mysqli_num_rows($result_set) == 0) echo "<table><tbody><tr><p class='no-record'><center>No record can be found.</center></p></tr></tbody></table>
                                <style>tbody { display: none; } table.table-bordered.dataTable th:first-child { border-left-width: 1px; } table.table-bordered.dataTable th:last-child { border-right-width: 1px; } </style>";

                      while($row = mysqli_fetch_array($result_set)) {
                      ?>
                      <td><?php echo $row['supplier_name']; ?></td>
                      <td><?php echo $row['company']; ?></td>
                      <td><?php echo $row['location']; ?></td>                      
                      <td><?php echo $row['contact_details']; ?></td>
                      <td><center>
                          <form class="form control_button" action="edit-supplier.php?id=<?php echo $row['supplier_id']; ?>" method="post">
                          <button type="submit" id="submit" name="edit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-edit fa-sm text-white-50"></i> Edit</button>
                          <input type= "hidden" name = "supplier_id" value ="<?php echo $row['supplier_id']; ?>"/>
                        </form></center>
                      </td>
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

  <script type="text/javascript" src="vendor/datatables/dataTables.buttons.min.js"></script> 
  <script type="text/javascript" src="vendor/datatables/jszip.min.js"></script>
  <script type="text/javascript" src="vendor/datatables/buttons.html5.min.js"></script>
  <script type="text/javascript" src="vendor/datatables/pdfmake.min.js"></script>
  <script type="text/javascript" src="vendor/datatables/vfs_fonts.js"></script>

  <script>
  $(document).ready(function() {
      $('#dataTable').DataTable( {
          "order": [[ 0, "asc" ]],
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
<?php 
if($login_type != "Super Admin" and $login_type != "Admin") { 
echo ', "columnDefs": [
            {
                "targets": [ 4 ],
                "visible": false,
                "searchable": false
            }
        ]';
      }
?>
      } );
      $('div.dataTables_filter').appendTo('.card-header');
      $('div.dt-buttons').appendTo('.action-buttons');
  } );
  </script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
