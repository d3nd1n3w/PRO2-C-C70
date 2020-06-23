<h2>
  <div align="center"> TAMBAH DATA PRODUK</div></h2>
<br />
<br />

<title>tokojaket</title>
<form id="form1" name="form1" method="post" action="?page=produk_aksi" enctype="multipart/form-data">
  <table width="600" border="0" align="left">
 
  <tr>
      <td width="32%" align="left" valign="top">Kode Produk </td>
      <td width="3%" align="left" valign="top">:</td>
      <td width="65%" align="left" valign="top"><label>
        <input name="kd_barang" type="text" id="kd_barang" />
      </label>
        </span></td>
    </tr>
    <tr>
      <td width="32%" align="left" valign="top">Nama Produk </td>
      <td width="3%" align="left" valign="top">:</td>
      <td width="65%" align="left" valign="top"><label>
        <input name="nm_barang" type="text" id="nm_barang" />
      </label>
        </span></td>
    </tr>
    <tr>
      <td align="left" valign="top">Kategori</td>
      <td align="left" valign="top">:</td>
      <td align="left" valign="top"><label for="kategori"></label>
        <label for="kategori"></label>
        <select name="kategori" size="1" id="kategori">
            
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
      <td align="left" valign="top"><label for="harga"></label>
      <input type="text" name="harga" id="harga" /></td>
    </tr>
     <tr>
      <td align="left" valign="top">Stock</td>
      <td align="left" valign="top">:</td>
      <td align="left" valign="top"><label for="stok"></label>
      <input type="text" name="stok" id="stok" /></td>
    </tr>
    <tr>
      <td align="left" valign="top">Spesifikasi</td>
      <td align="left" valign="top">:</td>
      <td align="left" valign="top"><label></label>
        <label></label>
        <label>
          <textarea name="spek" cols="25" rows="3" id="spek"></textarea>
        </label></td>
    </tr>
    <tr>
      <td align="left" valign="top">Gambar</td>
      <td align="left" valign="top">:</td>
      <td align="left" valign="top"><label for="gambar"></label>
      <input name="gambar" type="file" /></td>
    </tr>
    <tr>
      <td align="left" valign="top">&nbsp;</td>
      <td align="left" valign="top">&nbsp;</td>
      <td align="left" valign="top"><p>&nbsp;</p></td>
    </tr>
    <tr>
      <td align="left" valign="top">&nbsp;</td>
      <td align="left" valign="top">&nbsp;</td>
      <td align="left" valign="top">&nbsp;</td>
    </tr>
    <tr>
      <td align="left" valign="top">&nbsp;</td>
      <td align="left" valign="top">&nbsp;</td>
      <td align="left" valign="top"><label>
        <input type="submit" name="simpan" value="Simpan" />
      </label>
        <label>
          <input type="reset" name="batal" value="Batal" />
        </label>
        </span></td>
    </tr>
  </table>
</form>