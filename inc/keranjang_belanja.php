<?php
session_start();
include_once "session.php";
include_once "koneksi.php";
include_once "library.php";

// Baca Kode Pelanggan yang Login
$KodePelanggan	= $_SESSION['user'];

# TOMBOL SIMPAN DIKLIK
if(isset($_POST['btnSimpan'])){
	$arrData = count($_POST['txtJum']); 
	$kd_barang = $_POST['kd_barang'];
	$sss = mysql_query("select * FROM barang WHERE  kd_barang='$kd_barang'");
	$stok = mysql_fetch_array($sss);
	$qty = 1;
	for ($i=0; $i < $arrData; $i++) {
		# Melewati biar tidak 0 atau minus
		if ($_POST['txtJum'][$i] < 1) {
			$qty = 1;
		}
		else if($_POST['txtJum'][$i] <= $stok['stok']){
				$qty = $_POST['txtJum'][$i];
		}else{
			?>
			<script language="javascript">
				alert("Maaf jumlah Barang yg anda masukkan melebihi stok barang");
		        document.location = "?open=Keranjang-Belanja";
	        </script>
	        <?php
		}
					
		# Simpan Perubahan
		$KodeBrg	= $_POST['txtKodeH'][$i];
		$tanggal	= date('Y-m-d');
		$jam		= date('G:i:s');
		
		$sql = "UPDATE keranjang SET jumlah='$qty', tgl='$tanggal' 
				WHERE kd_barang='$KodeBrg' AND kd_pelanggan='$KodePelanggan'";
		$query = mysql_query($sql, $koneksi);
	}
	// Refresh
	echo "<meta http-equiv='refresh' content='0; url=?open=Keranjang-Belanja'>";
	exit;	
}

# MENGHAPUS DATA BARANG YANG ADA DI KERANJANG
// Membaca Kode dari URL
if(isset($_GET['aksi']) and trim($_GET['aksi'])=="Hapus"){ 
	// Membaca Id data yang dihapus
	$idHapus	= $_GET['idHapus'];
	
	// Menghapus data keranjang sesuai Kode yang dibaca di URL
	$mySql = "DELETE FROM keranjang  WHERE kd_keranjang='$idHapus' AND kd_pelanggan='$KodePelanggan'";
	$myQry = mysql_query($mySql, $koneksi) or die ("Eror hapus data".mysql_error());
	if($myQry){
		echo "<meta http-equiv='refresh' content='0; url=?open=Keranjang-Belanja'>";
	}
}

# MEMERIKSA DATA DALAM KERANJANG
$cekSql = "SELECT * FROM keranjang WHERE  kd_pelanggan='$KodePelanggan'";
$cekQry = mysql_query($cekSql, $koneksi) or die (mysql_error());
$cekQty = mysql_num_rows($cekQry);
if($cekQty < 1){
	echo "<br><br>";
	echo "<center>";
	echo "<b> KERANJANG BELANJA KOSONG </b>";
	echo "<center>";
	
	// Jika Keranjang masih Kosong, maka halaman Refresh ke data Barang
	echo "<meta http-equiv='refresh' content='2; url=../'>";
	exit;
}

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

<body>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
		<br><br><center>
<img src="../assets/images/cart.png" class="img-circle person" alt="Random Name" width="300" height="300">
</br></br></center>
<section class="ftco-section ftco-cart">
      <div class="container">
        <div class="row">
          <div class="col-md-12 ftco-animate">
            <div class="cart-list">
              <table class="table">
                <thead class="thead-primary">
                  <tr class="text-center">
                    <th>Gambar</th>
                    <th>Kategori</th>
                    <th>Nama Barang</th>
                    <th>Harga (Rp.)</th>
                    <th>Jumlah</th>
                    <th>Total (Rp.)</th>
                    <th>Aksi</th>
                  </tr>
	<?php
	// Menampilkan data Barang dari tmp_keranjang (Keranjang Belanja)
	$mySql = "SELECT barang.nm_barang, barang.gambar, kategori.nm_kategori, keranjang.*
			FROM keranjang
			LEFT JOIN barang ON keranjang.kd_barang=barang.kd_barang
			LEFT JOIN kategori ON barang.kd_kategori=kategori.kd_kategori 
			WHERE keranjang.kd_pelanggan='$KodePelanggan' 
			ORDER BY keranjang.kd_keranjang";
	$myQry = mysql_query($mySql, $koneksi) or die ("Gagal SQL".mysql_error());
	$total = 0; $grandTotal = 0;
	$no	= 0;
	while ($myData = mysql_fetch_array($myQry)) {
	  $no++;
	  // Menghitung sub total harga
	  $total 		= $myData['harga'] * $myData['jumlah'];
	  $grandTotal	= $grandTotal + $total;
	  
	  // Menampilkan gambar
	  if ($myData['gambar']=="") {
			$fileGambar = "gambar/noimage.jpg";
	  }
	  else {
			$fileGambar	= $myData['gambar'];
	  }
	  
	  #Kode Barang
	  $Kode = $myData['kd_barang'];
	?>

<tr> 
        <td bgcolor="#FFFFFF"><img src="../gambar/<?php echo $fileGambar; ?>" width="70" border="1" ></td>
        <td bgcolor="#FFFFFF"><?php echo $myData['nm_kategori']; ?></td>
      <td bgcolor="#FFFFFF"><a href="?open=Barang-Lihat&Kode=<?php echo $Kode; ?>" target="_blank"><strong><?php echo $myData['nm_barang']; ?></strong></a></td>
      <td bgcolor="#FFFFFF">Rp.<?php echo format_angka($myData['harga']); ?></td>
      <td bgcolor="#FFFFFF" align="center"><input name="txtJum[]" type="text" value="<?php echo $myData['jumlah']; ?>" size="2" maxlength="2"></td>
      <td bgcolor="#FFFFFF" align="center"><span><?php echo format_angka($total); ?></span></td>
      <td bgcolor="#FFFFCC" ><a href="?open=Keranjang-Belanja&aksi=Hapus&idHapus=<?php echo $myData['kd_keranjang'];?>">Hapus</a></td>
      <td bgcolor="#FFFFFF"><input name="txtKodeH[]" type="hidden"  value="<?php echo $myData['kd_barang']; ?>"></td> 
            <?php 
      $sub  = $totalHarga +$biayaKirim;
  }

    ?>
</tr>
      <td colspan="5" align="right"><strong>GRAND TOTAL   : </strong></td>
      <td align="right" bgcolor="#7fffd4"> <strong><?php echo format_angka($grandTotal); ?></strong> </td>
   
      <input name="kd_barang" type="hidden" value="<?php echo $Kode; ?>">	
       <td bgcolor="#FFFFCC"><input type="submit" name="btnSimpan" class="btn btn-primary py-3 px-4" value=" Ubah Data "></a></td>
    </thead>
</table>
        </div>

      <table width="100%">
        <tr>
<br>
		  <td align="left"><a href="index.php" class="btn btn-primary py-3 px-4">Kembali Belanja</a></td>
		  <td align="right"><a href="transaksi_proses.php" class="btn btn-primary py-3 px-4">Lanjutkan Transaksi</a></td>
          </br>
        </tr> 
      </thead>
              </table>
            </div>
          </div>
        </div>
    </div>
</div>
</div>
      <p>&nbsp;</p></td>
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




