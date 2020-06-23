<?php
include("koneksi.php");

//buat hapus yaa
if(isset($_GET["id_konf"]))
{
$id_konf= $_GET["id_konf"];	
$hapus = mysql_query("DELETE FROM konfirmasi WHERE id_konf = '$id_konf'");
if($hapus){
	?>
    <script language="javascript">
	alert("Data konfirmasi sukses terhapus");
	document.location = "../?page=konfirmasi";
	</script>
    <?php
	}
}

?>