<?php
	session_start();
	include_once ('../koneksi/koneksi.php');

	$row = json_decode($_POST['myData']);
	$id_pesan = $konek->real_escape_string($row->order_id);
	$id_user = @$_SESSION['id_user'];
	$tgl_pesan = $konek->real_escape_string($row->transaction_time);
	$total = $konek->real_escape_string($row->gross_amount);
	$tipe_bayar = $konek->real_escape_string($row->payment_type);
	$pdf = $konek->real_escape_string($row->pdf_url);
	$status = $konek->real_escape_string($row->transaction_status);

	$query = $konek->query("INSERT INTO pesan VALUES('$id_pesan','$id_user','$tgl_pesan','$total','$tipe_bayar','$pdf','$status')");
	if ($query)
	{
		$qry = $konek->query("SELECT * FROM temp_pesan WHERE id_user='$id_user'");
		while($r=$qry->fetch_object())
		{
			$konek->query("INSERT INTO tiket_order VALUES ('$id_pesan','$r->id_tiket','$r->banyak','$r->total')");
			$kursi = $konek->query("SELECT id_kursi FROM temp_kursi WHERE id_pemesanan='$r->id_pemesanan'");
			while($kur=$kursi->fetch_object())
			{
				$konek->query("INSERT INTO kursi_order VALUES ('$id_pesan','$r->id_tiket','$kur->id_kursi')");
			}
		}

		//hapus temporary pemesanan
		$temp = $konek->query("SELECT id_pemesanan FROM temp_pesan WHERE id_user='$id_user'");
		while($r=$temp->fetch_object())
		{
			$konek->query("DELETE FROM temp_kursi WHERE id_pemesanan='$r->id_pemesanan'");
		}
		$konek->query("DELETE FROM temp_pesan WHERE id_user='$id_user'");

	} else {
		echo "Transaksi Gagal";

	}

	
?>