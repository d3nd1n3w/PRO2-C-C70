<?php
ob_start();
@session_start();
include "../inc/koneksi.php";

if(@$_SESSION['user']){
	header("location: ../index.php");
}else{
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Sparepart Sepeda Motor</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="../assets/login/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../assets/login/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../assets/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../assets/login/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../assets/login/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="../assets/login/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../assets/login/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../assets/login/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="../assets/login/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../assets/login/css/util.css">
	<link rel="stylesheet" type="text/css" href="../assets/login/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	<form action="" method="POST">
	<div class="limiter">
		<div class="container-login100" style="background-image: url('../assets/login/images/bg-01.jpg');">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
				<form class="login100-form validate-form">
					<span class="login100-form-title p-b-49">
						Login
					</span>

					<div class="wrap-input100 validate-input m-b-23" data-validate = "Username is reauired">
						<span class="label-input100">Email</span>
						<input class="input100" type="text" name="email" placeholder="Masukkan Email">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<span class="label-input100">Password</span>
						<input class="input100" type="password" name="pass" placeholder="Masukkan Password">
						<span class="focus-input100" data-symbol="&#xf190;"></span>
					</div>
					
					<div class="text-right p-t-8 p-b-31"></div>
					
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button type="submit" name="login" value="Login" class="login100-form-btn" />
								Login
							</button>
						</div>
					</div>

					<?php
			include "koneksi.php";
			$email = @$_POST['email'];
			$pass = @$_POST['pass'];
			$login = @$_POST['login'];

			if($login) {
				if($email == "" || $pass == "") {
					?><script type="text/javascript">alert("Email / password tidak boleh kosong");</script><?php
				} else {
					$sql = mysql_query("select * from pelanggan where email = '$email' and password = md5('$pass')") or die (mysql_error());
					$data = mysql_fetch_array($sql);
					$cek = mysql_num_rows($sql);
					if($cek >=1){
						@$_SESSION['user']=$data['kd_pelanggan'];
						echo "<script>window.alert('login berhasil');
						document.location = 'index.php';</script>";
						header("location: ../index.php");

					}else{
						echo "<script>alert('Kombinasi Salah');window.location='login.php'</script>";
					}
				}
			}
			
			?>

					<div class="flex-col-c p-t-155">
						<span class="txt1 p-b-17">
							Belum Mempunyai Akun ?
						</span>

						<a href="signup.php" class="txt2">
							Daftar
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="../assets/login/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="../assets/login/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="../assets/login/vendor/bootstrap/js/popper.js"></script>
	<script src="../assets/login/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="../assets/login/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="../assets/login/vendor/daterangepicker/moment.min.js"></script>
	<script src="../assets/login/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="../assets/login/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="../assets/login/js/main.js"></script>

</body>
</html>
<?php } ?>