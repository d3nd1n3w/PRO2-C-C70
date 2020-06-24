<?php
include_once "koneksi.php";
include_once "library.php";

$filterSql	= "";
// Membaca variabel form
$KeyWord	= isset($_GET['KeyWord']) ? $_GET['KeyWord'] : '';
$txtKeyword	= isset($_POST['txtKeyword']) ? $_POST['txtKeyword'] : $KeyWord;

// Jika tombol Cari diklik
if(isset($_POST['btnCari'])){
	if($_POST) {
         // Skrip pencarian
		$filterSql = "WHERE nm_barang LIKE '%$txtKeyword%' OR nm_barang LIKE '$txtKeyword%'";
	}
}
else {
	if($KeyWord){
         // Skrip pencarian
		$filterSql = "WHERE nm_barang LIKE '%$txtKeyword%' OR nm_barang LIKE '$txtKeyword%'";
	}
	else {
		$filterSql = "";
	}
} 

# Nomor Halaman (Paging)
$baris	= 6;
$hal 	= isset($_GET['hal']) ? $_GET['hal'] : 1;
$pageSql= "SELECT * FROM barang $filterSql ORDER BY kd_barang DESC";
$pageQry= mysql_query($pageSql, $koneksi) or die ("error paging: ".mysql_error());
$jml	= mysql_num_rows($pageQry);
$maks	= ceil($jml/$baris);
$mulai	= $baris * ($hal-1);
?>
<html>
<head>
</head>
<body>


<div id="isi">
	<div id="selamat_datang">
		<strong>HASIL PENCARIAN </strong> " <?php echo $txtKeyword; ?> "</td>
	</div>

<div class="konten">
	<div class="lihat_barang">

    
<?php
// Menampilkan daftar barang
$barang2Sql = "SELECT barang.*,  kategori.nm_kategori FROM barang 
			LEFT JOIN kategori ON barang.kd_kategori=kategori.kd_kategori 
			$filterSql 
			ORDER BY barang.kd_barang ASC LIMIT $mulai, $baris";
$barang2Qry = mysql_query($barang2Sql, $koneksi) or die ("Gagal Query".mysql_error()); 
$nomor = 0;

while ($barang2Data = mysql_fetch_array($barang2Qry)) {
  $nomor++;
  $KodeBarang = $barang2Data['kd_barang'];
  $KodeKategori = $barang2Data['kd_kategori'];
  
  // Menampilkan gambar utama
  if ($barang2Data['gambar']=="") {
		$fileGambar = "noimage.jpg";
  }
  else {
		$fileGambar	= $barang2Data['gambar'];
  }
  
?>
<div id="kolom3">
  	
  	<div class="gambar_barang">
    	<a href="?open=Barang-Lihat&Kode=<?php echo $KodeBarang; ?>">
			<img src="gambar/<?php echo $fileGambar; ?>" width="100" border="0"> 
		</a>
	</div>

	<div class='harga'>
		Rp. <?php echo format_angka($barang2Data['harga']); ?> 
	</div>
	
	<div class="nama_barang"><a href="?open=Barang-Lihat&Kode=<?php echo $KodeBarang; ?>"><?php echo $barang2Data['nm_barang']; ?> 
		</a>
	</div>
    	
	<div class="jrk"></div>
<?php
    if($barang2Data['stok'] == 0){
    ?>
    	<div class="tombol_habis">
	      <a href="#"><strong><font size="+1">Stok Habis</font></strong></a>
	    </div>	
	<?php
    }else{
    ?>
	<div class="tombol_beli">
      <a href="?open=Barang-Beli&Kode=<?php echo $KodeBarang; ?>"><strong>Beli</strong></a>
    </div>
    
    <div class="tombol_detail">
	  <a href="?open=Barang-Lihat&Kode=<?php echo $KodeBarang; ?>">
	  	Detail
	  </a>
	</div>
	
<?php } ?>
</div>	
<?php } ?>

<div id="clear"></div>

<div id="halaman">
	<b>Halaman:
    <?php
		for ($h = 1; $h <= $maks; $h++) {
			echo "[  <a href='?open=Barang-Pencarian&KeyWord=$txtKeyword&hal=$h'>$h</a> ]";
		}
	?>
    </b>
</div>

</div>
</div>
</div>
</body>
</html>