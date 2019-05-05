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

  <title>SafeMed Pharmacy - User Account</title>

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
    right: 20px;
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
            <h1 class="h3 mb-0 text-gray-800">User Account</h1>
            <div class="action-buttons">

            <?php 
            if($login_type == "Super Admin") { 
            echo '<a href="add-user-account.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i>  Add Record</a>';
                  }
            ?>

            </div>
          </div>

          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">List of User Accounts</h6>
            </div>
            <div class="card-body">

                <div class="mb-2">
                  <div class="card bg-primary text-white shadow">
                    <div class="card-body">
                      <span style="font-size: 0.80rem;">All list of employee's user accounts are recorded and displayed in this section.</span>
                    </div>
                  </div>
                </div>

              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th width="10%">User ID</th>
                      <th width="20%">Username</th>
                      <th width="20%">Employee Name</th>
                      <th width="20%">User Type</th>                        
                      <th width="15%" class="controls">Controls</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <?php    
                      $query = "SELECT * FROM dim_login WHERE status = 'active';";

                      $result_set =  mysqli_query($connect, $query);
                      if(mysqli_num_rows($result_set) == 0) echo "<table><tbody><tr><p class='no-record'><center>No record can be found.</center></p></tr></tbody></table>
                                <style>tbody { display: none; } table.table-bordered.dataTable th:first-child { border-left-width: 1px; } table.table-bordered.dataTable th:last-child { border-right-width: 1px; } </style>";

                      while($row = mysqli_fetch_array($result_set)) {
                      ?>
                      <td><?php echo $row['id']; ?></td>
                      <td><?php echo $row['username']; ?></td>
                      <td><?php echo $row['name']; ?></td>
                      <td><?php echo $row['login_type']; ?></td>
                      <td class="controls"><center>
                        <form class="form control_button" action="edit-user-account.php?id=<?php echo $row['id']; ?>" method="post">
                          <button type="submit" id="submit" name="edit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-edit fa-sm text-white-50"></i> Edit</button>
                          <input type= "hidden" name = "id" value ="<?php echo $row['id']; ?>"/>
                        </form>
                        <form class="form control_button" action="delete-user-account-process.php" method="post">
                          <button type="submit" id="submit" name="edit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-times fa-sm text-white-50"></i> Delete</button>
                          <input type= "hidden" name = "id" value ="<?php echo $row['id']; ?>"/>
                        </form>
                      </center></td>                      
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
      var today = new Date();
      var dd = String(today.getDate()).padStart(2, '0');
      var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
      var yyyy = today.getFullYear();

      today = mm + '/' + dd + '/' + yyyy;

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
           },

                      {
                        alignment: 'center',
                        text: '#33 Arayat St., Bgy. San Martin de Porres, Cubao, Quezon City \n' + today,
                    } );
                },

                  exportOptions: {
                      columns: [ 0, 1, 2, 3, 4 ]
                  }
              }
          ], "columnDefs": [
                  {
                    "targets": [ 0 ],
                    "visible": false,
                    "searchable": false
                  }
                  ]
                } );
                $('div.dt-buttons').appendTo('.action-buttons');
              } );
            </script>

            <!-- Custom scripts for all pages-->
            <script src="js/sb-admin-2.min.js"></script>

          </body>

          </html>
