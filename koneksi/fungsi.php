<?php
function autocode($column,$table,$prefix)
{
	global $konek;
	$result = $konek->query("SELECT MAX($column) AS maxKode FROM $table");
	$kode = $result->fetch_object();
	$noUrut = (int) substr($kode->maxKode, 3, 3);
	$noUrut++; 
	$id_ = $prefix. sprintf("%03s", $noUrut);
	return $id_;
}

function tanggalIndo($date){
	$BulanIndo = array("Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agt", "Sep", "Okt", "Nov", "Des");
 
	$tahun = substr($date, 0, 4);
	$bulan = substr($date, 5, 2);
	$tgl   = substr($date, 8, 2);
 
	$result = $tgl . "-" . $BulanIndo[(int)$bulan-1] . "-". $tahun;		
	return($result);
}

?>