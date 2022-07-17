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

try {

  $user = $konek->real_escape_string($_SESSION['id_user']);
  $Qtot = $konek->query("SELECT SUM(total) as total FROM temp_pesan WHERE id_user='$user'")->fetch_object();
  $total = $Qtot->total;

  //pembeyaran melalui payment gateway
  // Required
  $transaction_details = array(
      'order_id' => rand(),
      'gross_amount' => $total, // no decimal allowed for creditcard
  );

  $item_details = array();
  $query = $konek->query("SELECT flm.*, tkt.*, jdw.*, tmp.* FROM film flm, tiket tkt, jadwal jdw, temp_pesan tmp WHERE tkt.id_jadwal=jdw.id_jadwal AND flm.id_film=jdw.id_film AND tkt.id_tiket=tmp.id_tiket");
  while ($row=$query->fetch_object()){
    $data = array(
      'id' => $row->id_tiket,
      'price' => $row->harga,
      'quantity' => $row->banyak,
      'name' => $row->judul_film
    );
    array_push($item_details, $data);
  }

  $customer_details = array();
  $query = $konek->query("SELECT * FROM user WHERE id_user='$user'");
  while($row=$query->fetch_object()){
    $customer_details['first_name'] = $row->nama;
    $customer_details['email'] = $row->email;
  }

  // Fill transaction details
  $transaction = array(
      // 'enabled_payments' => $enable_payments,
      'transaction_details' => $transaction_details,
      'customer_details' => $customer_details,
      'item_details' => $item_details,
  );
  if ($total > 0)
  {
    $snapToken = \Midtrans\Snap::getSnapToken($transaction);
  }

} catch (Exception $e) {
    
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
            <li class="breadcrumb-item active">Checkout</li>
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
              Detail Pesanan
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th style="width:10px;">#</th>
                  <th>Judul Film</th>
                  <th>Tanggal</th>
                  <th>Jam Tayang</th>
                  <th>Tanggal Pesan</th>
                  <th>Kursi</th>
                  <th>Total</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <?php
                if ($total > 0)
                  {  
                  echo "<tbody>";
           
                  $no=1;
                  $query = $konek->query("SELECT flm.*, tkt.*, jdw.*, tmp.* FROM film flm, tiket tkt, jadwal jdw, temp_pesan tmp WHERE tkt.id_jadwal=jdw.id_jadwal AND flm.id_film=jdw.id_film AND tkt.id_tiket=tmp.id_tiket");
                  while ($row=$query->fetch_object()){
                 ?>
                  <tr>
                    <td><?= $no; ?></td>
                    <td><?= $row->judul_film; ?></td>
                    <td><?= $row->tanggal; ?></td>
                    <td><?= substr($row->jam_mulai, 0, 5).' - '.substr($row->jam_selesai, 0, 5); ?></td>
                    <td><?= $row->tgl_pesan; ?></td>
                    <td>
                      <?php
                        $q = $konek->query("SELECT krs.*, tmp.* FROM kursi krs, temp_kursi tmp WHERE krs.id_kursi=tmp.id_kursi AND tmp.id_pemesanan='".$row->id_pemesanan."'");
                        while($r=$q->fetch_object())
                        {
                          echo '['.$r->nama_kursi.'] ';
                        }
                      ?>
                    </td>
                    <td><?= 'Rp. '.number_format($row->total); ?></td>
                    <td style="text-align:center;">
                      <a href="?req=<?= $_GET['req']; ?>&act=hapustemp&id=<?= $row->id_pemesanan; ?>" title="Hapus Data" class="btn btn-danger btn-sm"  onClick="return confirm('Yakin mau di hapus?');"><i class="fa fa-trash "></i> Hapus </a>
                    </td>
                  </tr>
                <?php 
                  $no++;
                  }
                ?>
                </tbody>
                <tfoot>
                  <tr>
                    <td colspan="6"></td>
                    <td>Rp. <?= number_format($total); ?>,-</td>
                    <td style="text-align:center;"><a href="#" title="Ubah Data" class="btn btn-block btn-success btn-sm" id="pay-button"> Checkout</a></td>
                  </tr>
                </tfoot>
                <?php
                  } else {
                    echo "<tr><td colspan='8'><center> Tidak ada film tiket yang dipesan </center></td></tr>";
                  }
                ?>
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
if ($action=='hapustemp')
{
  $kode = $konek->real_escape_string($_GET['id']);
  $konek->query("DELETE FROM temp_kursi WHERE id_pemesanan='$kode'");
  $konek->query("DELETE FROM temp_pesan WHERE id_pemesanan='$kode'");
  echo "<script>window.location='index.php?req=".$_GET['req']."'</script>";
}
  
?>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-kaVkKtisAfYXRzpW"></script>
<script type="text/javascript">
    document.getElementById('pay-button').onclick = function(){
        // SnapToken acquired from previous step
        snap.pay('<?php echo $snapToken; ?>', {
            // Optional
            onSuccess: function(result){
                let data = JSON.stringify(result, null, 2);
                data = JSON.parse(data);
            },
            // Optional
            onPending: function(result){
                let hasil = JSON.stringify(result, null, 2);
                console.log(hasil);
                $.ajax({
                    type: 'POST',
                    dataType : 'json',
                    url: "../modul/checkout.php",
                    data : {myData:hasil},
                    success: function(respons) {
                      console.log(respons);
                    },
                    error : function(res){
                      console.log(res);
                      alert('Checkout berhasil, Silahkan untuk melakukan pembeyaran');
                      window.location.href = '?req=transaksi';
                    }
                });
            },
            // Optional
            onError: function(result){
                let data = JSON.stringify(result, null, 2);
                data = JSON.parse(data);

            }
        });
    };
</script>