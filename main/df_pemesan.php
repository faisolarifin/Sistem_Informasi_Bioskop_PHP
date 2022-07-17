  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Aktifitas Pesan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Daftar Pemesan</li>
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
              Daftar Transaksi
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th style="width:10px;">#</th>
                  <th>ID Pesan</th>
                  <th>Nama</th>
                  <th>Tgl Pesan</th>
                  <th>Tipe Pembayaran</th>
                  <th>Total</th>
                  <th width="100">Status</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                  $no=1;
                  $query = $konek->query("SELECT usr.nama, psn.* FROM user usr, pesan psn WHERE usr.id_user=psn.id_user ORDER BY tgl_pesan DESC");
                  while ($row=$query->fetch_object()){
                 ?>
                  <tr>
                    <td><?= $no; ?></td>
                    <td><?= $row->id_pesan; ?></td>
                    <td><?= $row->nama; ?></td>
                    <td><?= $row->tgl_pesan; ?></td>
                    <td><?= $row->payment_type; ?></td>
                    <td><?= $row->total; ?></td>
                    <td style="text-align:center;">
                      <span class="btn btn-block <?= ($row->status=='success') ? 'btn-success' : (($row->status=='pending') ? 'btn-warning' : (($row->status=='failure') ? 'btn-danger' : 'btn-danger')); ?> btn-sm"><?= ucfirst($row->status); ?></span>
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