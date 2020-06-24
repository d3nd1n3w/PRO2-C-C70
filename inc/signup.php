<?php
include_once "../inc/koneksi.php";
include_once "../inc/library.php";

# JIKA PENYIMPANAN SUKSES
if(isset($_GET['Aksi']) and $_GET['Aksi']=="Sukses"){
	echo "<br><br><center> <b>SELAMAT, PENAFTARAN ANDA SUDAH KAMI TERIMA </b><br> Sekarang, Anda dapat login untuk melakukan pemesanan </center>";
	echo "<meta http-equiv='refresh' content='2; url='?open=Barang'>";

	exit;
}

# TOMBOL DAFTAR DIKLIK
if(isset($_POST['btnDaftar'])){
	// Baca Variabel Form
	$txtNama	= $_POST['txtNama'];
	$txtNama 	= str_replace("'","&acute;",$txtNama);
	
	$cmbKelamin	= $_POST['cmbKelamin'];
	$txtEmail	= $_POST['txtEmail'];
	$txtNoTelepon	= $_POST['txtNoTelepon'];
	
	$txtUsername	= $_POST['txtUsername'];
	$Alamat     	= $_POST['alamat'];
	$Kota   	    = $_POST['nm_kota'];
	$txtPassword_1	= $_POST['txtPassword_1'];
	$txtPassword_2	= $_POST['txtPassword_2'];

	// Validasi, jika data kosong kirimkan pesan error
	$pesanError = array();
	// if (trim($txtNama) =="") {
	// 	$pesanError[] = "Data <b>Nama Pelanggan</b> masih kosong";
	// }
	// if (trim($cmbKelamin) =="KOSONG") {
	// 	$pesanError[] = "Data <b>Jenis Kelamin</b> belum dipilih";
	// }
	// if (trim($txtEmail) =="") {
	// 	$pesanError[] = "Data <b>Alamat Email</b> masih kosong";
	// }
	// if (trim($txtNoTelepon) =="") {
	// 	$pesanError[] = "Data <b>No. Telepon</b> masih kosong";
	// }
	// if (trim($txtUsername) =="") {
	// 	$pesanError[] = "Data <b>Username</b> masih kosong";
	// }
	// if (trim($Alamat) =="") {
	// 	$pesanError[] = "Data <b>Alamat</b> masih kosong";
	// }
	// if (trim($Kota) =="") {
	// 	$pesanError[] = "Data <b>Kota</b> masih kosong";
	// }
	// if (trim($txtPassword_1) =="") {
	// 	$pesanError[] = "Data <b>Password</b> masih kosong";
	// }
if (trim($txtPassword_1) != trim($txtPassword_2)) {
		$pesanError[] = "Data <b>Password Ke 2</b> tidak sama dengan sebelumnya";
	}
	
	// Valiasii Username, tidak boleh ada yang kembar
	$sqlCek = "SELECT username,email FROM pelanggan WHERE username='$txtUsername' AND email='$txtEmail'";
	$qryCek = mysql_query($sqlCek, $koneksi) or die ("Gagal Cek");
	$adaCek = mysql_num_rows($qryCek);
	if($adaCek >= 1) {	
		echo "<script>alert('Username atau Email yang anda masukkan sudah terdaftar. Silahkan ganti input kembali');window.location='signup.php'</script>";
	}	

	
	# JIKA ADA PESAN ERROR DARI VALIDASI
	if (count($pesanError)>=1 ){
		echo "<script>alert('Password Ke 2 Tidak Sama');window.location='signup.php'</script>";
	}	
	else {
		# SIMPAN DATA KE DATABASE. Jika tidak menemukan pesan error, simpan data ke database
		$kodeBaru	= buatKode("pelanggan","P");
		$tanggal	= date('Y-m-d');
		$mySql	= "INSERT INTO pelanggan ( kd_pelanggan, username, password, nama_pelanggan, jk, email, telp, alamat,nm_kota) 
					VALUES ('$kodeBaru','$txtUsername',md5('$txtPassword_1'),'$txtNama', '$cmbKelamin', '$txtEmail', '$txtNoTelepon','$Alamat','$Kota')";
		$myQry	= mysql_query($mySql, $koneksi) or die ("Gagal query".mysql_error());
		if($myQry){
		 echo "<script>alert('Registrasi berhasil. Silahkan login');window.location='login.php'</script>";
		}
		exit;
	}	
} // End if($_POST) 


# BACA VARIABEL FORM
$dataNama		= isset($_POST['txtNama']) ? $_POST['txtNama'] : '';
$dataKelamin	= isset($_POST['cmbKelamin']) ? $_POST['cmbKelamin'] : 'Laki-laki';
$dataEmail		= isset($_POST['txtEmail']) ? $_POST['txtEmail'] : '';
$dataNoTelepon 	= isset($_POST['txtNoTelepon']) ? $_POST['txtNoTelepon'] : '';
$dataUsername	= isset($_POST['txtUsername']) ? $_POST['txtUsername'] : '';
$Alamat	        = isset($_POST['alamat']) ? $_POST['alamat'] : '';
$Kota           = isset($_POST['nm_kota']) ? $_POST['nm_kota'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Sparepart Sepeda Motor</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="../assets/daftar/images/icons/favicon.ico"/>
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../assets/daftar/vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../assets/daftar/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../assets/daftar/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../assets/daftar/fonts/iconic/css/material-design-iconic-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../assets/daftar/vendor/animate/animate.css">
	<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="../assets/daftar/vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../assets/daftar/vendor/animsition/css/animsition.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../assets/daftar/vendor/select2/select2.min.css">
	<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="../assets/daftar/vendor/daterangepicker/daterangepicker.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../assets/daftar/css/util.css">
	<link rel="stylesheet" type="text/css" href="../assets/daftar/css/main.css">
	<!--===============================================================================================-->
</head>
<body style="background-color: #999999;">
<form name="form1" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" target="_self" >
	<div class="limiter">
		<div class="container-login100">
			<div class="login100-more" style="background-image: url('../assets/daftar/images/regist.jpg');"></div>

			<div class="wrap-login100 p-l-50 p-r-50 p-t-72 p-b-50">

				<form class="login100-form validate-form">
					<span class="login100-form-title p-b-59">
						Daftar
					</span>

					<div class="wrap-input100 validate-input" data-validate="Name is required">
						<span class="label-input100">Nama Lengkap</span>
						<input class="input100" type="text" name="txtNama" type="text" value="<?php echo $dataNama; ?>" placeholder="Nama Lengkap"  required="required">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input">
						<span class="label-input100">Jenis Kelamin</span>

						<select name="cmbKelamin" class="form-control" data-validate="Name is required" required="required"> 
							<option value="">-- Jenis Kelamin --</option>
							<?php
							$pilihan = array("Laki-Laki", "Perempuan");
							foreach ($pilihan as $nilai) {
								if ($nilai == $dataKelamin) {
									$cek=" selected";
								} else { $cek = ""; }
								echo "<option value='$nilai' $cek>$nilai</option>";
							}
							?>
						</select>
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<span class="label-input100">Email</span>
						<input class="input100" name="txtEmail" type="email" value="<?php echo $dataEmail; ?>" placeholder="Email Lengkap"  required="required">
						<span class="focus-input100"></span>
					</div>		

					<div class="wrap-input100 validate-input" data-validate="No Telpon is required">
						<span class="label-input100">No Telpon</span>
						<input class="input100" name="txtNoTelepon" type="number" value="<?php echo $dataNoTelepon; ?>" placeholder="No Telpon"  required="required"></td>
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Alamat is required">
						<span class="label-input100">Alamat Lengkap</span>
						<textarea class="input100" name="alamat" placeholder="Alamat Lengkap"  required="required"></textarea>
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Kota is required">
						<span class="label-input100">Kota</span>
						<input class="input100" name="nm_kota" type="text" placeholder="Kota"  required="required" value="<?php echo $Kota;?>"/ >
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Username is required">
						<span class="label-input100">Username</span>
						<input class="input100" name="txtUsername" type="text" value="<?php echo $dataUsername; ?>" placeholder="Username"  required="required">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<span class="label-input100">Password</span>
						<input class="input100" name="txtPassword_1" type="password" placeholder="*************"  required="required">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password Ulang is required">
						<span class="label-input100">Password Ulang</span>
						<input class="input100" name="txtPassword_2" type="password" placeholder="*************"  required="required">
						<span class="focus-input100"></span>
					</div>

					<div class="flex-m w-full p-b-33">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me" required="required">
							<label class="label-checkbox100" for="ckb1">
								<span class="txt1">
									Saya Setuju Dengan Pendaftaran Ini
									</a>
								</span>
							</label>
						</div>


					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button type="submit" name="btnDaftar" value="Daftar" class="login100-form-btn" />
								Daftar
							</button>
						</div>

						<a href="login.php" class="dis-block txt3 hov1 p-r-30 p-t-10 p-b-10 p-l-30">
							Sign in
							<i class="fa fa-long-arrow-right m-l-5"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>

	<!--===============================================================================================-->
	<script src="../assets/daftar/vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
	<script src="../assets/daftar/vendor/animsition/js/animsition.min.js"></script>
	<!--===============================================================================================-->
	<script src="../assets/daftar/vendor/bootstrap/js/popper.js"></script>
	<script src="../assets/daftar/vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
	<script src="../assets/daftar/vendor/select2/select2.min.js"></script>
	<!--===============================================================================================-->
	<script src="../assets/daftar/vendor/daterangepicker/moment.min.js"></script>
	<script src="../assets/daftar/vendor/daterangepicker/daterangepicker.js"></script>
	<!--===============================================================================================-->
	<script src="../assets/daftar/vendor/countdowntime/countdowntime.js"></script>
	<!--===============================================================================================-->
	<script src="../assets/daftar/js/main.js"></script>

</body>
</html>
