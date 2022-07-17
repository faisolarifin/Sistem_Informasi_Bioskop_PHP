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
              <li class="breadcrumb-item active">Detail</li>
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
               Detail
             </div>
             <div class="card-body">
              <table>
                <?php
                $id = $konek->real_escape_string($_GET['id']);
                $query = $konek->query("SELECT jns.*, flm.* FROM film flm, jenis_film jns WHERE jns.id_jns=flm.id_jns AND flm.id_film='$id'");
                while($row=$query->fetch_object())
                {
                ?>
                <tr>
                  <td rowspan="5" style="width:430px;text-align:center;"><img src="../upload/images/<?= $row->gambar; ?>" width="350" height="300" alt="poster"></td>
                </tr>
                <tr>
                  <td style="width:100px;">Judul Film :</td>
                  <td><?= $row->judul_film; ?></td>
                </tr>
                <tr>
                  <td>Jenis Film :</td>
                  <td><?= $row->jns_film; ?></td>
                </tr>
                <tr>
                  <td>Durasi :</td>
                  <td><?= $row->durasi; ?></td>
                </tr>
                <tr>
                  <td>Jam Tayang :</td>
                  <td>
                    <?php
                    $query = $konek->query("SELECT * FROM jadwal WHERE id_film='".$row->id_film."' AND tanggal = current_date()");
                    while($r=$query->fetch_object()){
                      echo "<span style='padding:5px;background:#3ecf65;'>".substr($r->jam_mulai, 0, 5).'-'.substr($r->jam_selesai, 0, 5)."</span> ";
                    }
                    ?>
                  </td>
                </tr>
                <tr>
                  <td colspan="3" style="padding:20px;"><?= $row->deskripsi; ?></td>
                </tr>
                <?php
                }
                ?>
              </table>
             </div>
           </div>
        </div>
      </div>
   </section>
</div>