<?php
include_once "koneksi.php";
include_once "library.php";




# SAAT TOMBOL KIRIM DIKLIK
if(isset($_POST['btnKirim'])){
	// Baca variabel form
	$txtNoPemesanan	= $_POST['txtNoPemesanan'];
	$txtNoPemesanan 		= str_replace("'","&acute;",$txtNoPemesanan);
	
	$txtNama		= $_POST['txtNama'];
	$txtNama 		= str_replace("'","&acute;",$txtNama);
	
	$txtJumlahTransfer		= $_POST['txtJumlahTransfer'];
	$txtJumlahTransfer 		= str_replace(".","",$txtJumlahTransfer); // Menghilangkan karakter titik (10.000 jadi 10000)
	$txtJumlahTransfer 		= str_replace(",","",$txtJumlahTransfer); // Menghilangkan karakter koma (10,000 jadi 10000)
	$txtJumlahTransfer 		= str_replace(" ","",$txtJumlahTransfer); // Menghilangkan karakter kosong (10 000 jadi 10000)
	
	$txtKeterangan	= $_POST['txtKeterangan'];
	$txtKeterangan 	= str_replace("'","&acute;",$txtKeterangan);
	
	$txtGambar	= $_POST['txtGambar'];
	$txtGambar 	= str_replace("'","&acute;",$txtGambar);
	
	// Validasi form
	// $pesanError = array();
	// if (trim($txtNoPemesanan)=="") {
	// 	$pesanError[] = "Data <b>No. Pemesanan</b>  masih kosong, isi sesuai dengan <b>No Pemesanan</b> Anda";
	// }
	// if (trim($txtNama)=="") {
	// 	$pesanError[] = "Data <b>Nama Penerima</b>  masih kosong, isi sesuai nama akun Anda";
	// }
	// if (trim($txtJumlahTransfer)=="" or ! is_numeric(trim($txtJumlahTransfer))) {
	// 	$pesanError[] = "Data <b> Jumlah Ditransfer (Rp)</b> masih kosong, dan <b> harus ditulis angka </b>";
	// }
	// if (trim($txtKeterangan)=="") {
	// 	$pesanError[] = "Data <b> Keterangan </b> masih kosong";
	// }
	
	// if (trim($txtGambar)=="") {
	// 	$pesanError[] = "Data <b> Gambar </b> masih kosong";
	// }

	# JIKA ADA PESAN ERROR DARI VALIDASI
	if (count($pesanError)>=1 ){
		echo "<div class='pesanError' align='left'>";
		echo "<img src='images/attention.png'> <br><hr>";
		$noPesan=0;
		foreach ($pesanError as $indeks=>$pesan_tampil) { 
			$noPesan++;
			echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";	
		} 
		echo "<br>"; 
	}
	else {
		# SIMPAN DATA KE DATABASE. Jika tidak menemukan pesan error, simpan data ke database
		// Membuat tanggal
		$tanggal	= date('Y-m-d');
		
		// Simpan data ke database
		$mySql = "INSERT INTO konfirmasi (id_order, nm_pelanggan, jml_tf, ket, tgl,gambar) 
		VALUES ('$txtNoPemesanan', '$txtNama', '$txtJumlahTransfer', '$txtKeterangan', '$tanggal','$txtGambar')";
		$myQry	= mysql_query($mySql, $koneksi) or die ("Gagal query".mysql_error());
		
		echo "<script>alert(' KONFIRMASI SUDAH DIKIRIM');window.location='../index.php'</script>";
		echo "<meta http-equiv='refresh' content='2; url=../index.php'>";
		exit;
	}	
} // End if($_POST) 


# REKAM DATA JIKA KOSONG FORM
$dataPesan	= isset($_POST['cmbPesan']) ? $_POST['cmbPesan'] : '';
$dataNama			= isset($_POST['txtNama']) ? $_POST['txtNama'] : '';
$dataJumlahTransfer	= isset($_POST['txtJumlahTransfer']) ? $_POST['txtJumlahTransfer'] : '';
$dataKeterangan 	= isset($_POST['txtKeterangan']) ? $_POST['txtKeterangan'] : '';
$dataGambar	= isset($_POST['txtGambar']) ? $_POST['txtGambar'] : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Sparepart Sepeda Motor</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">

	<link rel="stylesheet" href="../assets/css/open-iconic-bootstrap.min.css">
	<link rel="stylesheet" href="../assets/css/animate.css">

	<link rel="stylesheet" href="../assets/css/owl.carousel.min.css">
	<link rel="stylesheet" href="../assets/css/owl.theme.default.min.css">
	<link rel="stylesheet" href="../assets/css/magnific-popup.css">

	<link rel="stylesheet" href="../assets/css/aos.css">

	<link rel="stylesheet" href="../assets/css/ionicons.min.css">

	<link rel="stylesheet" href="../assets/css/bootstrap-datepicker.css">
	<link rel="stylesheet" href="../assets/css/jquery.timepicker.css">


	<link rel="stylesheet" href="../assets/css/flaticon.css">
	<link rel="stylesheet" href="../assets/css/icomoon.css">
	<link rel="stylesheet" href="../assets/css/style.css">
</head>

<?php include 'header.php'; ?>
<?php include 'navbar.php'; ?>
<?php include 'sidebar.php'; ?>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1"  target="_self">
<section class="ftco-section">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-xl-10 ftco-animate">
				<form action="#" class="billing-form">

					<h3 class="mb-4 billing-heading">Konfirmasi Pembayaran</h3>
					<div class="row align-items-end">
						<div class="col-md-6">
							<form class="login100-form validate-form">


 <div class="form-group" data-validate="No is required">
									<label>No. Pemesanan</label>
									<select name="cmbPesan" class="form-control" required="required">
									<option value="">-- No Pemesanan --</option>
										<?php
		$comboSql = "SELECT * FROM orderan ORDER BY id_order ASC";
		$comboQry = mysql_query($comboSql, $koneksi) or die ("Gagal query".mysql_error());
		while ($comboData =mysql_fetch_array($comboQry)) {
			if ($comboData['id_order']==$dataPesan) {
				$cek="selected";
			}
			else {
				$cek="";
			}
			echo "<option value='$comboData[id_order]' $cek>$comboData[id_order]</option>";
		}
		?>
									</select>
								</div>
							</div>




      <!-- <div class="form-group" data-validate="No is required">
									<label>No. Pemesanan</label>
        <select name="cmbPesan" data-validate="Name is required" class="form-control" required="required">
          <option value="">-- No Pemesanan --</option>
          <?php
		$comboSql = "SELECT * FROM orderan ORDER BY id_order ASC";
		$comboQry = mysql_query($comboSql, $koneksi) or die ("Gagal query".mysql_error());
		while ($comboData =mysql_fetch_array($comboQry)) {
			if ($comboData['id_order']==$dataPesan) {
				$cek="selected";
			}
			else {
				$cek="";
			}
			echo "<option value='$comboData[id_order]' $cek>$comboData[id_order]</option>";
		}
		?>
        </select>
      </div></td>
								</div>
							</div> -->



						

									<!-- <label>No. Pemesanan</label>
									<input name="txtNoPemesanan" type="text" class="form-control" value="<?php echo $dataNoPemesanan; ?>" placeholder="Silahkan input No Pemesanan" required="required">
								</div>
							</div> -->
							<div class="col-md-6">
								<div class="form-group" data-validate="Name is required">
									<label>Nama Pelanggan</label>
									<input name="txtNama" type="text" class="form-control" value="<?php echo $dataNama; ?>" placeholder="Silahkan Input Nama Pelanggan" required="required">
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group" data-validate="Jumlah is required">
									<label>Jumlah Transfer (Rp.)</label>
									<input name="txtJumlahTransfer" type="number" class="form-control" value="<?php echo $dataJumlahTransfer; ?>" placeholder="Input Jumlah transfer" required="required">
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group" data-validate="Ket is required">
									<label>Keterangan</label>
									<textarea name="txtKeterangan" type="textarea"  class="form-control" placeholder="Input Keterangan" required="required"><?php echo $dataKeterangan; ?></textarea></td>
								</div>
							</div>


							<div class="col-md-6">
								<div class="form-group">
									<label for="gambar">Upload Bukti Pembayaran</label>
									<input name="txtGambar" type="file" required="required"/>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-12">
									<div class="checkbox">
										<p><input type="submit" name="btnKirim" class="btn btn-primary py-3 px-4" value=" Kirim "></a></p>
										<td colspan="3"><b>Catatan:</b><br/>
											Silahkan cek kembali <b>No. Pemesanan</b>, Jika ada pertanyaan <b>Silahkan hubungi kontak yang tersedia</b>.</td>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</form><!-- END -->




	<?php include 'footer.php'; ?>
	<script src="../assets/js/jquery.min.js"></script>
	<script src="../assets/js/jquery-migrate-3.0.1.min.js"></script>
	<script src="../assets/js/popper.min.js"></script>
	<script src="../assets/js/bootstrap.min.js"></script>
	<script src="../assets/js/jquery.easing.1.3.js"></script>
	<script src="../assets/js/jquery.waypoints.min.js"></script>
	<script src="../assets/js/jquery.stellar.min.js"></script>
	<script src="../assets/js/owl.carousel.min.js"></script>
	<script src="../assets/js/jquery.magnific-popup.min.js"></script>
	<script src="../assets/js/aos.js"></script>
	<script src="../assets/js/jquery.animateNumber.min.js"></script>
	<script src="../assets/js/bootstrap-datepicker.js"></script>
	<script src="../assets/js/scrollax.min.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
	<script src="../assets/js/google-map.js"></script>
	<script src="../assets/js/main.js"></script>

	</html>