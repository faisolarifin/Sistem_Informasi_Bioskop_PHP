<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Jadwal Tayang</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Daftar Jadwal</li>
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
              <h3 class="card-title"><a href="index.php?req=formjadwal"><button type="button" class="btn btn-block btn-success btn-sm">Tambah Jadwal</button></a></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th style="width:10px;">#</th>
                  <th>Kode Jadwal</th>
                  <th>Nama Studio</th>
                  <th>Judul Film</th>
                  <th>Tanggal</th>
                  <th>Jam Mulai</th>
                  <th>Jam Selesai</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                  $no=1;
                  $query = $konek->query("SELECT s.*, f.id_film, f.judul_film, j.* FROM studio s, film f, jadwal j WHERE s.id_studio=j.id_studio AND f.id_film=j.id_film");
                  while ($row=$query->fetch_object()){
                 ?>
                  <tr>
                    <td><?= $no; ?></td>
                    <td><?= $row->id_jadwal; ?></td>
                    <td><?= $row->nama_studio.' ['.$row->jenis.']'; ?></td>
                    <td><?= $row->judul_film; ?></td>
                    <td><?= $row->tanggal; ?></td>
                    <td><?= substr($row->jam_mulai, 0, 5); ?></td>
                    <td><?= substr($row->jam_selesai, 0, 5); ?></td>
                    <td style="text-align:center;">
                      <a href="?req=formjadwal&act=ubahjadwal&id=<?= $row->id_jadwal; ?>" title="Ubah Data" class="btn btn-info btn-sm"><i class="fa fa-edit "></i> Edit</a>
                      <a href="?req=<?= $_GET['req']; ?>&act=hapusjadwal&id=<?= $row->id_jadwal; ?>" title="Hapus Data" class="btn btn-danger btn-sm"  onClick="return confirm('Yakin mau di hapus?');"><i class="fa fa-trash "></i> Hapus </a>
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
if ($action=='hapusjadwal')
{
  $kode = $konek->real_escape_string($_GET['id']);
  $konek->query("DELETE FROM jadwal WHERE id_jadwal='$kode'");
  echo "<script>window.location='index.php?req=".$_GET['req']."'</script>";
}
?>