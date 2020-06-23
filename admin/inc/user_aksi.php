<?php
include("koneksi.php");

//Jika ada tombol SIMPAN di klik maka tangkep semua post lalu simpan ke dalam db
if(isset($_POST["simpan"]))
{
	//cek apakah masih ada textbox yg nilainya kosong	
	if($_POST["id_pendaftaran"]=="" || $_POST["nm_dokumen"]=="" || $_FILES["file_dokumen"]["name"]=="" || $_POST["tgl_upload"]=="") { 
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
	$id_pendaftaran = $_POST["id_pendaftaran"];
	$nm_dokumen = $_FILES["file_dokumen"]["name"];
	$file_dokumen = $_FILES["file_dokumen"]["name"];
	$tgl_upload = $_POST["tgl_upload"];
	//buat variabel query Simpan kedalam DB
	$simpan = "INSERT INTO DOKUMEN(id_pendaftaran,nm_dokumen,file_dokumen,tgl_upload) 
VALUES
  (
    '$id_pendaftaran',
    '$nm_dokumen',
    '$file_dokumen',
    '$tgl_upload'
  )";
  
	//Simpan kedalam db
	$qrysimpan = mysql_query($simpan, $koneksi);
	if($qrysimpan){
		//UPLOAD GAMBAR KE FOLDER DOKUMEN
		copy ($_FILES["file_dokumen"]["tmp_name"],"dokumen/".$_FILES["file_dokumen"]["name"]);
	//pesan JS
	?>
		<script language="javascript">
        alert("Data sukses tersimpan");
        document.location = "dokumen_list.php";
        </script>
    <?php
	//header("location:dokumen.php"); exit();		
	}
}

//jik ada tombol update di klik
if(isset($_POST["update"]))
{
	//cek apakah masih ada textbox yg nilainya kosong
	if($_POST["id_user"]=="" || $_POST["username"]=="") { 
	//pesan JS
	?>
		<script language="javascript">
        alert("Data tidak lengkap");
        document.location = "?page=member";
        </script>
    <?php
	//header("location:dokumen.php"); 
	exit(); 
	}
	//print_r($_POST);exit();		
	//Jika sudah diisi semua, maka tangkep semua post
	$id_user = $_POST["id_user"];
	$username = $_POST["username"];
	$password = $_POST["password"];
	$email = $_POST["email"];
	$nama_lengkap = $_POST["nama_lengkap"];
	$lokasi = $_POST["lokasi"];
	$belajar_sejak = $_POST["belajar_sejak"];
	$gambar = $_FILES["gambar"]["name"];
	$blokir = $_POST["blokir"];
	
	//buat variabel query update kedalam DB [jika update an foto baru / jika foto name <>'']
	
	if($_FILES["gambar"]["name"]<>"" && $_POST["password"]<>""){
		//query dengan field foto		
		$update = "UPDATE user SET username = '$username', 
		password = md5('$password'), 
		email = '$email',
		nama_lengkap = '$nama_lengkap',
		lokasi = '$lokasi',
		belajar_sejak = '$belajar_sejak',
		gambar = '$gambar',
		blokir = '$blokir'
		WHERE
		id_user = '$id_user'";
		
		//update kedalam db
		$qryupdate = mysql_query($update, $koneksi);
		//UPDATE GAMBAR KE FOLDER DOKUMEN
		copy ($_FILES["gambar"]["tmp_name"],"foto_user/".$_FILES["gambar"]["name"]);	
	}elseif($_FILES["gambar"]["name"]<>"" && $_POST["password"]===""){
		//query dengan field foto		
		$update = "UPDATE user SET username = '$username', 
		email = '$email',
		nama_lengkap = '$nama_lengkap',
		lokasi = '$lokasi',
		belajar_sejak = '$belajar_sejak',
		gambar = '$gambar',
		blokir = '$blokir'
		WHERE
		id_user = '$id_user'";
		
		//update kedalam db
		$qryupdate = mysql_query($update, $koneksi);
		//UPDATE GAMBAR KE FOLDER DOKUMEN
		copy ($_FILES["gambar"]["tmp_name"],"foto_user/".$_FILES["gambar"]["name"]);	
	}elseif ($_FILES["gambar"]["name"]==="" && $_POST["password"]<>""){
		//Query tanpa field foto
		
		$update = "UPDATE user SET username = '$username', 
		password = md5('$password'), 
		email = '$email',
		nama_lengkap = '$nama_lengkap',
		lokasi = '$lokasi',
		belajar_sejak = '$belajar_sejak',
		blokir = '$blokir'
		WHERE
		id_user = '$id_user'";
			//Simpan kedalam db
		$qryupdate = mysql_query($update, $koneksi);	
		
	}else{
		$update = "UPDATE user SET username = '$username', 
		email = '$email',
		nama_lengkap = '$nama_lengkap',
		lokasi = '$lokasi',
		belajar_sejak = '$belajar_sejak',
		blokir = '$blokir'
		WHERE
		id_user = '$id_user'";
			//Simpan kedalam db
		$qryupdate = mysql_query($update, $koneksi);	
		
	
	}
	if($qryupdate){
	//pesan JS
	?>
		<script language="javascript">
        alert("Data User sukses terupdate");
        document.location = "?page=member";
        </script>
    <?php
	//header("location:dokumen.php"); exit();		
	}
}

//buat hapus yaa
if(isset($_GET["id_user"]))
{
$id_user = $_GET["id_user"];	
$hapus = mysql_query("DELETE FROM user WHERE id_user = '$id_user'", $koneksi);
if($hapus){
	?>
    <script language="javascript">
	alert("Data User sukses terhapus");
	document.location = "../?page=member";
	</script>
    <?php
	}
}

?>