<?php
	session_start();
	unset($_SESSION['id_user']);
	unset($_SESSION['akses']);
	session_destroy();
	echo "<script>
      alert('Anda berhasil keluar !');
      window.location = '../index.php';
    </script>";

?>