<?php
	include './koneksi/koneksi.php';
	include './koneksi/fungsi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="utf-8">
	<title>Register | SIKOP</title>
	<link rel="stylesheet" type="text/css" href="./assets/css/main-style.css">
</head>
<body>

	<section class="row">
		<div class="contrainer">
			<div class="register-member" style="background:#fff;margin-top: 7.8%;padding:30px;box-shadow: 0 -2px 5px -2px rgba(115,115,115,0.75),
                2px 0 5px -2px rgba(115,115,115,0.75);">
				<div class="divider">
					<h3>Registrasi Customer</h3>
					<img src="./assets/image/divider.png" alt="divider" height="8" width="220">
				</div>
				<div class="row-x guest-book">
					<form method="post">
						<table style="width:100%;">
							<tr>
								<td width="130"><label for="nama">Nama</label></td>
								<td><label for="nama">:</label></td>
								<td><input type="text" id="nama" name="nama"></td>
							</tr>
						
							<tr>
								<td><label for="jenis">Jenis Kelamin</label></td>
								<td><label for="jenis">:</label></td>
								<td>
									<select name="jenis" id="jenis">
										<option value=""> -- Pilih -- </option>
										<option value="L">Laki-Laki</option>
										<option value="P">Perempuan</option>
									</select>
								</td>
							</tr>
							<tr>
								<td><label for="email">Email</label></td>
								<td><label for="email">:</label></td>
								<td><input type="email" name="email"></td>
							</tr>
							<tr>
								<td><label for="password">Password</label></td>
								<td><label for="password">:</label></td>
								<td><input type="password" name="password" id="password"></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>
									<input type="submit" name="kirim" value="Daftar" class="red">
									<input type="reset" value="Reset" class="green">
								</td>
							</tr>
							<tr>
								<td colspan="3"><a href="index.php">Sudah punya akun ?</a></td>
							</tr>
						</table>
					</form>
				</div>
			</div>
		</div>
					
	</section>

</body>
</html>
<?php
	if (@$_POST['kirim'])
	{
	  $kode = autocode('id_user','user','USR');
	  $nama = $konek->real_escape_string($_POST['nama']);
	  $jenis = $konek->real_escape_string($_POST['jenis']);
	  $email = $konek->real_escape_string($_POST['email']);
	  $password = $konek->real_escape_string($_POST['password']);
	  $cek = $konek->query("SELECT * FROM user WHERE email='$email'");
	  if ($nama <> "" && $jenis <> "" && $email <> "" && $password <> "")
	  {
		if ($cek->num_rows > 0){
			  	echo "<script>
			  	 	 alert('Email telah terdaftar !');
				  </script>";
		  } else{
		  	$konek->query("INSERT INTO user VALUES ('$kode','$nama','$email','$jenis','$password','customer')");
		  	echo "<script>
		  	  alert('Selamat anda berhasil mendaftar !');
			  window.location='index.php';
		  </script>";
		  }
		} else {
	  	echo "<script>
	  	 	 alert('Masukkan data dengan benar !');
		  </script>";
	  	}
	  }
	  
?>