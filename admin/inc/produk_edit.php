				<?php
			//cek post an dari list
			$kd_barang= $_POST["kd_barang"];
			$data=mysql_query("select * from barang where kd_barang='$kd_barang'", $koneksi);

			$kd_barang = mysql_result($data,0,"kd_barang");
			$nama = mysql_result($data,0,"nm_barang");
			$kategori= mysql_result($data,0,"kd_kategori");
			$harga = mysql_result($data,0,"harga");
			$stok = mysql_result($data,0,"stok");
			$spek= mysql_result($data,0,"spesifikasi");
			$gambar = mysql_result($data,0,"gambar");
			
			
			?>
            
		
<h2>
  <div align="center"> EDIT DATA PRODUK</div></h2>
<br />
<br />
<form role="form" method="post" action="?page=produk_aksi" enctype="multipart/form-data">							
 <table width="455" border="0" align="left">
    <tr>
      <td width="23%" align="left" valign="top">Kode Produk</td>
      <td width="3%" align="left" valign="top">:</td>
      <td width="74%" align="left" valign="top">
       <input class="form-control" value="<?php echo $kd_barang;?>" placeholder="Masukan Kode Barang" name="kd_barang" required></td>
    </tr>
    <tr>
      <td align="left" valign="top">Nama Produk</td>
      <td align="left" valign="top">:</td>
      <td align="left" valign="top">
     <input class="form-control" value="<?php echo $nama;?>" placeholder="Masukan Nama Produk" name="nm_barang" required></td>
    </tr>
    <tr>
      <td align="left" valign="top">Kategori</td>
      <td align="left" valign="top">:</td>
      <td align="left" valign="top"><select name="kategori" size="1" id="kategori">
            
<?php
$kat=mysql_query("SELECT * FROM kategori ORDER BY kd_kategori DESC");
while($k=mysql_fetch_array($kat))
{
echo "<option value=$k[kd_kategori]>$k[nm_kategori]</option>";
}
?>
</select></td>
    </tr>
    <tr>
      <td align="left" valign="top">Harga</td>
      <td align="left" valign="top">:</td>
      <td align="left" valign="top">
      <input class="form-control" value="<?php echo $harga;?>" placeholder="Masukan Harga" name="harga" required></td>
    </tr>
    <tr>
      <td align="left" valign="top">Stock</td>
      <td align="left" valign="top">:</td>
      <td align="left" valign="top">
      <input class="form-control" value="<?php echo $stok;?>" placeholder="Masukan Stok Produk" name="stok" required></td>
    </tr>
    <tr>
      <td align="left" valign="top">Spesifikasi</td>
      <td align="left" valign="top">:</td>
      <td align="left" valign="top"><textarea name="spesifikasi" cols="30" rows="5" id="spesifikasi"><?php echo "$spek" ?>   </textarea>
    </td>
    </tr>
    <tr>
      <td align="left" valign="top">Gambar</td>
      <td align="left" valign="top">:</td>
      <td align="left" valign="top">
      <input type="file" name="gambar" placeholder="Upload Gambar"></td>
    </tr>
    <tr>
                              <td colspan="3">  <button type="submit" class="btn btn-warning" name="update">Update</button>
								<button type="reset" class="btn btn-danger">Batal</button>
								<input type="hidden" name="kd_barang" value="<?php echo $kd_barang;?>"></td>
    </tr>
  </table>
</form>