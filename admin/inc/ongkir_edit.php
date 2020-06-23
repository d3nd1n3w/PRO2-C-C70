			<?php
			//cek post an dari list
			$kd_kota= $_POST["kd_kota"];
			$data=mysql_query("select * from kota_kirim where kd_kota='$kd_kota'", $koneksi);

			$kd_kota = mysql_result($data,0,"kd_kota");
			$nm_kota = mysql_result($data,0,"nm_kota");
			$ongkir = mysql_result($data,0,"ongkir");			
			
			?>
            
		
<h2>
  <div align="center"> EDIT KOTA KIRIM</div></h2>
<br />
<form role="form" method="post" action="?page=ongkir_aksi" enctype="multipart/form-data">							
 <table width="455" border="0" align="left">
    <tr>
      <td width="23%" align="left" valign="top">Kode Kota</td>
      <td width="3%" align="left" valign="top">:</td>
      <td width="74%" align="left" valign="top">
       <input class="form-control" value="<?php echo $kd_kota;?>" placeholder="Masukan Kode Kota" name="kd_kota" required></td>
    </tr>
    <tr>
      <td align="left" valign="top">Nama Kota</td>
      <td align="left" valign="top">:</td>
      <td align="left" valign="top">
     <input class="form-control" value="<?php echo $nm_kota;?>" placeholder="Masukan Nama Kota" name="nm_kota" required></td>
    </tr>
   <tr>
      <td align="left" valign="top">Ongkir</td>
      <td align="left" valign="top">:</td>
      <td align="left" valign="top">
      <input class="form-control" value="<?php echo $ongkir;?>" placeholder="Masukan Ongkos Kirim" name="ongkir" required></td>
    </tr>
    <tr>
                              <td colspan="3">  <button type="submit" class="btn btn-warning" name="update">Update</button>
								<button type="reset" class="btn btn-danger">Batal</button>
								<input type="hidden" name="kd_kota" value="<?php echo $kd_kota;?>"></td>
    </tr>
  </table>
</form>