<?php
$action = @htmlentities($_GET['act']);
if ($action=='ubahjadwal')
{
  $kode = $konek->real_escape_string($_GET['id']);
  $query = $konek->query("SELECT  tkt.*, jdw.* FROM jadwal jdw, tiket tkt WHERE tkt.id_jadwal=jdw.id_jadwal AND jdw.id_jadwal='$kode'");
  $row = $query->fetch_object();
  $kode = $row->id_jadwal;
  $kodetiket = $row->id_tiket;
}else{
  $kode = autocode('id_jadwal','jadwal','JDW');
  $kodetiket = autocode('id_tiket','tiket','TKT');
}
?> 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Jadwal</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Tambah Jadwal</li>
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
                <h3 class="card-title">Tambah Jadwal</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="" method="post" name="simpan">
                <div class="card-body">
                  <div class="form-group">
                    <label for="idJadwal">ID Jadwal</label>
                    <input type="text" class="form-control" id="idJadwal" placeholder="ID Jadwal" name="kode" value="<?= @$kode; ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label for="Studio">Studio</label>
                    <select class="form-control select2" id="Studio" style="width: 100%;" name="studio">
                      <option value="">- Pilih -</option>
                      <?php 
                          $query = $konek->query("SELECT * FROM studio");
                          while($r=$query->fetch_object()){
                        ?>
                          <option value="<?= $r->id_studio; ?>" <?= @$row->id_studio==$r->id_studio ? 'selected' : ''; ?>><?= $r->nama_studio.' [ '.$r->jenis.' ]'; ?></option>
                        <?php
                          }
                        ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="Film">Film</label>
                    <select class="form-control select3" id="Film" style="width: 100%;" name="film">
                      <option value="">- Pilih -</option>
                      <?php 
                          $query = $konek->query("SELECT * FROM film");
                          while($r=$query->fetch_object()){
                        ?>
                          <option value="<?= $r->id_film; ?>" <?= @$row->id_film==$r->id_film ? 'selected' : ''; ?>><?= $r->judul_film; ?></option>
                        <?php
                          }
                        ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="Tanggal">Tanggal</label>
                    <input type="text" class="form-control datepicker" id="Tanggal" placeholder="Tanggal" name="tanggal" value="<?= @$row->tanggal; ?>">
                  </div>
                  <div class="form-group">
                    <label for="tayang">Jam Tayang:</label>
                    <div class="input-group date" id="tayang" data-target-input="nearest">
                      <input type="text" class="form-control datetimepicker-input" name="tayang" data-target="#tayang" value="<?= @$row->jam_mulai; ?>" />
                      <div class="input-group-append" data-target="#tayang" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="far fa-clock"></i></div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="selesai">Jam Selesai:</label>
                    <div class="input-group date" id="selesai" data-target-input="nearest">
                      <input type="text" class="form-control datetimepicker-input" name="selesai" data-target="#selesai" value="<?= @$row->jam_selesai; ?>" />
                      <div class="input-group-append" data-target="#selesai" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="far fa-clock"></i></div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
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
                    <input type="text" class="form-control" id="idTiket" placeholder="ID Tiket" name="kodetiket" value="<?= @$kodetiket; ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label for="Harga">Harga</label>
                    <input type="text" class="form-control" id="Harga" placeholder="Harga Tiket" name="harga" value="<?= @$row->harga; ?>">
                  </div>
                  <div class="form-group">
                    <label for="JumlahTkt">Jumlah Tiket</label>
                    <input type="number" class="form-control" id="JumlahTkt" placeholder="Jumlah Tiket" name="jumlah" value="<?= @$row->stock; ?>">
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
      </div>
    </div>
  </section>
</div>

<?php
$simpan = @htmlentities($_POST['simpan']);
if ($simpan)
{
  $kode = $konek->real_escape_string($_POST['kode']);
  $studio = $konek->real_escape_string($_POST['studio']);
  $film = $konek->real_escape_string($_POST['film']);
  $tanggal = $konek->real_escape_string($_POST['tanggal']);
  $tayang = $konek->real_escape_string($_POST['tayang']);
  $selesai = $konek->real_escape_string($_POST['selesai']);

  $kodetiket = $konek->real_escape_string($_POST['kodetiket']);
  $harga = $konek->real_escape_string($_POST['harga']);
  $jumlah = $konek->real_escape_string($_POST['jumlah']);
  if($action=='ubahjadwal')
  {
    $konek->query("UPDATE jadwal SET id_studio='$studio', id_film='$film', tanggal='$tanggal', jam_mulai='$tayang', jam_selesai='$selesai' WHERE id_jadwal='$kode'");
    $konek->query("UPDATE tiket SET id_jadwal='$kode', harga='$harga', stock='$jumlah' WHERE id_tiket='$kodetiket'");
  }else{
    $konek->query("INSERT INTO jadwal VALUES ('$kode','$studio','$film','$tanggal','$tayang','$selesai')");
    $konek->query("INSERT INTO tiket VALUES ('$kodetiket','$kode','$harga','$jumlah')");
  }
  echo "<script>window.location='index.php?req=jadwal';</script>";
}

?>