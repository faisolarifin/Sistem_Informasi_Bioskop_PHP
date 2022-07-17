<?php
$action = @htmlentities($_GET['act']);
if ($action=='ubahtiket')
{
  $kode = $konek->real_escape_string($_GET['id']);
  $query = $konek->query("SELECT * FROM tiket WHERE id_tiket='$kode'");
  $row = $query->fetch_object();
  $kode = $row->id_tiket;
}else{
  $kode = autocode('id_tiket','tiket','TKT');
}
?> 

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
              <li class="breadcrumb-item active">Tambah Tiket</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6">
          <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Tambah Tiket</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="" method="post" name="simpan">
                <div class="card-body">
                  <div class="form-group">
                    <label for="idTiket">ID Tiket</label>
                    <input type="text" class="form-control" id="idTiket" placeholder="ID Tiket" name="kode" value="<?= @$kode; ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label for="Film">Film</label>
                    <select class="form-control select2 select-film" id="Film" style="width: 100%;" name="jadwal">
                      <option value="">- Pilih -</option>
                      <?php 
                          $query = $konek->query("SELECT f.id_film, f.judul_film, j.* FROM film f, jadwal j WHERE f.id_film=j.id_film");
                          while($r=$query->fetch_object()){
                        ?>
                          <option value="<?= $r->id_jadwal; ?>" <?= @$row->id_jadwal==$r->id_jadwal ? 'selected' : ''; ?>><?= $r->judul_film.' [ '.$r->tanggal.' ][ '.substr($r->jam_mulai, 0, 5).'-'.substr($r->jam_selesai, 0, 5).' ]'; ?></option>
                        <?php
                          }
                        ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="Harga">Harga</label>
                    <input type="text" class="form-control" id="Harga" placeholder="Harga Tiket" name="harga" value="<?= @$row->harga; ?>">
                  </div>
                  <div class="form-group">
                    <label for="Jumlah">Jumlah Tiket</label>
                    <input type="number" class="form-control" id="Jumlah" placeholder="Jumlah Tiket" name="jumlah" value="<?= @$row->stock; ?>">
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
              <h3 class="card-title">Detail Jadwal</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered">
                <tbody id="detail">
                  
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
  $jadwal = $konek->real_escape_string($_POST['jadwal']);
  $harga = $konek->real_escape_string($_POST['harga']);
  $jumlah = $konek->real_escape_string($_POST['jumlah']);
  if($action=='ubahtiket')
  {
    $konek->query("UPDATE tiket SET id_jadwal='$jadwal', harga='$harga', stock='$jumlah' WHERE id_tiket='$kode'");
  }else{
    $konek->query("INSERT INTO tiket VALUES ('$kode','$jadwal','$harga','$jumlah')");
  }
  echo "<script>window.location='index.php?req=tiket';</script>";
}

?>
