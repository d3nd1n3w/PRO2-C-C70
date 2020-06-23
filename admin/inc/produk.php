<h2>
  <div align="center"> DATA PRODUK</div></h2>
<br />
<br />

<form action="?page=produk_tambah" method="post">
	<input name="tambah_produk" type="submit" value="Tambah Produk" />
</form>
<br />               

<table id="myTable" class="table table-striped table-bordered table-hover" id="dataTables-example" border="1">
                <thead>
                  <tr>
                    <th>Kode Produk</th>
                    <th>Nama Produk</th>
                     <th>Kategori</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Spesifikasi</th>
                    <th>Gambar</th>
                     <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
				$ambilbarang = mysql_query("select * from barang", $koneksi);
				while($isibarang = mysql_fetch_array($ambilbarang)){?>
                    <tr class="odd gradeX">
                    <td><?php echo $isibarang["kd_barang"];?></td>
                    <td><?php echo  $isibarang["nm_barang"];?></td>
                    <td><?php echo  $isibarang["kd_kategori"];?></td>
                    <td><?php echo  $isibarang["harga"];?></td>
                    <td><?php echo  $isibarang["stok"];?></td>
                    <td><?php echo  $isibarang["spesifikasi"];?></td>
                    <td><?php echo "<img src='../gambar/".$isibarang['gambar']."' width='100px' height='100px'/>";?></td>
                
                    <td width="130px">
                    <div style="float:left; padding-right:10px">
                        <form method="post" action="?page=produk_edit">
                            <input type="hidden" value="<?php echo $isibarang["kd_barang"];?>" name="kd_barang">
                            <button type="submit" name="edit" class="btn btn-warning">Edit</button>
                        </form>
                    </div>
                    <div style="float:left">
                        <button class="btn btn-danger" onClick="hapus_produk(<?php echo $isibarang["kd_barang"];?>)">Hapus</button>
                    </div>
                    </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>