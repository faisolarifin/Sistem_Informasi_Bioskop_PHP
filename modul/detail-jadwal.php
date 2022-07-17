<?php
include_once ('../koneksi/koneksi.php');

$id = $konek->real_escape_string($_GET['id']);

$query = $konek->query("SELECT flm.*, std.*, jdw.*, krs.id_studio, count(krs.nama_kursi) as kursi FROM film flm, studio std, kursi krs, jadwal jdw WHERE (flm.id_film=jdw.id_film AND std.id_studio=jdw.id_studio AND krs.id_studio=std.id_studio) AND id_jadwal='$id'");
$data = array();
while($row = $query->fetch_object()){
		$data[] = $row;
}

echo json_encode($data);

?>