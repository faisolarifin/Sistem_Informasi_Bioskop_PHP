<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Tiket</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Daftar Tiket</li>
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
              List Tiket
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th style="width:10px;">#</th>
                  <th>ID Tiket</th>
                  <th>Judul Film</th>
                  <th>Tanggal</th>
                  <th>Jam Tayang</th>
                  <th>Jam Selesai</th>
                  <th>Harga</th>
                  <th>Jumlah</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                  $no=1;
                  $query = $konek->query("SELECT f.id_film, f.judul_film, j.*, t.* FROM film f, jadwal j, tiket t WHERE f.id_film=j.id_film AND j.id_jadwal=t.id_jadwal");
                  while ($row=$query->fetch_object()){
                 ?>
                  <tr>
                    <td><?= $no; ?></td>
                    <td><?= $row->id_tiket; ?></td>
                    <td><?= $row->judul_film; ?></td>
                    <td><?= $row->tanggal; ?></td>
                    <td><?= substr($row->jam_mulai, 0, 5); ?></td>
                    <td><?= substr($row->jam_selesai, 0, 5); ?></td>
                    <td><?= 'Rp. '.number_format($row->harga); ?></td>
                    <td><?= $row->stock; ?></td>
                    <td style="text-align:center;">
                      <a href="?req=formtiket&act=ubahtiket&id=<?= $row->id_tiket; ?>" title="Ubah Data" class="btn btn-info btn-sm"><i class="fa fa-edit "></i> Edit</a>
                      <a href="?req=<?= $_GET['req']; ?>&act=hapustiket&id=<?= $row->id_tiket; ?>" title="Hapus Data" class="btn btn-danger btn-sm"  onClick="return confirm('Yakin mau di hapus?');"><i class="fa fa-trash "></i> Hapus </a>
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
if ($action=='hapustiket')
{
  $kode = $konek->real_escape_string($_GET['id']);
  $konek->query("DELETE FROM tiket WHERE id_tiket='$kode'");
  echo "<script>window.location='index.php?req=".$_GET['req']."'</script>";
}
?>