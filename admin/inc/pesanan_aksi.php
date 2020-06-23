<?php 
if(isset($_POST["hapus"]))
{
$id_order = $_POST["id_order"];	
$hapus = mysql_query("DELETE FROM orderan WHERE id_order = '$id_order'", $koneksi);
if($hapus){
	?>
    <script language="javascript">
	alert("Data Pesanan sukses terhapus");
	document.location = "?page=pesanan";
	</script>
    <?php
	}
}

?>