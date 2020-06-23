<?php
ob_start();
@session_start();
include "inc/koneksi.php";

if(@$_SESSION['user']){
	header("location: index.php");
}else{
?>

<div id="isi">
	<div id="selamat_datang">
		<h1>SILAHKAN LOGIN</h1>
	</div>
			
	<div class="konten">
		<div class="garis"></div>
		<div class="jr"></div>
		<form action="" method="POST">
				<div>
					<input type="text" name="user" placeholder="username" class="lg" />
				</div>
				<div style="margin-top:10px;">
					<input type="password" name="pass" placeholder="password" class="lg" />
				</div>
				<div style="margin-top:10px;">
					<input type="submit" name="login" value="Login" class="btn" />
				</div>
			</form>

			<?php
			include "inc/koneksi.php";
			$user = @$_POST['user'];
			$pass = @$_POST['pass'];
			$login = @$_POST['login'];

			if($login) {
				if($user == "" || $pass == "") {
					?><script type="text/javascript">alert("username / password tidak boleh kosong");</script><?php
				} else {
					$sql = mysql_query("select * from pelanggan where username = '$user' and password = md5('$pass')") or die (mysql_error());
					$data = mysql_fetch_array($sql);
					$cek = mysql_num_rows($sql);
					if($cek >=1){
						@$_SESSION['user']=$data['kd_pelanggan'];
						echo "<script>window.alert('login berhasil');
						document.location = 'index.php';</script>";
						header("location: index.php");

					}else{
						echo "Kombinasi Salah";
					}
				}
			}
			
			?>
	</div>
</div>
<?php
}
?>