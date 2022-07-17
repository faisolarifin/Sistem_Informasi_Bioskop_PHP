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
          <h1>Pemesanan Tiket</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Detail Transaksi</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
        <!-- card -->
          <div class="card">
            <div class="card-header">
              <a href="?req=transaksi"><span class="btn btn-info btn-sm"><i class="fa fa-arrow-left"></i></span></a>
              <span class="btn btn-success btn-sm">Kode Pemesanan : <?= @$konek->real_escape_string($_GET['id']); ?></span>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th style="width:10px;">#</th>
                  <th>ID Pesan</th>
                  <th>Judul Film</th>
                  <th>Jam Tayang</th>
                  <th>Tanggal</th>
                  <th>Kursi</th>
                  <th>Total</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                  $no=1;
                  $id = $konek->real_escape_string($_GET['id']);
                  $query = $konek->query("SELECT psn.*, o_tkt.*, jdw.*, tkt.id_tiket, flm.judul_film FROM pesan psn, tiket_order o_tkt, jadwal jdw, tiket tkt, film flm WHERE psn.id_pesan=o_tkt.id_pesan AND o_tkt.id_tiket=tkt.id_tiket AND jdw.id_jadwal=tkt.id_jadwal AND jdw.id_film=flm.id_film AND psn.id_pesan='$id'");
                  while ($row=$query->fetch_object()){
                 ?>
                  <tr>
                    <td><?= $no; ?></td>
                    <td><?= $row->id_pesan; ?></td>
                    <td><?= $row->judul_film; ?></td>
                    <td><?= $row->tanggal; ?></td>
                    <td><?= substr($row->jam_mulai, 0, 5).' - '.substr($row->jam_selesai, 0, 5); ?></td>
                    <td>
                      <?php
                        $q = $konek->query("SELECT krs.*, tmp.* FROM kursi krs, kursi_order tmp WHERE krs.id_kursi=tmp.id_kursi AND tmp.id_pesan='".$row->id_pesan."'");
                        while($r=$q->fetch_object())
                        {
                          echo '['.$r->nama_kursi.'] ';
                        }
                      ?>
                    </td>
                    <td><?= $row->total; ?></td>
                  </tr>
                <?php 
                  $no++;
                  }
                ?>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div>
  </section>

</div>
