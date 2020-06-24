<?php
include_once "session.php";
include_once "koneksi.php";
include_once "library.php";

// Program ini akan Dijalankan ketika Tombol BELI diklik, tombol BELI ada di halaman Produk Barang

// Baca Kode Pelanggan yang Login
$KodePelanggan	= $_SESSION['user'];

if(isset($_GET['Kode'])) {
	// Baca Kode Barang yang dipilih
	$Kode = $_GET['Kode'];
	
	// Baca data di dalam Keranjang Belanja	
	$cekSql = "SELECT * FROM keranjang WHERE kd_barang='$Kode' AND kd_pelanggan='$KodePelanggan'";
	$cekQry = mysql_query($cekSql, $koneksi) or die ("Cek data barang".mysql_error());
	$test = mysql_fetch_array($cekQry);
		$sqlb = "select * from barang where kd_barang='$Kode'";
		$sq   = mysql_query($sqlb, $koneksi) or die ("Cek data barang".mysql_error());
		$sqlq = @mysql_fetch_array($sq);
		$jj   = $test['jumlah'];
		$ss   = $sqlq['stok'];
	if(mysql_num_rows($cekQry) >=1) {
		if( $jj === $ss){
			?>
            <script>
				alert("maaf jumlah melebihi stok");
				document.location="./";
			</script>
            <?php
		}else{
		// Jika barang sudah pernah dipilih, maka update saja jumlah barangnya (+1)
			$mySql = "UPDATE keranjang SET jumlah=jumlah + 1 WHERE kd_barang='$Kode' AND kd_pelanggan='$KodePelanggan'";	
		}

	}
	else {
		// Jika barang belum pernah dipilih, maka tambahkan baris baru ke keranjang
		$mySql = "SELECT * FROM barang WHERE kd_barang='$Kode'";
		$myQry = mysql_query($mySql, $koneksi) or die ("Gagal ambil data barang".mysql_error());
		$myData = mysql_fetch_array($myQry);
		
		// Membaca data dari tabel Barang, untuk diinput ke tabel TMP
		$hargaJual	= $myData['harga'];
		$tanggal	= date('Y-m-d');
		
		// Simpan data ke TMP (Keranjang Belanja)
		$mySql	= "INSERT INTO keranjang (kd_barang, harga, jumlah, tgl, kd_pelanggan) 
					VALUES('$Kode', '$hargaJual', '1', '$tanggal', '$KodePelanggan')";
	}
	
	// Menjalankan SQL di atas ( Update jumlah barang & Input barang baru ke TMP)
	$myQry = mysql_query($mySql, $koneksi) or die ("Error".mysql_error());
	if ($myQry) {
		echo "<meta http-equiv='refresh' content='0; url=inc/keranjang_belanja.php'>";
	}
}

?>
