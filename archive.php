<!DOCTYPE html>
<html lang="en">

<?php
    $connect = mysqli_connect('localhost', 'root', '', 'safemedpharmacy');
    session_start();


//         print_r($_POST);
// die();

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

  <title>SafeMed Pharmacy - Archive</title>

  <?php include('assets.php'); ?>

  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

  <link href="css/style-2.css" rel="stylesheet">

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
            <h1 class="h3 mb-0 text-gray-800">Archive</h1>
            <div class="action-buttons"> </div>
          </div>

          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Archive Accounts</h6>
            </div>
            <div class="card-body">

                <div class="mb-2">
                  <div class="card bg-primary text-white shadow">
                    <div class="card-body">
                      <span style="font-size: 0.80rem;">All archived accounts of employees are displayed in this section. Deletion of data should be at least after a year. </span>
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
                      <th width="10%" class="controls">Controls</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <?php    
                      $query = "SELECT * FROM dim_login WHERE status = 'inactive';";

                      $result_set =  mysqli_query($connect, $query);
                      if(mysqli_num_rows($result_set) == 0) echo "<table><tbody><tr><p class='no-record'><center>No record can be found.</center></p></tr></tbody></table>
                                <style>tbody { display: none; } table.table-bordered.dataTable th:first-child { border-left-width: 1px; } table.table-bordered.dataTable th:last-child { border-right-width: 1px; } </style>";

                      while($row = mysqli_fetch_array($result_set)) {
                      ?>
                      <td><?php echo $row['id']; ?></td>
                      <td><?php echo $row['username']; ?></td>
                      <td><?php echo $row['name']; ?></td>
                      <td><?php echo $row['login_type']; ?></td>
                      <td class="controls">
                       <!--  <form class="form control_button" action="edit-user-account.php?id=<?php echo $row['id']; ?>" method="post">
                          <button type="submit" id="submit" name="edit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-edit fa-sm text-white-50"></i> Edit</button>
                          <input type= "hidden" name = "id" value ="<?php echo $row['id']; ?>"/>
                        </form> -->
                        <!-- <form class="form control_button" action="reactivate-user-account-process.php" method="post">
                          <button type="submit" id="submit" name="edit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-times fa-sm text-white-50"></i> Reactivate</button>
                          <input type= "hidden" name = "id" value ="<?php echo $row['id']; ?>"/> -->
                          <form class="form control_button" action="delete-user-account-process.php" method="post">
                          <button type="submit" id="submit" name="edit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-times fa-sm text-white-50"></i> Delete</button>
                          <input type= "hidden" name = "id" value ="<?php echo $row['id']; ?>"/>
                        </form>
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
                  exportOptions: {
                      columns: [ 0, 1, 2, 3, 4 ]
                  }
              }
          ], 
          "columnDefs": [
            {
                "targets": [ 0 ],
                "visible": false,
                "searchable": false
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
