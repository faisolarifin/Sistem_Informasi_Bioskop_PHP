<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Data User</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Daftar Pengguna</li>
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
              <h3 class="card-title"><a href="index.php?req=formuser"><button type="button" class="btn btn-block btn-success btn-sm">Tambah User</button></a></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th style="width:10px;">#</th>
                  <th>Nama</th>
                  <th>E-Mail</th>
                  <th>Gender</th>
                  <th>Password</th>
                  <th>Hak Akses</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                  $no=1;
                  $req = $konek->real_escape_string($_GET['req']);
                  if ($req=='customer')
                  {
                    $query = $konek->query("SELECT * FROM user WHERE hak_akses LIKE 'customer%'");
                  } else {
                    $query = $konek->query("SELECT * FROM user WHERE hak_akses LIKE 'admin%' OR hak_akses LIKE 'penjualan%' OR hak_akses LIKE 'petugas%'");
                  }
                  while ($row=$query->fetch_object()){
                 ?>
                  <tr>
                    <td><?= $no; ?></td>
                    <td><?= $row->nama; ?></td>
                    <td><?= $row->email; ?></td>
                    <td><?= $row->jenis_kelamin; ?></td>
                    <td><?= $row->password; ?></td>
                    <td><?= $row->hak_akses; ?></td>
                    <td style="text-align:center;">
                      <a href="?req=formuser&act=ubahuser&id=<?= $row->id_user; ?>" title="Ubah Data" class="btn btn-info btn-sm"><i class="fa fa-edit "></i> Edit</a>
                      <a href="?req=<?= $_GET['req']; ?>&act=hapususer&id=<?= $row->id_user; ?>" title="Hapus Data" class="btn btn-danger btn-sm"  onClick="return confirm('Yakin mau di hapus?');"><i class="fa fa-trash "></i> Hapus </a>
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
if ($action=='hapususer')
{
  $kode = $konek->real_escape_string($_GET['id']);
  $konek->query("DELETE FROM user WHERE id_user='$kode'");
  echo "<script>window.location='index.php?req=".$_GET['req']."'</script>";
}
?>