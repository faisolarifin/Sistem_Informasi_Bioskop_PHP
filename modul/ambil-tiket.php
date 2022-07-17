<?php
	include '../koneksi/koneksi.php';
	$qr = $konek->real_escape_string($_GET['qr']);
	$query = $konek->query("SELECT usr.nama, flm.judul_film, std.*, krs.*, jdw.id_studio, succ.* FROM user usr, film flm, studio std, kursi krs, jadwal jdw, finish succ WHERE usr.id_user=succ.id_user AND std.id_studio=jdw.id_studio AND krs.id_kursi=succ.id_kursi AND jdw.id_jadwal=succ.id_jadwal AND flm.id_film=jdw.id_film AND succ.qrcode_text='$qr'");
	$data = array();
	while($row=$query->fetch_object())
	{
		$data[] = $row;
	}
	echo json_encode($data);
	$konek->query("UPDATE finish SET status='1' WHERE qrcode_text='$qr'");
?>