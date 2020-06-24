<?php
if(empty($_SESSION['user'])) {
	echo "<center>";
	echo "<br> <br> <b>Maaf Akses Anda Ditolak!</b> <br>
		  Anda belum melakukan login, Untuk Membeli Sparepart Ini 
       Anda diharuskan untuk melakukan login terlebih dahulu. Apabila Anda belum 
      memiliki account, silahkan daftar disni <br> [ <a href='?page=registrasi' target='_self'><b>Pendaftaran Baru</b></a>]";
	echo "</center>";
	exit;
}
?>