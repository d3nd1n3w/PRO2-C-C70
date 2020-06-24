<?php
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
	echo "<meta http-equiv='refresh' content='2; url=./'>";
	exit;
}
?>
<html>
<head>
<title>Keranjang Belanja</title>
<body>

<div id="isi">
  <div class="konten">
    <div class="lihat_barang">
<table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td><img src="gambar/keranjang.jpg" width="186" height="41"></td>
  </tr>
</table>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
  <table width="99%" border="0" align="center" cellpadding="2" cellspacing="0" class="border">
    <tr> 
      <td width="82" height="22" align="center" bgcolor="#7fffd4"><strong>Gambar</strong></td>
      <td width="418" bgcolor="#7fffd4"><b>Nama Barang</b></td>
      <td width="115" align="right" bgcolor="#7fffd4"><b><b>Harga (Rp)</b></b></td>
      <td width="161" align="center" bgcolor="#7fffd4"><b>Jumlah<b></b></b></td>
      <td width="116" align="right" bgcolor="#7fffd4"><b>Total (Rp)</b></td>
      <td width="134" align="center" bgcolor="#7fffd4"><img src="gambar/aksi.gif" width="14" height="14"></td>
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
        <img src="../gambar/<?php echo $fileGambar; ?>" width="70" border="1" ></td>
      <td><a href="?open=Barang-Lihat&Kode=<?php echo $Kode; ?>" target="_blank"><strong><?php echo $myData['nm_barang']; ?></strong></a></td>
      <td align="right">Rp.<?php echo format_angka($myData['harga']); ?></td>
      <td align="center"><input name="txtJum[]" type="text" value="<?php echo $myData['jumlah']; ?>" size="2" maxlength="2">
        <input name="txtKodeH[]" type="hidden" value="<?php echo $myData['kd_barang']; ?>"></td>
      <td align="right"><span>Rp. <?php echo format_angka($total); ?></span></td>
      <td><a href="?open=Keranjang-Belanja&aksi=Hapus&idHapus=<?php echo $myData['kd_keranjang'];?>">Hapus</a></td>
    </tr>
    <tr>
      <td>Kategori :  <?php echo $myData['nm_kategori']; ?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
	<?php } ?>
    <tr>
      <td align="center" valign="top">&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="2" align="right"><strong>GRAND TOTAL   : </strong></td>
      <td align="right" bgcolor="#7fffd4"> <strong><?php echo "Rp. ".format_angka($grandTotal); ?></strong> </td>

      	<input name="kd_barang" value="<?php echo $Kode; ?>">
      <td><input name="btnSimpan" type="submit" value=" Ubah Data"></td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td colspan="6" align="center">
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <table width="100%">
        <tr>
          <td width="29%"><div align="right"><a href="?page=barang"><img src="images/btn_kembalibel.jpg" alt="Kembali Belanja" width="220"></a></div></td>
          <td width="17%">&nbsp;</td>
          <td width="54%"><div align="right"><a href="?open=Transaksi-Proses"><img src="images/btn_lanjutkan.jpg" alt="Lanjutkan Transaksi " border="0"></a></div></td>
        </tr>
        <tr></tr>
      </table>
      <p>&nbsp;</p></td>
    </tr>
  </table>
</form>
</div>
</div>
</div>