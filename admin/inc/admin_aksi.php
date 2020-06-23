<?php
include("koneksi.php");

//Jika ada tombol SIMPAN di klik maka tangkep semua post lalu simpan ke dalam db
if(isset($_POST["simpan"]))
{
	//cek apakah masih ada textbox yg nilainya kosong	
	if( $_POST["username"]=="" ||  $_POST["password"]=="" || $_POST["nama_admin"]=="" ) { 
	//pesan JS
	?>
		<script language="javascript">
        alert("Data tidak lengkap");
        history.go(-1);
        </script>
    <?php
	//header("location:dokumen.php"); 
	exit(); 
	}
	//Jika sudah diisi semua, maka tangkep semua post
	$username = $_POST["username"];
	$password = md5($_POST["password"]);
	$nama_admin= $_POST["nama_admin"];
	//buat variabel query Simpan kedalam DB
	$simpan = "INSERT INTO admin(id_admin,username,password,nama_admin) 
VALUES
  (
    '',
    '$username',
    '$password',
    '$nama_admin'
  )";
  
	//Simpan kedalam db
	$qrysimpan = mysql_query($simpan, $koneksi);
	if($qrysimpan){
		//UPLOAD GAMBAR KE FOLDER DOKUMEN
		
	//pesan JS
	?>
		<script language="javascript">
        alert("Data sukses tersimpan");
        document.location = "?page=adm";
        </script>
    <?php
	//header("location:dokumen.php"); exit();		
	}
}

//jik ada tombol update di klik
if(isset($_POST["update"]))
{
	//cek apakah masih ada textbox yg nilainya kosong
	if( $_POST["username"]=="" ||  $_POST["password"]=="" || $_POST["nama_admin"]=="") { 
	//pesan JS
	?>
		<script language="javascript">
        alert("Data tidak lengkap");
        document.location = "?page=adm";
        </script>
    <?php
	//header("location:dokumen.php"); 
	exit(); 
	}
	//print_r($_POST);exit();		
	//Jika sudah diisi semua, maka tangkep semua post
	$id_admin = $_POST["id_admin"];
	$username = $_POST["username"];
	$password = md5($_POST["password"]);
	$nama_admin= $_POST["nama_admin"];
	//buat variabel query update kedalam DB [jika update an foto baru / jika foto name <>'']
	
		$update = "UPDATE admin SET username = '$username', 
		password = '$password',
		nama_admin = '$nama_admin'
		WHERE
		id_admin = '$id_admin'";
			//Simpan kedalam db
		$qryupdate = mysql_query($update, $koneksi);	
		
	
	if($qryupdate){
	//pesan JS
	?>
		<script language="javascript">
        alert("Data User sukses terupdate");
        document.location = "?page=adm";
        </script>
    <?php
	//header("location:dokumen.php"); exit();		
	}
}

//buat hapus yaa
if(isset($_GET["id_admin"]))
{
$id_admin = $_GET["id_admin"];	
$hapus = mysql_query("DELETE FROM admin WHERE id_admin = '$id_admin'", $koneksi);
if($hapus){
	?>
    <script language="javascript">
	alert("Data admin sukses terhapus");
	document.location = "../?page=adm";
	</script>
    <?php
	}
}

?>