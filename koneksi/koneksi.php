<?php
$server = "localhost";
$user = "root";
$password = "";
$database = "tiket_bioskop";

$konek = new mysqli($server,$user,$password,$database);

if (!$konek){
	echo "Koneksi ke Database Server Bermasalah !";
}

?>