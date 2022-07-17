<?php
	include './koneksi/koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="utf-8">
	<title>Login | SIKOP</title>
	<link rel="stylesheet" type="text/css" href="./assets/css/main-style.css">
</head>
<body>
	<section class="row">
		<div class="contrainer" style="margin-top:10%;">	
			<div class="login-page">			
				<div class="login-customer" style="background:#fff;">
					<div class="img-please" style="background:#027a84;">
						<img src="./assets/image/silahkan.gif" alt="Silahkan Login">
					</div>
					<h2>Login Customer</h2>
					<form method="post" name="myForm">
						<input type="hidden" name="akses" value="customer">
						<input type="email" name="email" placeholder="Email" class="form transisi">
						<input type="password" name="password" placeholder="Password" class="form transisi"><br>
						<div class="login-chekbox">
							<span>
								<input type="checkbox" name="show" id="showpass1">
								<label for="showpass1">Tampilkan Sandi</label>
							</span>
							<span><a href="register.php">Belum Punya Akun ?</a></span>
						</div>
						
						<input type="submit" name="login" value="LOGIN">
					</form>
				</div>
			</div>

		</div>
	</section>
</body>
</html>


<?php
  if (@$_POST['login'])
  {
    $email = $konek->real_escape_string($_POST['email']);
    $password = $konek->real_escape_string($_POST['password']);  

    $query = $konek->query("SELECT * FROM user WHERE email='$email' AND password='$password'");
    if ($query->num_rows > 0) 
    {
      $row = $query->fetch_object();
      if ($row->hak_akses == 'customer')
      {
        session_start();
        $_SESSION['id_user'] = $row->id_user;
        $_SESSION['akses'] = $row->hak_akses;
        echo "<script>alert('Selamat anda berhasil login');
              window.location = './customer/index.php';
        </script>";
      } else {

        echo "<script>alert('Akun tidak ditemukan !'); </script>";
      }
    } else {

      echo "<script>alert('Username dan Password tidak benar !'); </script>";
    }
  }
?>