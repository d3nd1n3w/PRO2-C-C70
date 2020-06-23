<?php
include("koneksi.php");

//buat hapus yaa
if(isset($_GET["kd_pelanggan"]))
{
$kd_pelanggan = $_GET["kd_pelanggan"];	
$hapus = mysql_query("DELETE FROM pelanggan WHERE kd_pelanggan = '$kd_pelanggan'");
if($hapus){
	?>
    <script language="javascript">
	alert("Data Pelanggan sukses terhapus");
	document.location = "../?page=pelanggan";
	</script>
    <?php
	}
}

?>