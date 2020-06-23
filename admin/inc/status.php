<?php 

$no=$_POST["id_order"];
$update = "UPDATE orderan SET status = 'LUNAS'
		WHERE
		id_order = '$no'";
		//echo $update;exit();
			//Simpan kedalam db
		$qryupdate = mysql_query($update, $koneksi);	
		
		if($qryupdate){
	
	?>
		<script language="javascript">
        alert("Sudah Lunas");
        document.location = "?page=pesanan";
        </script>
    <?php
	}		
	?>