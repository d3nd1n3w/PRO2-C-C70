<?php
//include_once "../library/inc.sesadmin.php";   // Validasi halaman harus Login
include "koneksi.php"; // Membuka koneksi
include "../../inc/library.php";    // Membuka librari peringah fungsi

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$baris 	= 50;
$hal	= isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM pelanggan";
$pageQry = mysql_query($pageSql, $koneksi) or die ("error paging: ".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$maksData= ceil($jml/$baris);
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Laporan Data Pelanggan</title>
</head>
<body>
<h2><div align="center">LAPORAN DATA PELANGGAN</div></h2>
<table class="table-list" width="1040" border="1" cellspacing="1" cellpadding="3">
  <tr>
    <td width="29" bgcolor="#00FFFF"><strong>No</strong></td>
    <td width="126" bgcolor="#00FFFF"><strong>Kode Pelanggan </strong></td>
    <td width="229" bgcolor="#00FFFF"><strong>Nama </strong></td>
      <td width="180" bgcolor="#00FFFF"><strong>Alamat </strong></td>
     <td width="66" bgcolor="#00FFFF"><strong>Kota </strong></td>
    <td width="56" bgcolor="#00FFFF"><strong>Kelamin</strong></td>
    <td width="100" bgcolor="#00FFFF"><strong>No Telp </strong></td>
     <td width="75" bgcolor="#00FFFF"><strong>Email </strong></td>
    <td width="95" bgcolor="#00FFFF"><strong>Username</strong></td>
    
 
  </tr>
  <?php
	$mySql = "SELECT * FROM pelanggan ORDER BY kd_pelanggan DESC LIMIT $hal, $baris";
	$myQry = mysql_query($mySql, $koneksi)  or die ("Query salah : ".mysql_error());
	$nomor = $hal; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
	?>
  <tr>
    <td align="center" ><?php echo $nomor; ?></td>
    <td><?php echo $myData['kd_pelanggan']; ?></td>
    <td><?php echo $myData['nama_pelanggan']; ?></td>
    <td><?php echo $myData['alamat']; ?></td>
    <td><?php echo $myData['nm_kota']; ?></td>
    <td><?php echo $myData['jk']; ?></td>
    <td><?php echo $myData['telp']; ?></td>
    <td><?php echo $myData['email']; ?></td>
    <td><?php echo $myData['username']; ?></td>
  </tr>
  <?php } ?>
  <tr>
    <td colspan="3"><strong>Jumlah Data :<?php echo $jml; ?></strong></td>
    <td colspan="4" align="right"><strong>Halaman ke :
	<?php
	for ($h = 1; $h <= $maksData; $h++) {
		$list[$h] = $baris * $h - $baris;
		echo " <a href='?page=laporan_pelanggan&hal=$list[$h]'>$h</a> ";
	}
	?>    
      </strong></td>
  </tr>
</table>
<br>
<button onClick="window.print() ;" style="font-size:20px">PRINT</button>

</body>
</html>
