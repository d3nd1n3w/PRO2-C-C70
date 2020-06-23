<?php
include("koneksi.php");

//Jika ada tombol SIMPAN di klik maka tangkep semua post lalu simpan ke dalam db
if(isset($_POST["simpan"]))
{
	//cek apakah masih ada textbox yg nilainya kosong	
	if($_POST["kd_barang"]=="" || $_POST["nm_barang"]=="" || $_POST["kategori"]=="" || $_POST["harga"]=="" || $_POST["stok"]=="" || $_POST["spek"]=="" || $_FILES["gambar"]["name"]=="") { 
	//pesan JS
	?>
		<script language="javascript">
        alert("Data tidak lengkap");
        history.go(-2);
        </script>
    <?php
	//header("location:dokumen.php"); 
	exit(); 
	}
	//Jika sudah diisi semua, maka tangkep semua post
	$kd_barang = $_POST["kd_barang"];
	$nama = $_POST["nm_barang"];
	$kategori= $_POST["kategori"];
	$harga= $_POST["harga"];
	$stok = $_POST["stok"];
	$spek = $_POST["spek"];
	$gambar = $_FILES["gambar"]["name"];
	//buat variabel query Simpan kedalam DB
	$simpan = "INSERT INTO barang 
VALUES
  (
    '$kd_barang',
    '$nama',
    '$kategori',
    '$harga',
	'$stok',
	'$spek',
	'$gambar'
  )";
  
	//Simpan kedalam db
	$qrysimpan = mysql_query($simpan, $koneksi);
	if($qrysimpan){
		//UPLOAD GAMBAR KE FOLDER DOKUMEN
		copy ($_FILES["gambar"]["tmp_name"],"gambar/".$_FILES["gambar"]["name"]);
	//pesan JS
	?>
		<script language="javascript">
        alert("Data sukses tersimpan");
        document.location = "?page=produk";
        </script>
    <?php
	//header("location:dokumen.php"); exit();		
	}
}

//jik ada tombol update di klik
if(isset($_POST["update"]))
{
	//cek apakah masih ada textbox yg nilainya kosong
	if($_POST["kd_barang"]=="" || $_POST["nm_barang"]=="" || $_POST["kategori"]=="" || $_POST["harga"]=="" || $_POST["stok"]=="" || $_POST["spesifikasi"]=="" ) { 
	//pesan JS
	?>
		<script language="javascript">
        alert("Data tidak lengkap");
        document.location = "?page=produk";
        </script>
    <?php
	//header("location:dokumen.php"); 
	exit(); 
	}
	//print_r($_POST);exit();		
	//Jika sudah diisi semua, maka tangkep semua post
	$kd_barang = $_POST["kd_barang"];
	$nama = $_POST["nm_barang"];
	$kategori= $_POST["kategori"];
	$harga= $_POST["harga"];
	$stok = $_POST["stok"];
	$spek = $_POST["spesifikasi"];
	$gambar = $_FILES["gambar"]["name"];
	
	//buat variabel query update kedalam DB [jika update an foto baru / jika foto name <>'']
	
	if($_FILES["gambar"]["name"]<>""){
		//query dengan field foto		
		$update = "UPDATE barang SET kd_kategori= '$kategori', 
    nm_barang='$nama',
    harga = '$harga',
	stok = '$stok',
	spesifikasi = '$spek',
	gambar = '$gambar'
	
	WHERE kd_barang = '$kd_barang'";
		
		//update kedalam db
		$qryupdate = mysql_query($update, $koneksi);
		//UPDATE GAMBAR KE FOLDER DOKUMEN
		copy ($_FILES["gambar"]["tmp_name"],"../gambar/".$_FILES["gambar"]["name"]);	
	}else{
		$update = "UPDATE barang SET kd_kategori= '$kategori', 
    nm_barang='$nama',
    harga = '$harga',
	stok = '$stok',
	spesifikasi = '$spek'
		WHERE kd_barang = '$kd_barang'";
			//Simpan kedalam db
		$qryupdate = mysql_query($update, $koneksi);	
		
	
	}
	if($qryupdate){
	//pesan JS
	?>
		<script language="javascript">
        alert("Data produk sukses terupdate");
        document.location = "?page=produk";
        </script>
    <?php
	//header("location:dokumen.php"); exit();		
	}
}

//buat hapus yaa
if(isset($_GET["kd_barang"]))
{
$kd_pelanggan = $_GET["kd_barang"];	
$hapus = mysql_query("DELETE FROM barang WHERE kd_barang = '$kd_barang'");
if($hapus){
	?>
    <script language="javascript">
	alert("Data Produk sukses terhapus");
	document.location = "../?page=produk";
	</script>
    <?php
	}
}

?>