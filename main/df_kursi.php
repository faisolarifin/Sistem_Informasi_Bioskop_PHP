<?php
$action = @htmlentities($_GET['act']);
if ($action=='ubahkursi')
{
  $kode = $konek->real_escape_string($_GET['id']);
  $query = $konek->query("SELECT * FROM kursi WHERE id_kursi='$kode'");
  $row = $query->fetch_object();
  $kode = $row->id_kursi;
}else{
  $kode = autocode('id_kursi','kursi','KRS');
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
              <li class="breadcrumb-item active">Daftar Kursi</li>
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
                <h3 class="card-title">Tambah Kursi</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="" method="post" name="simpan">
                <div class="card-body">
                  <div class="form-group">
                    <label for="idKursi">ID Kursi</label>
                    <input type="text" class="form-control" id="idKursi" placeholder="ID Kursi" name="kode" value="<?= @$kode; ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label for="namaKursi">Nama Kursi</label>
                    <input type="text" class="form-control" id="namaKursi" placeholder="Nama Kursi" name="nama" value="<?= @$row->nama_kursi; ?>">
                  </div>
                  <div class="form-group">
                    <label for="namaStudio">Nama Studio</label>
                    <select class="custom-select" id="namaStudio" name="studio">
                          <option value="">- Pilih -</option>
                          <?php 
                            $query = $konek->query("SELECT * FROM studio");
                            while($r=$query->fetch_object()){
                          ?>
                            <option value="<?= $r->id_studio; ?>" <?= @$row->id_studio==$r->id_studio ? 'selected' : ''; ?>><?= $r->nama_studio; ?></option>
                          <?php
                            }
                          ?>
                      </select>
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
              <h3 class="card-title">Daftar Kursi</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered">
                <thead>                  
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Nama Kursi</th>
                    <th>Nama Studio</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                <?php 
                  $no=1;
                  $query = $konek->query("SELECT k.*, s.* FROM kursi k, studio s WHERE k.id_studio=s.id_studio");
                  while($row=$query->fetch_object()){
                 ?>
                    <tr>
                      <td><?= $no; ?>.</td>
                      <td><?= $row->nama_kursi; ?></td>
                      <td><?= $row->nama_studio; ?></td>
                      <td style="text-align:center;">
                        <a href="index.php?req=daftarkursi&act=ubahkursi&id=<?= $row->id_kursi; ?>" title="Ubah Data" class="btn btn-info btn-sm"><i class="fa fa-edit "></i> Edit</a>
                        <a href="index.php?req=daftarkursi&act=hapuskursi&id=<?= $row->id_kursi; ?>" title="Hapus Data" class="btn btn-danger btn-sm"  onClick="return confirm('Yakin mau di hapus?');"><i class="fa fa-trash "></i> Hapus </a>
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
  $nama = $konek->real_escape_string($_POST['nama']);
  $studio = $konek->real_escape_string($_POST['studio']);
  if($action=='ubahkursi')
  {
    $konek->query("UPDATE kursi SET nama_kursi='$nama', id_studio='$studio' WHERE id_kursi='$kode'");
  }else{
    $konek->query("INSERT INTO kursi VALUES ('$kode','$studio','$nama')");
  }
  echo "<script>window.location='index.php?req=daftarkursi';</script>";
}
if ($action=='hapuskursi')
{
  $kode = $konek->real_escape_string($_GET['id']);
  $konek->query("DELETE FROM kursi WHERE id_kursi='$kode'");
  echo "<script>window.location='index.php?req=daftarkursi';</script>";
}
?>