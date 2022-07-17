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
            <h1>Pesan Tiket</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Form Pesan</li>
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
                <h3 class="card-title">Pesan Tiket</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="" method="post" name="simpan">
                <div class="card-body">
                  <div class="form-group">
                    <label for="Film">Film</label>
                    <select class="form-control select2 masuk-film" id="Film" style="width: 100%;" name="film">
                      <option value="">- Pilih -</option>
                      <?php 
                          $query = $konek->query("SELECT * FROM film");
                          while($r=$query->fetch_object()){
                        ?>
                          <option value="<?= $r->id_film; ?>" <?= @$_GET['id']==$r->id_film ? 'selected' : ''; ?>><?= $r->judul_film; ?></option>
                        <?php
                          }
                        ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="Tipe">Tipe</label>
                    <select class="custom-select" id="Tipe" name="tipe">
                          <option value="">- Pilih -</option>
                          <option value="premium">Premium</option>
                          <option value="vip">VIP</option>
                      </select>
                  </div>
                  <div class="form-group">
                    <label for="Tanggal">Tanggal</label>
                    <input type="text" class="form-control datepicker" id="Tanggal" placeholder="Tanggal" name="tanggal">
                  </div>
                  <div id="set-jadwal"><!-- jadwal element --></div>
                 <div id="set-kursi"><!-- kursi element --></div>
                </div>               
                <!-- /.card-body -->
                <div class="card-footer">
                  <input type="submit" name="simpan" class="btn btn-primary" value=" <?= @$action=='' ? 'Pesan Tiket' : 'Ubah'; ?>">
                </div>
              </form>

            </div>
            <!-- /.card -->
        </div>
        <!-- right column -->
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Detail Film</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered">
                <tbody id="film-detail">
                
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
  $kode = autocode('id_pemesanan','temp_pesan','TMP');
  $user = $konek->real_escape_string($_SESSION['id_user']);
  $tiket = @$konek->real_escape_string($_POST['tiket']);
  
  if ($kode <> "" && $user <> "" && $tiket <> "" && @$_POST['kursi'] <> "")
  {
    $kursi = count($_POST['kursi']);
    $harga = $konek->query("SELECT harga FROM tiket WHERE id_tiket='$tiket'")->fetch_object();
    $total = $harga->harga * $kursi;
    $konek->query("INSERT INTO temp_pesan VALUES ('$kode','$user','$tiket',NOW(),'$kursi','$total')");
    foreach ($_POST['kursi'] as $r)
    {
      $konek->query("INSERT INTO temp_kursi VALUES ('$kode','".$konek->real_escape_string($r)."')");
    }
    echo "<script>window.location='index.php?req=checkout';</script>";
  } else {
    echo "<script>alert('masukkan isian dengan benar !');</script>";
  }

}
?>