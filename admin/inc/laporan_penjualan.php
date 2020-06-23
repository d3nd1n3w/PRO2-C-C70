<?php
//include_once "../library/inc.sesadmin.php";   // Validasi, mengakses halaman harus Login
include "koneksi.php"; // Membuka koneksi
include "../../inc/library.php";    // Membuka librari peringah fungsi

# Deklarasi variabel
$filterSql	= ""; 
$startTgl	= ""; 

# Filter data berdasarkan Tanggal
$tanggal 	= isset($_POST['txtTanggal']) ? $_POST['txtTanggal'] : date('d-m-Y');
$filterSql	= "AND tgl = '".InggrisTgl($tanggal)."'";
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Laporan Pemesanan Lunas per Tanggal</title>
</head>
<body>
<h2>LAPORAN PENJUALAN LUNAS PER TANGGAL</h2>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
  <table width="500" border="0" cellspacing="1" cellpadding="3">
    <tr>
      <td colspan="3" bgcolor="#00FFFF"><strong>FILTER DATA </strong></td>
    </tr>
    <tr>
      <td width="133"><strong>Tanggal Transaksi</strong></td>
      <td width="5"><strong>:</strong></td>
      <td width="340"><input name="txtTanggal" type="text" class="tcal"  value="<?php echo $tanggal; ?>" size="22" />
        <input name="btnTampil" type="submit" value=" Tampilkan " /></td>
    </tr>
  </table>
</form>
<table class="table-list" width="783" border="1" cellspacing="1" cellpadding="3">
  <tr>
    <td width="22" align="center" bgcolor="#00FFFF"><b>No</b></td>
    <td width="90" bgcolor="#00FFFF"><b>Tanggal</b></td>
    <td width="129" bgcolor="#00FFFF"><b>No. Pemesanan </b> </td>
    <td width="116" bgcolor="#00FFFF"><strong>Kode Pelanggan </strong></td>
    <td width="146" bgcolor="#00FFFF"><strong>Penerima </strong></td>
    <td width="92" align="right" bgcolor="#00FFFF"><strong>Total Brg  </strong></td>
    <td width="106" align="right" bgcolor="#00FFFF"><strong>Total Belanja (Rp) </strong></td>
   
  </tr>
  <?php
	// Deklrasi variabel angka
	$totalBayar 	= 0;
	$totalBiayaKirim	= 0;
	$totItemBarang	= 0;
	$totOmset		= 0;

	// Menampilkan Semua Pemesanan yang sudah Lunas, dengan filter terpilih
	$mySql = "SELECT orderan.*, pelanggan.nama_pelanggan, kota_kirim.ongkir FROM orderan
				LEFT JOIN pelanggan ON orderan.kd_pelanggan = pelanggan.kd_pelanggan
				
				LEFT JOIN kota_kirim ON orderan.nm_kota = kota_kirim.kd_kota
				
				WHERE orderan.status='LUNAS' 
				$filterSql ORDER BY orderan.id_order";
	$myQry = mysql_query($mySql, $koneksi)  or die ("Query salah : ".mysql_error());
	$nomor = 0;
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		// Membaca Kode pemesanan/ Nomor transaksi
		$Kode = $myData['id_order'];  
		
		# SUB SKRIP & SQL	
		
		// MENGHITUNG TOTAL BAYAR, TOTAL JUMLAH BARANG dengan perintah SQL
		$my2Sql	= "SELECT SUM(harga * jumlah) As total_bayar,
					SUM(jumlah) As total_barang 
					FROM detail_order WHERE id_order='$Kode'";
		$my2Qry = @mysql_query($my2Sql, $koneksi) or die ("Gagal query".mysql_error());
		$my2Data =mysql_fetch_array($my2Qry);
		
		// Menghitung Total Bayar
		$totalBiayaKirim= $myData['ongkir'] * $my2Data['total_barang'];
		$totalBayar 	= $my2Data['total_bayar'] + $totalBiayaKirim;

		// MENJUMLAH TOTAL SEMUA DATA YANG TAMPIL (Dari baris pertama sampai terakhir)
		$totItemBarang	= $totItemBarang + $my2Data['total_barang'];
		$totOmset		= $totOmset + $totalBayar;
	?>
  <tr>
    <td><?php echo $nomor; ?></td>
    <td><?php echo IndonesiaTgl($myData['tgl']); ?></td>
    <td><?php echo $myData['id_order']; ?></td>
    <td><?php echo $myData['kd_pelanggan']; ?></td>
    <td><?php echo $myData['nama_pelanggan']; ?></td>
    <td align="right"><?php echo $my2Data['total_barang']; ?></td>
    <td align="right"><?php echo format_angka($totalBayar); ?></td>
    
  </tr>
  <?php } ?>
  <tr>
    <td colspan="5" align="right"><strong>GRAND TOTAL : </strong></td>
    <td align="right"> <strong><?php echo format_angka($totItemBarang); ?></strong> </td>
    <td align="right"> <strong> Rp. <?php echo format_angka($totOmset); ?> </strong> </td>
    
  </tr>
</table>
<button onClick="window.print();" style="font-size:20px">PRINT</button>
</body>
</html>
