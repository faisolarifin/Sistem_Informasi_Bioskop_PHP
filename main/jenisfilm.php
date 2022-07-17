<?php
$action = @htmlentities($_GET['act']);
if ($action=='ubahjenis')
{
  $kode = $konek->real_escape_string($_GET['id']);
  $query = $konek->query("SELECT * FROM jenis_film WHERE id_jns='$kode'");
  $row = $query->fetch_object();
  $kode = $row->id_jns;
}else{
  $kode = autocode('id_jns','jenis_film','GEN');
}
?> 
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
              <li class="breadcrumb-item active">Jenis Film</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Tambah Jenis</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="" method="post" name="simpan">
                <div class="card-body">
                  <div class="form-group">
                    <label for="idJenis">ID Jenis</label>
                    <input type="text" class="form-control" id="idJenis" placeholder="ID Jenis" name="kode" value="<?= @$kode; ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label for="JenisFilm">Jenis Film</label>
                    <input type="text" class="form-control" id="JenisFilm" placeholder="Jenis Film" name="jenis" value="<?= @$row->jns_film; ?>">
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <input type="submit" name="simpan" class="btn btn-primary" value=" <?= @$action=='' ? 'Tambah' : 'Ubah'; ?>">
                </div>
              </form>

            </div>
            <!-- /.card -->
        </div>
        <!-- right column -->
        <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Jenis Film</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table class="table table-bordered">
              <thead>                  
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Nama Jenis</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
              <?php 
                $no=1;
                $query = $konek->query("SELECT * FROM jenis_film");
                while($row=$query->fetch_object()){
               ?>
                  <tr>
                    <td><?= $no; ?>.</td>
                    <td><?= $row->jns_film; ?></td>
                    <td style="text-align:center;">
                      <a href="index.php?req=jenisfilm&act=ubahjenis&id=<?= $row->id_jns; ?>" title="Ubah Data" class="btn btn-info btn-sm"><i class="fa fa-edit "></i> Edit</a>
                      <a href="index.php?req=jenisfilm&act=hapusjenis&id=<?= $row->id_jns; ?>" title="Hapus Data" class="btn btn-danger btn-sm"  onClick="return confirm('Yakin mau di hapus?');"><i class="fa fa-trash "></i> Hapus </a>
                    </td>
                  </tr>
              <?php 
                  $no++;
                }
              ?>
              </tbody>
            </table>
          </div>
        </div>
        <!-- /.card -->
        </div>
      </div>
    </div>
  </section>
</div>


<?php
$simpan = @htmlentities($_POST['simpan']);
if ($simpan)
{
  $kode = $konek->real_escape_string($_POST['kode']);
  $jenis = $konek->real_escape_string($_POST['jenis']);
  if($action=='ubahjenis')
  {
    $konek->query("UPDATE jenis_film SET jns_film='$jenis' WHERE id_jns='$kode'");
  }else{
    $konek->query("INSERT INTO jenis_film VALUES ('$kode','$jenis')");
  }
  echo "<script>window.location='index.php?req=jenisfilm';</script>";
}
if ($action=='hapusjenis')
{
  $kode = $konek->real_escape_string($_GET['id']);
  $konek->query("DELETE FROM jenis_film WHERE id_jns='$kode'");
  echo "<script>window.location='index.php?req=jenisfilm';</script>";
}
?>