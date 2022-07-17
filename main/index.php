<?php
  session_start();
  include '../koneksi/koneksi.php';
  include '../koneksi/fungsi.php';

  define('AKSES', 1);
  if (!empty($_SESSION['id_user']) and ($_SESSION['akses'] == 'petugas' or $_SESSION['akses'] == 'penjualan' or $_SESSION['akses'] == 'admin')) 
  {
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SIKOP | Sistem Penjualan Tiket Bioskop</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="../plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <!-- instascanner -->
  <script src="../plugins/qrcode-js-master/instascan.min.js"></script>
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">SIKOP</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Kelompok 1</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="index.php" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <?php
            if ($_SESSION['akses'] == 'penjualan' || $_SESSION['akses'] == 'admin')
            {
          ?>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Master Data
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="?req=jenisfilm" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Jenis Film</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?req=daftarstudio" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Daftar Studio</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?req=daftarkursi" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Daftar Kursi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?req=daftarfilm" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Daftar Film</p>
                </a>
              </li>

            </ul>
          </li>
          <?php
            if ($_SESSION['akses'] == 'admin')
            {
          ?>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Daftar User
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="?req=customer" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Daftar Customer</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?req=mainuser" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Main User</p>
                </a>
              </li>
            </ul>
          </li>
          <?php
            }
          ?>
          <li class="nav-item has-treeview">
            <a href="?req=jadwal" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Jadwal Tayang
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="?req=tiket" class="nav-link">
              <i class="nav-icon fas fa-sticky-note"></i>
              <p>
                Tiket
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="?req=pemesan" class="nav-link">
              <i class="nav-icon fas fa-th-list"></i>
              <p>
                Pemesan
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="?req=laporan" class="nav-link">
              <i class="nav-icon fas fa-database"></i>
              <p>
                Laporan
              </p>
            </a>
          </li>
          <?php
            }
            if ($_SESSION['akses'] == 'petugas' || $_SESSION['akses'] == 'admin')
            {
          ?>
          <li class="nav-item has-treeview">
            <a href="?req=checkin" class="nav-link">
              <i class="nav-icon fas fa-qrcode"></i>
              <p>
                Check In
              </p>
            </a>
          </li>
          <?php
            }
          ?>
          <li class="nav-item has-treeview" onclick="return confirm('Anda akan keluar ?');">
            <a href="./logout.php" class="nav-link">
              <i class="nav-icon fas fa-power-off"></i>
              <p>
                Sign Out
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>


<?php
  $request = @htmlentities($_GET['req']);
  switch ($request) {
    case 'dashboard':
      include './dashboard.php';
      break;
    case 'jenisfilm':
      include './jenisfilm.php';
      break;
    case 'daftarfilm':
      include './df_film.php';
      break;
    case 'daftarstudio':
      include './df_studio.php';
      break;
    case 'daftarkursi':
      include './df_kursi.php';
      break;
    case 'formfilm':
      include './form-film.php';
      break;
    case 'customer':
      include './df_user.php';
      break;
    case 'mainuser':
      include './df_user.php';
      break;
    case 'formuser':
      include './form-user.php';
      break;
    case 'jadwal':
      include './jadwal.php';
      break;
    case 'formjadwal':
      include './form-jadwal.php';
      break;
    case 'tiket':
      include './tiket.php';
      break;
    case 'formtiket':
      include './form-tiket.php';
      break;
    case 'pemesan':
      include './df_pemesan.php';
      break;
    case 'laporan':
      include './laporan.php';
      break;
    case 'checkin':
      include './check-in.php';
      break;
    default:
      include './dashboard.php';
      break;
  }

?>

  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; <?= date('Y'); ?> <a href="http://adminlte.io">Kelompok 1</a>.</strong>
    All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="../plugins/select2/js/select2.full.min.js"></script>
<!-- daterangepicker -->
<script src="../plugins/moment/moment.min.js"></script>
<script src="../plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- DataTables -->
<script src="../plugins/datatables/jquery.dataTables.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- date picker -->
<script src="../plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<!-- bs-custom-file-input -->
<script src="../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- scripting -->
<script src="../dist/js/main.js"></script>
<!-- page script -->
<script>
  $(function () {

    bsCustomFileInput.init();

    $('.select2').select2();
    $('.select3').select2();

    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });

    $(".datepicker").datepicker({
      format: 'yyyy-mm-dd',
      autoclose: true,
      todayHighlight: true,
    });

    //Timepicker
    $('#tayang, #selesai').datetimepicker({
      format: 'HH:mm'
    });
    var waktu = new Date();
    waktu.setHours(0, 0, 0);
    //Timepicker
    $('#durasi').datetimepicker({
      format: 'HH:mm:ss',
      useCurrent: false,
      defaultDate: waktu
    });
  });

</script>
</body>
</html>
<?php

 } else {

  echo "<script>
      window.location = './login.php';
    </script>";

}

?>