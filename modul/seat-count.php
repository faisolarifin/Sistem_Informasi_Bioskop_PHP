<?php
	include '../koneksi/koneksi.php';

	$id = $konek->real_escape_string($_GET['id_studio']);
	$data = array();
	$query = $konek->query("SELECT count(id_kursi) as banyak FROM kursi WHERE id_studio='$id'");
	$data[] = $query->fetch_object();
	echo json_encode($data);
?>