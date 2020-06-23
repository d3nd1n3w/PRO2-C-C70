<h2>
  <div align="center"> DATA KATEGORI</div></h2>
<br />
<br />

<form action="?page=kategori_tambah" method="post">
	<input name="tambah_kategori" type="submit" value="Tambah Kategori" />
</form>
<br />
                

<table id="myTable" class="table table-striped table-bordered table-hover" id="dataTables-example" border="1">
                <thead>
                  <tr>
                    <th>Kode Kategori</th>
                    <th>Kategori</th>
                    <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
				$ambilkategori = mysql_query("select * from kategori", $koneksi);
				while($isikategori = mysql_fetch_array($ambilkategori)){?>
                    <tr class="odd gradeX">
                    <td><?php echo $isikategori["kd_kategori"];?></td>
                    <td><?php echo  $isikategori["nm_kategori"];?></td>
                    <td width="130px">
                    <div style="float:left; padding-right:10px">
                        <form method="post" action="?page=kategori_edit">
                            <input type="hidden" value="<?php echo $isikategori["kd_kategori"];?>" name="kd_kategori">
                            <button type="submit" name="edit" class="btn btn-warning">Edit</button>
                        </form>
                    </div>
                    <div style="float:left">
                        <button class="btn btn-danger" onClick="hapus_kategori(<?php echo $isikategori["kd_kategori"];?>)">Hapus</button>
                    </div>
                    </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>