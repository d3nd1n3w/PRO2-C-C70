			<?php
			//cek post an dari list
			$kd_kategori= $_POST["kd_kategori"];
			$data=mysql_query("select * from kategori where kd_kategori='$kd_kategori'", $koneksi);

			$kd_kategori = mysql_result($data,0,"kd_kategori");
			$nm_kategori = mysql_result($data,0,"nm_kategori");
			
			?>
            
		
<h2>
  <div align="center"> EDIT DATA KATEGORI</div></h2>
<br />
<br />
<form role="form" method="post" action="?page=kategori_aksi" enctype="multipart/form-data">							
<table width="400" border="0" align="left">
    <tr>
      <td align="left" valign="top">Kode Kategori</td>
      <td align="left" valign="top">:</td>
      <td align="left" valign="top"><input class="form-control" value="<?php echo $kd_kategori;?>" placeholder="Masukan Kode" name="kd_kategori" required></td>
    </tr>
    <tr>
      <td width="31%" align="left" valign="top">Kategori</td>
      <td width="2%" align="left" valign="top">:</td>
      <td width="67%" align="left" valign="top"><input class="form-control" value="<?php echo $nm_kategori;?>" placeholder="Masukan Kategori" name="nm_kategori" required>
        </span></td>
    </tr>
    <tr>
      <td align="left" valign="top">&nbsp;</td>
      <td align="left" valign="top">&nbsp;</td>
      <td align="left" valign="top">&nbsp;</td>
    </tr>
    <tr>
      <td align="left" valign="top">&nbsp;</td>
      <td align="left" valign="top">&nbsp;</td>
      <td align="left" valign="top">
      <button type="submit" class="btn btn-warning" name="update">Update</button>
								<button type="reset" class="btn btn-danger">Batal</button>
								<input type="hidden" name="kd_kategori" value="<?php echo $kd_kategori;?>">
        </span></td>
    </tr>
  </table>	
</form>