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
          <div class="col-lg-12">
           <div class="card">
             <div class="card-header">
               <h5> Film Tayang Hari Ini </h5>
             </div>
             <div class="card-body">
              <?php
                $cari = $konek->real_escape_string(@$_GET['cari']);  
                if ($cari){
                  $query = $konek->query("SELECT jdw.*, flm.* FROM jadwal jdw, film flm WHERE jdw.id_film=flm.id_film AND flm.judul_film LIKE '%".$cari."%'");
                } else {
                  $query = $konek->query("SELECT jdw.*, flm.* FROM jadwal jdw, film flm WHERE jdw.id_film=flm.id_film AND jdw.tanggal = current_date()");
                }
                while($row=$query->fetch_object()){

              ?>
               <div class="col-lg-3 colom">
                  <img src="../upload/images/<?= $row->gambar; ?>" alt="Poster">
                    <h1><?= $row->judul_film; ?></h1>
                  <div class="tombol">
                    <a href="?req=booking&id=<?= $row->id_film; ?>"><button class="btn btn-success btn-sm"><i class="fa fa-check "></i> Pesan </button></a>
                    <a href="?req=detail&id=<?= $row->id_film; ?>"><button class="btn btn-info btn-sm"><i class="fa fa-share "></i> Detail </button></a>
                  </div>
               </div>
               <?php
                }
               ?>
             </div>
           </div>
        </div>
      </div>
   </section>
</div>