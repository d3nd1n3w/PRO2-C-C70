<?php
include("koneksi.php");

//Jika ada tombol SIMPAN di klik maka tangkep semua post lalu simpan ke dalam db
if(isset($_POST["simpan"]))
{
	//cek apakah masih ada textbox yg nilainya kosong	
	if( $_POST["nm_kota"]=="" || $_POST["ongkir"]=="" ) { 
	//pesan JS
	?>
		<script language="javascript">
        alert("Data tidak lengkap");
        history.go(-4);
        </script>
    <?php
	//header("location:dokumen.php"); 
	exit(); 
	}
	//Jika sudah diisi semua, maka tangkep semua post
	$nm_kota = $_POST["nm_kota"];
	$ongkir= $_POST["ongkir"];
	//buat variabel query Simpan kedalam DB
	$simpan = "INSERT INTO kota_kirim(nm_kota,ongkir) 
VALUES
  (
    '$nm_kota',
    'ongkir'
  )";
  
	//Simpan kedalam db
	$qrysimpan = mysql_query($simpan, $koneksi);
	if($qrysimpan){
		//UPLOAD GAMBAR KE FOLDER DOKUMEN
		
	//pesan JS
	?>
		<script language="javascript">
        alert("Data sukses tersimpan");
        document.location = "?page=ongkir";
        </script>
    <?php
	//header("location:dokumen.php"); exit();		
	}
}

//jik ada tombol update di klik
if(isset($_POST["update"]))
{
	//cek apakah masih ada textbox yg nilainya kosong
	if( $_POST["kd_kota"]=="" || $_POST["nm_kota"]=="" || $_POST["ongkir"]=="" ) { 
	//pesan JS
	?>
		<script language="javascript">
        alert("Data tidak lengkap");
        document.location = "?page=ongkir";
        </script>
    <?php
	//header("location:dokumen.php"); 
	exit(); 
	}
	//print_r($_POST);exit();		
	//Jika sudah diisi semua, maka tangkep semua post
	$kd_kota = $_POST["kd_kota"];
	$nm_kota = $_POST["nm_kota"];
	$ongkir = $_POST["ongkir"];
	//buat variabel query update kedalam DB [jika update an foto baru / jika foto name <>'']
	
		$update = "UPDATE kota_kirim SET nm_kota = '$nm_kota', 
		ongkir = '$ongkir'
		WHERE
		kd_kota = '$kd_kota'";
			//Simpan kedalam db
		$qryupdate = mysql_query($update, $koneksi);	
		
	
	if($qryupdate){
	//pesan JS
	?>
		<script language="javascript">
        alert("Data Kota Kirim sukses terupdate");
        document.location = "?page=ongkir";
        </script>
    <?php
	//header("location:dokumen.php"); exit();		
	}
}

//buat hapus yaa
if(isset($_GET["kd_kota"]))
{
$kd_kota = $_GET["kd_kota"];	
$hapus = mysql_query("DELETE FROM kota_kirim WHERE kd_kota = '$kd_kota'", $koneksi);
if($hapus){
	?>
    <script language="javascript">
	alert("Data Kota Kirim sukses terhapus");
	document.location = "../?page=ongkir";
	</script>
    <?php
	}
}

?>