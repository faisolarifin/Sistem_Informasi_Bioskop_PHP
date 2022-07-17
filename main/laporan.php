  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Laporan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Laporan</li>
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
          <form rele="form" method="post" name="simpan">
            <div class="card">
              <div class="card-header">
                Laporan Penjualan
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="Awal">Tanggal Awal</label>
                        <input type="text" class="form-control datepicker" id="Awal" placeholder="Tanggal Awal" name="awal">
                      </div>
                    </div>
                    <!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="Akhir">Tanggal Awal</label>
                        <input type="text" class="form-control datepicker" id="Akhir" placeholder="Tanggal Akhir" name="akhir">
                      </div>
                    </div>
                  </div>
                
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <input type="submit" name="simpan" class="btn btn-primary" value="Lihat">
              </div>
            </form>
          </div>
          <!-- /.card -->
          <?php 
          if (@$_POST['simpan']) {
            $tgl_awal = $konek->real_escape_string(@$_POST['awal']);
            $tgl_akhir = $konek->real_escape_string(@$_POST['akhir']);
            if ($tgl_awal <> "" && $tgl_akhir <> "") {
          ?>
          <div class='card'>
            <div class='card-header'>Laporan dari <?= tanggalIndo($tgl_awal); ?> Sampai <?= tanggalIndo($tgl_akhir); ?> </div>
            <div class='card-body'>
              <div class="card-body">
              <table class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th style='width:10px;'>No.</th>
                  <th>Tanggal</th>
                  <th>ID Pesan</th>
                  <th>Customer</th>
                  <th>Total</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                  $no=1;
                  
                  $query = $konek->query("SELECT * FROM finish WHERE tanggal BETWEEN '$tgl_awal' AND '$tgl_akhir'");
                  while ($row=$query->fetch_object()){
                 ?>
                  <tr>
                    <td><?= $no; ?></td>
                    <td><?= $row->tanggal; ?></td>
                    <td><?= $row->id_pesan; ?></td>
                    <td><?= $row->id_user; ?></td>
                    <td><?= 'Rp. '.number_format($row->total_harga); ?></td>
                  </tr>
                <?php 
                  $no++;
                  }
                ?>
                <tr>
                  <td colspan="3">&nbsp;</td>
                  <td>Jumlah Total :</td>
                  <td><?= 'Rp. '.number_format($konek->query("SELECT sum(total_harga) as total FROM finish  WHERE tanggal BETWEEN '$tgl_awal' AND '$tgl_akhir'")->fetch_object()->total); ?></td>
                </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <?php
           } 
          } 
        ?>
      </div>
    </div>
  </section>
</div>