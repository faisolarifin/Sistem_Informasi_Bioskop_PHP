<?php
$action = @htmlentities($_GET['act']);
if ($action=='ubahstudio')
{
  $kode = $konek->real_escape_string($_GET['id']);
  $query = $konek->query("SELECT * FROM studio WHERE id_studio='$kode'");
  $row = $query->fetch_object();
  $kode = $row->id_studio;
}else{
  $kode = autocode('id_studio','studio','STD');
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
              <li class="breadcrumb-item active">Daftar Studio</li>
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
          <div class="col-md-5">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Tambah Studio</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="" method="post" name="simpan">
                <div class="card-body">
                  <div class="form-group">
                    <label for="idStudio">ID Studio</label>
                    <input type="text" class="form-control" id="idStudio" placeholder="ID Studio" name="kode" value="<?= @$kode; ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label for="namaStudio">Nama Studio</label>
                    <input type="text" class="form-control" id="namaStudio" placeholder="Nama Studio" name="nama" value="<?= @$row->nama_studio; ?>">
                  </div>
                  <div class="form-group">
                    <label for="namaStudio">Jenis Studio</label>
                    <select class="custom-select" id="namaStudio" name="jenis">
                          <option value="">- Pilih -</option>
    
                            <option value="premium" <?= @$row->jenis=='premium' ? 'selected' : ''; ?>>Premium</option>
                            <option value="vip" <?= @$row->jenis=='vip' ? 'selected' : ''; ?>>VIP</option>
                 
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
        <div class="col-md-7">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Daftar Studio</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table class="table table-bordered">
              <thead>                  
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Nama Studio</th>
                  <th>Jenis Studio</th>
                  <th>Jumlah Kursi</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
              <?php 
                $no=1;
                $query = $konek->query("SELECT * FROM studio");
                while($row=$query->fetch_object()){
               ?>
                  <tr>
                    <td><?= $no; ?>.</td>
                    <td><?= $row->nama_studio; ?></td>
                    <td><?= $row->jenis; ?></td>
                    <td><?=$konek->query("SELECT COUNT(id_kursi) as kursi FROM kursi WHERE id_studio='$row->id_studio'")->fetch_object()->kursi; ?></td>
                    <td style="text-align:center;">
                      <a href="index.php?req=daftarstudio&act=ubahstudio&id=<?= $row->id_studio; ?>" title="Ubah Data" class="btn btn-info btn-sm"><i class="fa fa-edit "></i> Edit</a>
                      <a href="index.php?req=daftarstudio&act=hapusstudio&id=<?= $row->id_studio; ?>" title="Hapus Data" class="btn btn-danger btn-sm"  onClick="return confirm('Yakin mau di hapus?');"><i class="fa fa-trash "></i> Hapus </a>
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
  $jenis = $konek->real_escape_string($_POST['jenis']);
  if($action=='ubahstudio')
  {
    $konek->query("UPDATE studio SET nama_studio='$nama', jenis='$jenis' WHERE id_studio='$kode'");
  }else{
    $konek->query("INSERT INTO studio VALUES ('$kode','$nama','$jenis')");
  }
  echo "<script>window.location='index.php?req=daftarstudio';</script>";
}
if ($action=='hapusstudio')
{
  $kode = $konek->real_escape_string($_GET['id']);
  $konek->query("DELETE FROM studio WHERE id_studio='$kode'");
  echo "<script>window.location='index.php?req=daftarstudio';</script>";
}
?>