<?php
@session_start();
//include_once "../../../tokolaptoponline/library/inc.sesadmin.php";   // Validasi halaman harus Login
//include_once "../../../tokolaptoponline/library/inc.connection.php"; // Membuka koneksi

include "../inc/library.php";    // Membuka librari peringah fungsi  

if(isset($_GET['Kode'])) {
	// Membaca Kode dari URL
	$Kode	= $_GET['Kode'];
	
	// Query membaca data Utama Pemesanan 
	$mySql ="SELECT orderan.*, pelanggan.nama_pelanggan, kota_kirim.*
			FROM orderan, pelanggan, kota_kirim
             WHERE orderan.kd_pelanggan= pelanggan.kd_pelanggan AND orderan.nm_kota=kota_kirim.kd_kota 
			 AND orderan.id_order='$Kode'";
 
	$myQry = mysql_query($mySql, $koneksi) or die ("Gagal query");
	$myData = mysql_fetch_array($myQry);
?>

<h1>TRANSAKSI PEMESANAN </h1>
<table width="550" border="0" cellspacing="2" cellpadding="3">
  <tr>
    <td bgcolor="#CCCCCC"><strong>TRANSAKSI</strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="31%"><b>No. Pemesanan</b></td>
    <td width="2%">:</td>
    <td width="67%"><?php echo $myData['id_order']; ?></td>
  </tr>
  <tr>
    <td><b>Tanggal</b></td>
    <td>:</td>
    <td><?php echo IndonesiaTgl($myData['tgl']); ?></td>
  </tr>
  <tr>
    <td><b>Kode Pelanggan</b></td>
    <td>:</td>
    <td><?php echo $myData['kd_pelanggan']; ?></td>
  </tr>
  <tr>
    <td><b>Nama Pelanggan</b></td>
    <td>:</td>
    <td><?php echo $myData['nama_pelanggan']; ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC"><strong>PENERIMA</strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><b>Nama Penerima</b></td>
    <td>:</td>
    <td><?php echo $myData['nama_pelanggan']; ?></td>
  </tr>
  <tr>
    <td><b>Alamat Penerima</b></td>
    <td>:</td>
    <td><?php echo $myData['alamat']; ?></td>
  </tr>
  <tr>
    <td><strong>Kota Tujuan</strong></td>
    <td>:</td>
    <td><?php echo $myData['nm_kota'];  ?></td>
  </tr>
  <tr>
    <td><b>No. Telepon </b></td>
    <td>:</td>
    <td><?php echo $myData['telp'];  ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#FFFF99"><b>Status Pembayaran </b></td>
    <td>:</td>

    <td><?php echo $myData['status']; ?> * </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<h2>DAFTAR PESANAN BARANG</h2>
<table width="800" border="0" cellpadding="2" cellspacing="0" class="table-list">
  <tr>
    <td width="30" align="center" bgcolor="#CCCCCC"><strong>No</strong></td>
    <td width="74" bgcolor="#CCCCCC"><strong>Kode</strong></td>
    <td width="404" height="22" bgcolor="#CCCCCC"><b>Nama Barang </b></td>
    <td width="111" align="right" bgcolor="#CCCCCC"><b><b>Harga (Rp)</b></b></td>
    <td width="54" align="center" bgcolor="#CCCCCC"><b>Jumlah</b></td>
    <td width="103" align="right" bgcolor="#CCCCCC"><b>Total (Rp)</b></td>
  </tr>
  <?php 
	  // Deklarasi variabel
	  $subTotal		= 0;
	  $totalBarang 	= 0;
	  $totalBiayaKirim = 0;
	  $totalHarga 	= 0;
	  $totalBayar 	= 0;
	  $unik_transfer = 0;
	  
	// SQL Menampilkan data Barang yang dipesan
	$tampilSql = "SELECT barang.nm_barang, detail_order.*
				FROM orderan, detail_order
				LEFT JOIN barang ON detail_order.kd_barang=barang.kd_barang
				WHERE orderan.id_order=detail_order.id_order
				AND orderan.id_order='$Kode'
				ORDER BY detail_order.kd_barang";
	$tampilQry = mysql_query($tampilSql, $koneksi) or die ("Gagal SQL".mysql_error()); 
	$total = 0;
	$nomor = 0;
	while ($tampilData = mysql_fetch_array($tampilQry)) {
	  $nomor++;
	  // Menghitung harga bersih
	  $subTotal		= $tampilData['harga'] * $tampilData['jumlah']; 
	  
	  // Menghitung total harga semua barang
	  $totalHarga 	= $totalHarga + $subTotal;  
	  
	  // Menghitung total barang
	  $totalBarang	= $totalBarang + $tampilData['jumlah']; 
  ?>
  <tr>
    <td align="center"><?php echo $nomor; ?></td>
    <td><?php echo $tampilData['kd_barang']; ?></td>
    <td><?php echo $tampilData['nm_barang']; ?></td>
    <td align="right">Rp. <?php echo $tampilData['harga']; ?></td>
    <td align="center"><?php echo $tampilData['jumlah']; ?></td>
    <td align="right">Rp.<?php echo format_angka($subTotal); ?></td>
  </tr>
  <?php
	}
  	# SKRIP REKAP DATA
	// Total biaya Kirim = Biaya kirim x Total barang
	$totalBiayaKirim = $myData['ongkir'] * $totalBarang;
	
	// Menghitung total bayar
	$totalBayar = $totalHarga + $totalBiayaKirim;  
	
	// ambil 3 digit terakhir no HP
	$digitHp 	= substr($myData['telp'],-3); 
	
	// Membuat unik transfer
	$unik_transfer = substr($totalBayar,0,-3).$digitHp;
	?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="5" align="right"><strong>Total Belanja (Rp) : </strong></td>
    <td align="right"><?php echo format_angka($totalHarga); ?></td>
  </tr>
  <tr>
    <td colspan="5" align="right"><strong>Total Biaya Kirim  (Rp) : </strong></td>
    <td align="right"><?php echo format_angka($totalBiayaKirim); ?></td>
  </tr>
  <tr>
    <td colspan="5" align="right"><strong>GRAND TOTAL  (Rp) : </strong></td>
    <td align="right"><?php echo format_angka($totalBayar); ?></td>
  </tr>
  <tr>
    <td colspan="6" align="right" bgcolor="#F5F5F5">Nominal yang harus dibayarkan adalah <b>Rp. <?php echo format_angka($totalBayar); ?></b> </td>
  </tr>
  <tr>
    <td colspan="6" align="right">
	<?php if($myData['status']=="PESAN") { ?>
        <a href="./?page=pesanan_bayar&Aksi=LUNAS&Kode=<?php echo $myData['id_order']; ?>" class='button orange small'> <strong>Bayar</strong></a>
        <?php } else { ?>
        <a href="./?page=pesanan_bayar&Aksi=PESAN&Kode=<?php echo $myData['id_order']; ?>" class='button orange small'>  <strong>Batalkan</strong></a>
    <?php } ?>    </td>
  </tr>
</table>
<?php
} 
else {
	// Kode tidak terbaca
	echo "<meta http-equiv='refresh' content='0; url=?open=Transaksi-Tampil'>";
}
?>
<p><b>* Keterangan Status Pembayaran :</b></p>
<ul>
  <li><b>Pesan :</b> Masih dalam pemesanan  atau <strong>Belum Dibayar</strong>.</li>
  <li><b>Lunas :</b> Pemesanan sudah dibayar Lunas, dan <strong>Dalam Proses Pengiriman</strong>.</li>
</ul>

</html>
