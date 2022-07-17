<?php
$action = @htmlentities($_GET['act']);
if ($action=='ubahfilm')
{
  $kode = $konek->real_escape_string($_GET['id']);
  $query = $konek->query("SELECT * FROM film WHERE id_film='$kode'");
  $row = $query->fetch_object();
  $kode = $row->id_film;
}else{
  $kode = autocode('id_film','film','FLM');
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
              <li class="breadcrumb-item active">Tambah Film</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-10">
                    <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Tambah Kursi</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="" method="post" name="simpan" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="idFilm">ID Film</label>
                    <input type="text" class="form-control" id="idFilm" placeholder="ID Film" name="kode" value="<?= @$kode; ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label for="judulFilm">Judul Film</label>
                    <input type="text" class="form-control" id="judulFilm" placeholder="Judul Film" name="judul" value="<?= @$row->judul_film; ?>">
                  </div>
                  <div class="form-group">
                    <label for="jenisFilm">Jenis </label>
                    <select class="custom-select" id="jenisFilm" name="jenis">
                          <option value="">- Pilih -</option>
                          <?php 
                            $query = $konek->query("SELECT * FROM jenis_film");
                            while($r=$query->fetch_object()){
                          ?>
                            <option value="<?= $r->id_jns; ?>" <?= @$row->id_jns==$r->id_jns ? 'selected' : ''; ?>><?= $r->jns_film; ?></option>
                          <?php
                            }
                          ?>
                      </select>
                  </div>
                  <div class="form-group">
                    <label for="durasi">Durasi</label>
                    <div class="input-group date" id="durasi" data-target-input="nearest">
                      <input type="text" class="form-control datetimepicker-input" name="durasi" data-target="#durasi" value="<?= @$row->durasi; ?>" />
                      <div class="input-group-append" data-target="#durasi" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="far fa-clock"></i></div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                      <label>Deskripsi </label>
                      <textarea class="form-control" rows="3" name="deskripsi" placeholder="Deskripsi ..."><?= @$row->deskripsi; ?></textarea>
                  </div>
                  <div class="form-group">
                    <label for="customFile">Poster Film</label>
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="poster" id="customFile">
                      <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
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
  $user = $_SESSION['id_user'];
  $kode = $konek->real_escape_string($_POST['kode']);
  $judul = $konek->real_escape_string($_POST['judul']);
  $jenis = $konek->real_escape_string($_POST['jenis']);
  $durasi = $konek->real_escape_string($_POST['durasi']);
  $deskripsi = $konek->real_escape_string($_POST['deskripsi']);

  #image uplaoad processing
  $nama_img = substr(time(), 0, 4).$_FILES['poster']['name'];
  $img_tmp = $_FILES['poster']['tmp_name'];
  move_uploaded_file($img_tmp,'../upload/images/'.$nama_img);

  if($action=='ubahfilm')
  {
    $konek->query("UPDATE film SET id_jns='$jenis', judul_film='$judul', durasi='$durasi', deskripsi='$deskripsi' WHERE id_film='$kode'");
    if(!empty($_FILES['poster']['name']))
      {
        $q=$konek->query("SELECT gambar FROM film WHERE id_film='$kode'")->fetch_object();
        unlink("../upload/images/".$q->gambar);
        $konek->query("UPDATE film SET gambar='$nama_img' WHERE id_film='$kode'");
      }
  }else{
    $konek->query("INSERT INTO film VALUES ('$kode','$user','$jenis','$judul','$durasi','$deskripsi','$nama_img') ");
  }
  echo "<script>window.location='index.php?req=daftarfilm';</script>";
}

?>