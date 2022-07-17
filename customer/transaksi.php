<?php
  if (!defined('AKSES')) {
    echo "DOCUMENT NOT ACCESS !";
    exit();
  }

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<?php

require_once dirname(__FILE__) . '/../midtrans-php-master/Midtrans.php';

//Set Your server key
\Midtrans\Config::$serverKey = "SB-Mid-server-wioNJmZpoUUIW0t4QQgA0l6g";

// Enable sanitization
\Midtrans\Config::$isSanitized = true;

// Enable 3D-Secure
\Midtrans\Config::$is3ds = true;

// Uncomment for production environment
\Midtrans\Config::$isProduction = false;   // false = sandbox
try {

  $user =  @$_SESSION['id_user'];
  $query = $konek->query("SELECT * FROM pesan WHERE id_user='$user'");
  while($order=$query->fetch_object()){

    $order_status_obj = \Midtrans\Transaction::status($order->id_pesan);
    $status = $order_status_obj->transaction_status;
    if ($status=='expire' && $order->status!='failure')
    {
      $konek->query("UPDATE pesan SET status='failure' WHERE id_pesan='$order->id_pesan'");
    }
    if ($status=='settlement' && $order->status!='success') 
    {
      $konek->query("UPDATE pesan SET status='success' WHERE id_pesan='$order->id_pesan'");
      $q = $konek->query("SELECT tkt.*, krs.* FROM tiket tkt, kursi_order krs WHERE tkt.id_tiket=krs.id_tiket AND krs.id_pesan='$order->id_pesan'");
      while($r=$q->fetch_object())
      {
        $kode = autocode('id_success','finish','SCC');
        $konek->query("INSERT INTO finish VALUES ('$kode', '$user', '$order->id_pesan', '$r->id_jadwal', '$r->id_kursi', now(), '$r->harga', '".$r->id_pesan.substr(time(), 3, 3)."', '0')");
      }
      $qry = $konek->query("SELECT * FROM tiket_order WHERE id_pesan='$order->id_pesan'");
      while($j=$qry->fetch_object()){
        $konek->query("UPDATE tiket SET stock= stock - $j->banyak WHERE id_tiket='$j->id_tiket'");
      }
    }

  }

}catch (Exception $e) {

  echo "<div class='alert alert-danger alert-dismissible'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
        <h5><i class='icon fas fa-exclamation-triangle'></i> Alert!</h5>
        Sistem ini terhubung dengan Payment Gateway. Sambungkan dengan internet ! <br>".$e->getMessage()."
      </div>";
}

?>

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Pemesanan Tiket</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Transaksi</li>
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
                  <th>Tgl Pesan</th>
                  <th>Tipe Pembayaran</th>
                  <th>Total</th>
                  <th width="100">Status</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                  $no=1;
                  $query = $konek->query("SELECT * FROM pesan WHERE id_user='$user' ORDER BY tgl_pesan DESC");
                  while ($row=$query->fetch_object()){
                 ?>
                  <tr>
                    <td><?= $no; ?></td>
                    <td><?= $row->id_pesan; ?></td>
                    <td><?= $row->tgl_pesan; ?></td>
                    <td><?= $row->payment_type; ?></td>
                    <td><?= $row->total; ?></td>
                    <td style="text-align:center;">
                      <span class="btn btn-block <?= ($row->status=='success') ? 'btn-success' : (($row->status=='pending') ? 'btn-warning' : (($row->status=='failure') ? 'btn-danger' : 'btn-danger')); ?> btn-sm"><?= ucfirst($row->status); ?></span>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="3">&nbsp;</td>
                    <td colspan="3" style="text-align:center;">
                      <?php 
                        if ($row->status!='failure' && $row->status!='success'){
                          echo "<a href='$row->pdf_url' target='_blank' title='Download Intruksi Pembayaran' class='btn btn-info btn-sm'><i class='fa fa-download'></i> Intruksi Bayar </a> ";
                        }
                        if ($row->status!='failure' && $row->status=='success'){  
                          echo "<a href='./unduh.php?id=$row->id_pesan' title='Unduh Tiket' class='btn btn-success btn-sm'><i class='fa fa-print'></i> Cetak Tiket </a> ";
                        }
                        if ($row->status!='failure' && $row->status!='success'){
                          echo "<a href='?req=transaksi&act=hapus&id=$row->id_pesan' title='Batalkan Pesan' class='btn btn-danger btn-sm'><i class='fa fa-trash'></i> Batalkan Pemesanan </a> ";
                          
                          }
                        ?>
                      <a href="?req=transdetail&id=<?= $row->id_pesan; ?>" title="Detail Data" class="btn btn-info btn-sm">Detail <i class="fa fa-share"></i></a>
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

<?php

$action = @htmlentities($_GET['act']);
if ($action=='hapus')
{
  $kode = $konek->real_escape_string($_GET['id']);
  $konek->query("DELETE FROM pesan WHERE id_pesan='$kode'");
  echo "<script>window.location='index.php?req=".$_GET['req']."'</script>";
}

?>