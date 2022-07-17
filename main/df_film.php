  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Master Data</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Daftar Film</li>
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
              <h3 class="card-title"><a href="index.php?req=formfilm"><button type="button" class="btn btn-block btn-success btn-sm">Tambah Film</button></a></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th style="width:10px;">#</th>
                  <th>Poster</th>
                  <th>Judul Film</th>
                  <th>Jenis</th>
                  <th>Durasi</th>
                  <th>Deskripsi</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                  $no=1;
                  $query = $konek->query("SELECT j.id_jns, j.jns_film, f.* FROM jenis_film j, film f WHERE j.id_jns=f.id_jns");
                  while($row=$query->fetch_object()){
                 ?>
                  <tr>
                    <td><?= $no; ?></td>
                    <td style="text-align:center;"><img src="../upload/images/<?= $row->gambar; ?>" alt="Poster" width="180" height="150"></td>
                    <td><?= $row->judul_film; ?></td>
                    <td><?= $row->jns_film; ?></td>
                    <td><?= $row->durasi; ?></td>
                    <td><?= $row->deskripsi; ?></td>
                    <td style="text-align:center;">
                      <a href="index.php?req=formfilm&act=ubahfilm&id=<?= $row->id_film; ?>" title="Ubah Data" class="btn btn-info btn-sm"><i class="fa fa-edit "></i> Edit</a>
                      <a href="index.php?req=daftarfilm&act=hapusfilm&id=<?= $row->id_film; ?>" title="Hapus Data" class="btn btn-danger btn-sm"  onClick="return confirm('Yakin mau di hapus?');"><i class="fa fa-trash "></i> Hapus </a>
                    </td>
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

<?php
$action = @htmlentities($_GET['act']);
if ($action=='hapusfilm')
{
  $kode = $konek->real_escape_string($_GET['id']);
  $konek->query("DELETE FROM film WHERE id_film='$kode'");
  echo "<script>window.location='index.php?req=daftarfilm';</script>";
}
?>