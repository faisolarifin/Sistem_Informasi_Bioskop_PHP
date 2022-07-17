<?php
  session_start();
  include '../koneksi/koneksi.php';
  $id = $konek->real_escape_string($_GET['id']);
  if (!empty($_SESSION['id_user']) and $_SESSION['akses']=='customer') 
  {
?>
<!DOCTYPE html>
<html>
<head>
	<title>Unduh Tiket</title>
  	<style>
  		.row {
  			width: 100%;
  			min-height: 150px;
  			text-align: center;
  		}
  		.fullsized_image_holder {
  			display: inline-block;
  			padding: 10px;
  			margin: 10px;
  			box-shadow: 0 -2px 5px -2px rgba(115,115,115,0.75), 2px 0 5px -2px rgba(115,115,115,0.75);
  		}
  		.fullsized_image_holder a {
  			position: relative;
  			margin: 5px auto;
  			margin-top: 20px;
  			background-color: #168fc7;
  			padding: 10px 15px;
  			text-decoration: none;
  			border-radius: 10px;
  			color: #fff;
  			width: 130px;
  		}
  		.fullsized_image_holder * {
  			display: block;
  		}

  	</style>
</head>
<body>
	<div class="row">
    <?php
      $query = $konek->query("SELECT flm.judul_film, jdw.*, std.*, krs.*, tkt.harga, succ.* FROM film flm, jadwal jdw, studio std, kursi krs, tiket tkt, finish succ WHERE flm.id_film=jdw.id_film AND jdw.id_jadwal=succ.id_jadwal AND jdw.id_studio=std.id_studio AND krs.id_kursi=succ.id_kursi AND jdw.id_jadwal=tkt.id_jadwal AND succ.id_pesan='$id'");
      while($row=$query->fetch_object())
      {
    ?>
      <div class="fullsized_image_holder">
        <img class="gambar" src="../modul/generate-tiket.php?judul=<?= $row->judul_film; ?>&studio=<?= $row->nama_studio; ?>&tgl=<?= $row->tanggal; ?>&jam=<?= $row->jam_mulai; ?>&kursi=<?= $row->nama_kursi; ?>&harga=<?= $row->harga; ?>&kode=<?= $row->id_pesan; ?>&qrtext=<?= $row->qrcode_text; ?>" alt="hello">
        <a href="#" class="download" download>Unduh Gambar</a>
      </div>
    <?php
      }
    ?>
	<!-- jQuery -->
	<script src="../plugins/jquery/jquery.min.js"></script>
	<script>
	    $(function() {
	    	$('.download').on('click', function(){
	    		var gambar = $(this).parent('.fullsized_image_holder').find('img');
	    		$(this).attr('href', gambar.attr('src'));
	    	});
	    });
    </script>
</body>
</html>
<?php

 } else {

  echo "<script>
      alert('Silahkan login terlebih dahulu untuk mengakses halaman ini !');
      window.location = './login.php';
    </script>";

}

?>