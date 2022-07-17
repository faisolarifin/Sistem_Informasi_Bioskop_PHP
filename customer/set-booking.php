<?php
	include_once ('../koneksi/koneksi.php');
	$req = $konek->real_escape_string($_GET['req']);


	if ($req=='jadwal')
	{
		$id = $konek->real_escape_string($_GET['film']);
		$tipe = $konek->real_escape_string($_GET['tipe']);
		$tanggal = $konek->real_escape_string($_GET['tanggal']);
		$data = array();
		$query = $konek->query("SELECT std.*, flm.*, jdw.*, tkt.* FROM studio std, film flm, jadwal jdw, tiket tkt WHERE std.id_studio=jdw.id_studio AND flm.id_film=jdw.id_film AND tkt.id_jadwal=jdw.id_jadwal AND (jdw.id_film='$id' AND std.jenis='$tipe' AND jdw.tanggal='$tanggal')");
		while($r=$query->fetch_object()){
			$data[] = $r;
		}
		echo json_encode($data);
	}
	elseif ($req=='kursi')
	{
		$id = $konek->real_escape_string($_GET['jadwal']);
		$data = array();
		$query = $konek->query("SELECT krs.*, jdw.id_jadwal, jdw.id_studio, tkt.id_tiket, tkt.harga, tkt.id_jadwal FROM kursi krs, jadwal jdw, tiket tkt WHERE krs.id_studio=jdw.id_studio AND tkt.id_jadwal=jdw.id_jadwal AND krs.id_kursi NOT IN (SELECT id_kursi FROM kursi_order WHERE id_tiket='$id') AND tkt.id_tiket='$id'");
		while($r=$query->fetch_object()){
			$data[] = $r;
		}
		echo json_encode($data);
	}
	elseif ($req=='film')
	{
		$id = $konek->real_escape_string($_GET['id']);
		$data = array();
		$query = $konek->query("SELECT jns.*, flm.* FROM jenis_film jns, film flm WHERE jns.id_jns=flm.id_jns AND (flm.id_film='$id')");
		while($r=$query->fetch_object()){
			$data[] = $r;
		}
		echo json_encode($data);
	}
	
?>