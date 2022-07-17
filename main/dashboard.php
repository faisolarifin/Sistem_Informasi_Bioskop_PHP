<?php
  if (!defined('AKSES')) {
    echo "DOCUMENT NOT ACCESS !";
    exit();
  }

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Dashboard</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">        
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?= $konek->query("SELECT COUNT(id_film) as banyak FROM film")->fetch_object()->banyak; ?></h3>

                <p>Film</p>
              </div>
              <div class="icon">
                <i class="fa fa-play"></i>
              </div>
              <a href="?req=daftarfilm" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?= $konek->query("SELECT COUNT(id_studio) as banyak FROM studio")->fetch_object()->banyak; ?></h3>

                <p>Studio</p>
              </div>
              <div class="icon">
                <i class="fa fa-building"></i>
              </div>
              <a href="?req=daftarstudio" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?= $konek->query("SELECT COUNT(id_user) as banyak FROM user")->fetch_object()->banyak; ?></h3>

                <p>User</p>
              </div>
              <div class="icon">
                <i class="fa fa-users"></i>
              </div>
              <a href="?req=mainuser" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?= $konek->query("SELECT COUNT(id_pesan) as banyak FROM pesan")->fetch_object()->banyak; ?></h3>

                <p>Pemesan</p>
              </div>
              <div class="icon">
                <i class="fa fa-window-restore"></i>
              </div>
              <a href="?req=pemesan" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
      </div>
   </section>

   <section class="content">
    <div class="container-fluid">        
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <h1><center>Selamat Datang di Halaman <?= @$_SESSION['akses']=='admin' ? 'Admin' : ($_SESSION['akses']=='petugas' ? 'Petugas' : ($_SESSION['akses']=='penjualan' ? 'Penjualan' : 'Dear')); ?> SIKOP</center></h1>
              </div>
            </div>
          </div>
        </div>
    </div>
   </section>
</div>