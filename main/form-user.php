<?php
$action = @htmlentities($_GET['act']);
if ($action=='ubahuser')
{
  $kode = $konek->real_escape_string($_GET['id']);
  $query = $konek->query("SELECT * FROM user WHERE id_user='$kode'");
  $row = $query->fetch_object();
  $kode = $row->id_user;
}else{
  $kode = autocode('id_user','user','USR');
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
              <li class="breadcrumb-item active">Tambah User</li>
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
                <h3 class="card-title">Tambah User</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="" method="post" name="simpan">
                <div class="card-body">
                  <div class="form-group">
                    <label for="idUser">ID User</label>
                    <input type="text" class="form-control" id="idUser" placeholder="ID User" name="kode" value="<?= @$kode; ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" id="nama" placeholder="Nama" name="nama" value="<?= @$row->nama; ?>">
                  </div>
                  <div class="form-group">
                    <label for="email">E-Mail</label>
                    <input type="email" class="form-control" id="email" placeholder="Email" name="email" value="<?= @$row->email; ?>">
                  </div>
                  <div class="form-group">
                    <label for="gender">Jenis Kelamin</label>
                    <select class="custom-select" id="gender" name="gender">
                          <option value="">- Pilih -</option>
                          <option value="L" <?= @$row->jenis_kelamin=='L' ? 'selected' : ''; ?>>Laki-Laki</option>
                          <option value="P" <?= @$row->jenis_kelamin=='P' ? 'selected' : ''; ?>>Perempuan</option>
                      </select>
                  </div>
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Password" name="password" value="<?= @$row->password; ?>">
                  </div>
                  <div class="form-group">
                    <label for="Akses">Hak Akses :</label>
                    <select class="custom-select" id="Akses" name="akses">
                          <option value="">- Pilih -</option>
                          <option value="admin" <?= @$row->hak_akses=='admin' ? 'selected' : ''; ?>>Admin</option>
                          <option value="penjualan" <?= @$row->hak_akses=='penjualan' ? 'selected' : ''; ?>>Penjualan</option>
                          <option value="petugas" <?= @$row->hak_akses=='petugas' ? 'selected' : ''; ?>>Petugas</option>
                          <option value="customer" <?= @$row->hak_akses=='customer' ? 'selected' : ''; ?>>Customer</option>
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
  $email = $konek->real_escape_string($_POST['email']);
  $gender = $konek->real_escape_string($_POST['gender']);
  $pass = $konek->real_escape_string($_POST['password']);
  $akses = $konek->real_escape_string($_POST['akses']);
  if($action=='ubahuser')
  {
    $konek->query("UPDATE user SET nama='$nama', email='$email', jenis_kelamin='$gender', password='$pass', hak_akses='$akses' WHERE id_user='$kode'");
  }else{
    $konek->query("INSERT INTO user VALUES ('$kode','$nama','$email','$gender','$pass','$akses')");
  }
  echo "<script>window.location='index.php?req=mainuser';</script>";
}

?>