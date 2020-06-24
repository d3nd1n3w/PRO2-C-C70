<?php
session_start();
include_once "session.php";
include_once "koneksi.php";
include_once "library.php";
 
// Baca Kode Pelanggan yang Login
$KodePelanggan	= $_SESSION['user'];

# MEMERIKSA DATA DALAM KERANJANG
$cekSql = "SELECT * FROM keranjang WHERE  kd_pelanggan='$KodePelanggan'";
$cekQry = mysql_query($cekSql, $koneksi) or die (mysql_error());
$cekQty = mysql_num_rows($cekQry);
if($cekQty < 1){
	echo "<br><br>";
	echo "<center>";
	echo "<b> BELUM ADA TRANSAKSI </b>";
	echo "<center>";
	
	// Jika Keranjang masih Kosong, maka halaman Refresh ke data Barang
	echo "<meta http-equiv='refresh' content='2; url=barang.php'>";
	exit;
}

# SAAT TOMBOL SIMPAN DIKLIK, Masuk ke proses simpan data
if(isset($_POST['btnSimpan'])){
	# Baca Variabel Form
	$txtNama	= $_POST['txtNama'];
	$txtNama	= str_replace("'","&acute;",$txtNama);
		
	$txtAlamat	= $_POST['txtAlamat'];
	$txtAlamat	= str_replace("'","&acute;",$txtAlamat);
	
	$cmbKota= $_POST['cmbKota'];

	$txtPos		= $_POST['txtPos'];
	$txtPos		= str_replace("'","&acute;",$txtPos);
	
	$txtNoTelp	= $_POST['txtNoTelp'];
	$txtNoTelp	= str_replace("'","&acute;",$txtNoTelp);
	
	$txtKeterangan	= $_POST['txtKeterangan'];
	$txtKeterangan  = str_replace("'","&acute;",$txtKeterangan);
	
	// Validasi, jika data kosong kirimkan pemesanan error
	// $pesanError = array();
	// if (trim($txtNama) =="") {
	// 	$pesanError[] = "Data <b>Nama Penerima</b> masih kosong";
	// }
	// if (trim($txtAlamat) =="") {
	// 	$pesanError[] = "Data <b>Alamat Tujuan Pengiriman</b> masih kosong";
	// }
	// if (trim($cmbKota) =="KOSONG") {
	// 	$pesanError[] =  "Data <b>Provinsi Pengiriman</b> belum dipilih";
	// }
	// if (trim($txtPos) =="") {
	// 	$pesanError[] = "Data <b>Kode Pos</b> masih kosong";
	// }
	// if (trim($txtNoTelp) =="") {
	// 	$pesanError[] = "Data <b>No. Telepon</b> masih kosong";
	// }
	// if (trim($txtKeterangan) =="") {
	// 	$pesanError[] = "Data <b>Keterangan</b> masih kosong";
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
		echo " <br>"; 
	}
	else {
		# SIMPAN DATA KE DATABASE. Jika tidak menemukan pesan error, simpan data ke database
		$KodePemesanan	= buatKode("orderan", "PS");
		$tanggal		= date('Y-m-d');
		
		# SIMPAN DATA IDENTITAS PENGIRIMAN KE DATABASE
		$mySql	= "INSERT INTO orderan (id_order,kd_pelanggan,nama_pelanggan,tgl,nm_kota,alamat,pos,telp)
					VALUES('$KodePemesanan','$KodePelanggan',  '$txtNama','$tanggal','$cmbKota', '$txtAlamat', '$txtPos', '$txtNoTelp')";
		$myQry	= mysql_query($mySql, $koneksi) or die ("Gagal query 1".mysql_error());
		if($myQry){
			// Membaca data dari TMP (Kantong belanja)
			$bacaSql	= "SELECT * FROM keranjang WHERE kd_pelanggan='$KodePelanggan'";
			$bacaQry	= mysql_query($bacaSql, $koneksi) or die ("Gagal query 2".mysql_error());
			while ($bacaData = mysql_fetch_array($bacaQry)) {
				// Simpan data dari Keranjang belanja ke Pemesanan_Item
				$Kode 	= $bacaData['kd_barang'];
				$Harga	= $bacaData['harga'];
				$Jumlah	= $bacaData['jumlah'];
				
				$simpanSql="INSERT INTO detail_order(id_order, kd_barang, harga, jumlah) 
							VALUES('$KodePemesanan', '$Kode', '$Harga', '$Jumlah')";
				mysql_query($simpanSql,$koneksi);
			}
			
			// Kosongkan data Keranjang milik Pelanggan 
			$hapusSql	= "DELETE FROM keranjang WHERE kd_pelanggan='$KodePelanggan'";
			mysql_query($hapusSql,$koneksi) or die ("Gagal query hapus keranjang".mysql_error());
			
			// Refresh
      echo "<script>alert('TRANSAKSI SELESAI. SEGERA MELANJUTKAN PEMBAYARAN');window.location='rekening.php'</script>";
      echo "<meta http-equiv='refresh' content='2; url=rekening.php'>";
			
		}
		exit;
	}	
} // End if($_POST) 

# MEMBACA DATA DARI FORM, untuk ditampilkan kembali pada form
$dataNama	= isset($_POST['txtNama']) ? $_POST['txtNama'] : '';
$dataAlamat	= isset($_POST['txtAlamat']) ? $_POST['txtAlamat'] : '';
$dataProvinsi	= isset($_POST['cmbKota']) ? $_POST['cmbKota'] : '';
$dataPos	= isset($_POST['txtPos']) ? $_POST['txtPos'] : '';
$dataNoTelp =  isset($_POST['txtNoTelp']) ? $_POST['txtNoTelp'] : '';
$dataKeterangan =  isset($_POST['txtKeterangan']) ? $_POST['txtKeterangan'] : '';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
   <title>Sparepart Sepeda Motor</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">

    <link rel="stylesheet" href="../assets/css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
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
  <body class="goto-here">
<?php include 'header.php'; ?>
<?php include 'navbar.php'; ?>
<?php include 'sidebar.php'; ?>

<section class="ftco-section bg-light">
            <div class="container">
                      <div class="row justify-content-center mb-3 pb-3">
              <h1 align="center"><strong>KONFIRMASI BELANJA</strong></h1>

<section class="ftco-section ftco-cart">
      <div class="container">
        <div class="row">
          <div class="col-md-12 ftco-animate">
            <div class="cart-list">
              <table class="table">
                <thead class="thead-primary">
                  <tr class="text-center">
                    <th>No.</th>
                    <th>Nama Barang</th>
                    <th>Harga (Rp.)</th>
                    <th>Jumlah</th>
                    <th>Total (Rp.)</th>
                  </tr>
  <?php
  	// buat variabel data
	$subTotal	= 0;
	$totalHarga	= 0;
	$totalBarang = 0;
	
  // Menampilkan daftar barang yang sudah dipilih (ada d Keranjang)
	$mySql = "SELECT barang.nm_barang, keranjang.*
			FROM keranjang
			LEFT JOIN barang ON keranjang.kd_barang=barang.kd_barang
			WHERE barang.kd_barang=keranjang.kd_barang AND keranjang.kd_pelanggan='$KodePelanggan' 
			ORDER BY keranjang.kd_keranjang";
	$myQry = mysql_query($mySql, $koneksi) or die ("Gagal SQL".mysql_error());
	$nomor	= 0;
	while ($myData = mysql_fetch_array($myQry)) {
	  $nomor++;
	  // Mendapatkan total harga (harga * jumlah)
	  $subTotal= $myData['harga'] * $myData['jumlah']; 
	  
	  // Mendapatkan total harga  dari seluruh  barang
	  $totalHarga = $totalHarga + $subTotal; 
	  
	  // Mendapatkan total barang
	  $totalBarang = $totalBarang + $myData['jumlah']; 
  ?>
  <tr>
    <td bgcolor="#FFFFFF" align="center"><?php echo $nomor; ?></td>
    <td bgcolor="#FFFFFF"><a href="?open=Barang-Lihat&amp;Kode=<?php echo $myData['kd_barang']; ?>" target="_blank"><?php echo $myData['nm_barang']; ?></a></td>
    <td bgcolor="#FFFFFF" align="right">Rp.<?php echo format_angka($myData['harga']); ?></td>
    <td bgcolor="#FFFFFF" align="center"><?php echo $myData['jumlah']; ?></td>
    <td bgcolor="#FFFFFF" align="right">Rp. <?php echo format_angka($subTotal); ?></td>
  </tr>
  <?php } ?>
  <tr>
    <td colspan="3" align="right"><b>GRAND TOTAL BELANJA :</b></td>
    <td align="center" bgcolor="#7fffd4"><?php echo $totalBarang; ?></td>
    <td align="right" bgcolor="#7fffd4"><strong>Rp. <?php echo format_angka($totalHarga); ?></strong></td>
</thead>
              </table>
            </div>
          </div>
        </div>
    </div>
<form name="form1" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="0">
    <tr align="center">
    </tr>
    <p>
    	<div class="text-center">
    <td align=center height="22" colspan="5" bgcolor="black"><font color="white">ALAMAT TUJUAN PENGIRIMAN BARANG</td></font>
</tr>
</div>
</p>
<td>&nbsp;</td>
    <tr> 
      <td width="126"><div align="left"><b>Nama Penerima</b></div></td>
      <td width="9"><strong>:</strong></td>
      <td width="328"><div align="left">
        <input name="txtNama" type="text" size="50" maxlength="50" value="<?php echo $dataNama; ?>" placeholder="Silahkan input Nama Penerima" required="required">
      </div></td>
    </tr>
    <tr>
      <td><div align="left"><b>Alamat  Tujuan </b></div></td>
      <td><strong>:</strong></td>
      <td><div align="left">
        <textarea name="txtAlamat" cols="50" rows="2" placeholder="Input Alamat Lengkap" required="required"><?php echo $dataAlamat; ?></textarea>
      </div></td>
    </tr>
    <tr> 
      <td><div align="left" class="label-input100"><b>Kota Tujuan</b></div></td>
      <td><strong>:</strong></td>
      <td> <div align="left">
        <select name="cmbKota" data-validate="Name is required" required="required">
          <option value="">-- Kota Tujuan --</option>
          <?php
		$comboSql = "SELECT * FROM kota_kirim ORDER BY nm_kota ASC";
		$comboQry = mysql_query($comboSql, $koneksi) or die ("Gagal query".mysql_error());
		while ($comboData =mysql_fetch_array($comboQry)) {
			if ($comboData['kd_kota']==$dataProvinsi) {
				$cek="selected";
			}
			else {
				$cek="";
			}
			echo "<option value='$comboData[kd_kota]' $cek>$comboData[nm_kota]</option>";
		}
		?>
		<span class="focus-input100"></span>
        </select>
      </div></td>
    </tr>
    <tr> 
    	<div class="col-md-6">
								<div class="form-group" data-validate="Name is required">
      <td><div align="left"><b>Kode Pos</b></div></td>
      <td><strong>:</strong></td>
      <td> <div align="left">
        <input name="txtPos" type="text" size="6" maxlength="5" value="<?php echo $dataPos; ?>" placeholder="Kode Pos" required="required"> 
        <font color="#FF0000" size="1">* (diisi minimal/max 5 digit)</font></div></td>
    </tr>
    <tr> 
      <td><div align="left"><b>No. Telepon</b></div></td>
      <td><strong>:</strong></td>
      <td> <div align="left">
        <input name="txtNoTelp" type="number" size="20" maxlength="20" value="<?php echo $dataNoTelp; ?>" placeholder="Silahkan Input No Telpon" required="required">
      </div></td>
    </tr>
     <tr>
      <td><div align="left"><b>Keterangan </b></div></td>
      <td><strong>:</strong></td>
      <td><div align="left">
        <textarea name="txtKeterangan" cols="50" rows="2" placeholder="Input Keterangan" required="required"><?php echo $dataKeterangan; ?></textarea>
      </div></td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input name="btnSimpan" type="submit" class="btn btn-primary py-3 px-4" value=" Simpan &amp; Lanjutkan Transaksi " /></td>
    </tr>
  </table>
</form>
</div>
</div>
</div>
<?php include 'footer.php'; ?>

<!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


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
    
  </body>
</html>
