<?php
include("koneksi.php");

//buat hapus yaa
if(isset($_GET["id_konf"]))
{
$id_konf= $_GET["id_konf"];	
$hapus = mysql_query("DELETE FROM retur WHERE id_retur = '$id_konf'");
if($hapus){
	?>
    <script language="javascript">
	alert("Data Retur sukses terhapus");
	document.location = "../?page=retur_brg";
	</script>
    <?php
	}
}

?>