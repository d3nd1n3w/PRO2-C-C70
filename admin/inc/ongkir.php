<h2>
  <div align="center">DATA KOTA KIRIM</div></h2>
<br />
<br />

<form action="?page=ongkir_tambah" method="post">
	<input name="tambah_ongkir" type="submit" value="Tambah Kota Kirim" />
</form>
<BR />               

<table id="myTable" class="table table-striped table-bordered table-hover" id="dataTables-example" border="1">
                <thead>
                  <tr>
                    <th>Kode Kota</th>
                    <th>Nama Kota</th>
                    <th>Ongkos Kirim</th>
                    <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
				$ambilongkir = mysql_query("select * from kota_kirim", $koneksi);
				while($isiongkir = mysql_fetch_array($ambilongkir)){?>
                    <tr class="odd gradeX">
                    <td><?php echo $isiongkir["kd_kota"];?></td>
                     <td><?php echo $isiongkir["nm_kota"];?></td>
                    <td><?php echo $isiongkir["ongkir"];?></td>
                    <td width="130px">
                    <div style="float:left; padding-right:10px">
                        <form method="post" action="?page=ongkir_edit">
                            <input type="hidden" value="<?php echo $isiongkir["kd_kota"];?>" name="kd_kota">
                            <button type="submit" name="edit" class="btn btn-warning">Edit</button>
                        </form>
                    </div>
                    <div style="float:left">
                        <button class="btn btn-danger" onClick="hapus_ongkir(<?php echo $isiongkir["kd_kota"];?>)">Hapus</button>
                    </div>
                    </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>