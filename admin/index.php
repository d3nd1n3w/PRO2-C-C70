<?php
@session_start();
ob_start();
include "inc/koneksi.php";

if(@$_SESSION['admin']){
?>
<html>
<head>
	<title>Halaman Admin</title>
    <link rel="stylesheet" href="style/index.css">
    <link rel="shortcut icon">
    <script src="js/jquery-2.2.4.js"></script>
</head>
<body>

<div id="header">
	<div id="canvas">
    <h1>ADMINISTRATOR</h1>
    <?php $a= $_SESSION['admin'];
	$sqlb=mysql_query("select * from admin where id_admin='$a'");
	$rows=mysql_fetch_array($sqlb);?>
   <h3> <?php echo $rows['nama_admin'];  ?></h3>
  </div>
</div>

<div id="isi">
<div id="canvas">
    <div id="nav">
        <ul>
            <li><a href="./">Beranda</a></li>
            <li><a href="?page=adm">Data Admin</a></li>
            <li><a href="?page=produk">Data Produk</a></li>
            <li><a href="?page=ktg">Data Kategori</a></li>
            <li><a href="?page=pelanggan">Data Pelanggan</a></li>
            <li><a href="?page=ongkir">Data Ongkir</a></li>
            <li><a href="?page=transaksi">Data Transaksi</a></li>
            <li><a href="?page=retur_brg">Data Retur</a></li>
            <li><a href="?page=laporan">Laporan</a></li>
            <li><a href="logout.php">Log Out</a></li>
        </ul>
    </div>
    
    <div id="konten">
    	<?php
        $page = @$_GET['page'];
		if($page == ""){
			include "inc/home.php";
		}else if($page == "adm"){
			include "inc/admin.php";	
		}else if($page == "produk"){
			include "inc/produk.php";	
		}else if($page == "admin_edit"){
			include "inc/admin_edit.php";	
		}else if($page == "admin_aksi"){
			include "inc/admin_aksi.php";	
		}else if($page == "admin_tambah"){
			include "inc/admin_tambah.php";
		}else if($page == "produk_edit"){
			include "inc/produk_edit.php";	
		}else if($page == "produk_aksi"){
			include "inc/produk_aksi.php";	
		}else if($page == "ktg"){
			include "inc/kategori.php";
		}else if($page == "kategori_edit"){
			include "inc/kategori_edit.php";
		}else if($page == "kategori_tambah"){
			include "inc/kategori_tambah.php";
		}else if($page == "kategori_aksi"){
			include "inc/kategori_aksi.php";
		}else if($page == "pelanggan"){
			include "inc/pelanggan.php";
		}else if($page == "pelanggan_aksi"){
			include "inc/pelanggan_aksi.php";
		}else if($page == "ongkir"){
			include "inc/ongkir.php";
		}else if($page == "ongkir_tambah"){
			include "inc/ongkir_tambah.php";
		}else if($page == "ongkir_edit"){
			include "inc/ongkir_edit.php";
		}else if($page == "ongkir_aksi"){
			include "inc/ongkir_aksi.php";
		}else if($page == "produk_tambah"){
			include "inc/produk_tambah.php";
		}else if($page == "produk_aksi"){
			include "inc/produk_aksi.php";
		}else if($page == "transaksi"){
			include "inc/transaksi.php";
		// }else if($page == "retur"){
		// 	include "inc/retur_konfirmasi.php";	
		}else if($page == "pesanan"){
			include "inc/pesanan.php";
		}else if($page == "retur_brg"){
			include "inc/retur.php";
		}else if($page == "pesanan_aksi"){
			include "inc/pesanan_aksi.php";
		}else if($page == "pesanan_lihat"){
			include "inc/pesanan_lihat.php";
		}else if($page == "pesanan_bayar"){
			include "inc/pesanan_bayar.php";
		}else if($page == "konfirmasi"){
			include "inc/konfirmasi.php";
		}else if($page == "konfirmasi_edit"){
			include "inc/konfirmasi_edit.php";	
		}else if($page == "laporan"){
			include "inc/laporan.php";
		}else if($page == "laporan_barang"){
			include "inc/laporan-barang.php";	
		}
		
		?>
    </div>
    
</div>
</div>

<div id="footer">
    C70-PROGATE @2020
</div>
<script>
function hapus_admin($id_admin){
if(confirm("Yakin ingin menghapus admin ini")){
	document.location="inc/admin_aksi.php?id_admin="+$id_admin;
}
return false;
}
</script>

<script>
function hapus_produk($kd_barang){
if(confirm("Yakin ingin menghapus produk ini")){
	document.location="inc/produk_aksi.php?kd_barang="+$kd_barang;
}
return false;
}
</script>

<script>
function hapus_kategori($kd_kategori){
if(confirm("Yakin ingin menghapus Kategori ini")){
	document.location="inc/kategori_aksi.php?kd_kategori="+$kd_kategori;
}
return false;
}
</script>

<script>
function hapus_pel($kd_pelanggan){
if(confirm("Yakin ingin menghapus Pelanggan ini")){
	document.location="inc/pelanggan_aksi.php?kd_pelanggan="+$kd_pelanggan;
}
return false;
}
</script>

<script>
function hapus_ongkir($kd_kota){
if(confirm("Yakin ingin menghapus Kota Kirim ini")){
	document.location="inc/ongkir_aksi.php?kd_kota="+$kd_kota;
}
return false;
}
</script>

<script>
function hapus_konf($id_konf){
if(confirm("Yakin ingin menghapus Konfirmasi ini")){
	document.location="inc/konfirmasi_aksi.php?id_konf="+$id_konf;
}
return false;
}
</script>
<script>
function hapus_konfirm($id_konf){
if(confirm("Yakin ingin menghapus Konfirmasi ini")){
	document.location="inc/retur_aksi.php?id_konf="+$id_konf;
}
return false;
}
</script>
</body>
</html>

<?php
}else{
	header("location: login.php");
}
?>