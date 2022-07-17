<?php
	include "../php-qrcode/qrlib.php";

	header("Content-type: image/png");
	header('Content-Disposition: attachment; filename="tiket render.png"');

	function tiket_png($judul,$studio,$tgl,$jam,$kursi,$harga,$kode,$isi){

		$tempdir = "temp/";
		if (!file_exists($tempdir))
		    mkdir($tempdir);

		#parameter inputan
		$namagambar = "coba.png";
		$quality = 'H'; //ada 4 pilihan, L (Low), M(Medium), Q(Good), H(High)
		$ukuran = 12; //batasan 1 paling kecil, 10 paling besar
		$padding = 0;
		 
		QRCode::png($isi,$tempdir.$namagambar,$quality,$ukuran,$padding);

		$src = imagecreatefrompng('./temp/'.$namagambar);

		$im = @imagecreate(470, 550) or die("Cannot Initialize new GD image stream");

		$background_color = imagecolorallocate($im, 255, 255, 255);    // putih
		$black = imagecolorallocate($im, 0, 0, 0);                  // hitam

		imagecopyresized($im, $src, 60, 140, 0, 0, 350, 350, 256, 256);
		imagestring($im, 7, 90, 20,  substr($judul, 0, 30).'..', $black);
		imagestring($im, 7, 40, 50,  "STUDIO : ".$studio, $black);
		imagestring($im, 7, 40, 75,  "TANGGAL : ".$tgl, $black);
		imagestring($im, 7, 40, 100,  "JAM : ".substr($jam, 0, 5), $black);
		imagestring($im, 7, 260, 50,  "KURSI : ".$kursi, $black);
		imagestring($im, 7, 260, 75,  "HARGA : Rp.".number_format($harga), $black);
		imagestring($im, 7, 140, 500,  "KODE PESAN ".$kode, $black);
		imagestring($im, 3, 8, 540,  "- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - ", $black);

		imagepng($im);
		imagedestroy($im);
	}
	
	$judul = $_GET['judul'];
	$studio = $_GET['studio'];
	$tgl = $_GET['tgl'];
	$jam = $_GET['jam'];
	$kursi = $_GET['kursi'];
	$harga = $_GET['harga'];
	$kode = $_GET['kode'];
	$image = $_GET['qrtext'];

	tiket_png($judul, $studio, $tgl, $jam, $kursi, $harga, $kode, $image);

?>