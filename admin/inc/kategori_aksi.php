<?php
include("koneksi.php");

//Jika ada tombol SIMPAN di klik maka tangkep semua post lalu simpan ke dalam db
if(isset($_POST["simpan"]))
{
	//cek apakah masih ada textbox yg nilainya kosong	
	if($_POST["nm_kategori"]=="") { 
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
	$nm_kategori = $_POST["nm_kategori"];
	//buat variabel query Simpan kedalam DB
	$simpan = "INSERT INTO kategori(nm_kategori) 
VALUES
  (
    '$nm_kategori'
  )";
  
	//Simpan kedalam db
	$qrysimpan = mysql_query($simpan, $koneksi);
	if($qrysimpan){
		
	//pesan JS
	?>
		<script language="javascript">
        alert("Data sukses tersimpan");
        document.location ="?page=ktg";
        </script>
    <?php
	//header("location:dokumen.php"); exit();		
	}
}

//jik ada tombol update di klik
if(isset($_POST["update"]))
{
	//cek apakah masih ada textbox yg nilainya kosong
	if( $_POST["kd_kategori"]=="" || $_POST["nm_kategori"]=="") { 
	//pesan JS
	?>
		<script language="javascript">
        alert("Data tidak lengkap");
        document.location = "?page=ktg";
        </script>
    <?php
	//header("location:dokumen.php"); 
	exit(); 
	}
	//print_r($_POST);exit();		
	//Jika sudah diisi semua, maka tangkep semua post
	$kd_kategori = $_POST["kd_kategori"];
	$nm_kategori = $_POST["nm_kategori"];
	//buat variabel query update kedalam DB [jika update an foto baru / jika foto name <>'']
	
		$update = "UPDATE kategori SET nm_kategori = '$nm_kategori'
		WHERE
		kd_kategori = '$kd_kategori'";
			//Simpan kedalam db
		$qryupdate = mysql_query($update, $koneksi);	
		
	
	if($qryupdate){
	//pesan JS
	?>
		<script language="javascript">
        alert("Data Kategori sukses terupdate");
        document.location = "?page=ktg";
        </script>
    <?php
	//header("location:dokumen.php"); exit();		
	}
}

//buat hapus yaa
if(isset($_GET["kd_kategori"]))
{
$kd_kategori = $_GET["kd_kategori"];	
$hapus = mysql_query("DELETE FROM kategori WHERE kd_kategori = '$kd_kategori'", $koneksi);
if($hapus){
	?>
    <script language="javascript">
	alert("Data kategori sukses terhapus");
	document.location = "../?page=ktg";
	</script>
    <?php
	}
}

?>