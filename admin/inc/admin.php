<h2><div align="center"> DATA ADMIN</div></h2>
<br />
<form action="?page=admin_tambah" method="post">
<input name="tambah_admin" type="submit" value="Tambah Admin" />
</form>
 <br />
 <br />
                

<table id="myTable" class="table table-striped table-bordered table-hover" id="dataTables-example" border="1" align="center">
                <thead>
                  <tr>
                    <th>ID User</th>
                    <th>Username</th>
                    <th>Nama Lengkap</th>
                    <!-- <th>Aksi</th> -->
                    </tr>
                </thead>
                <tbody>
                <?php 
				$ambiladmin = mysql_query("select * from admin", $koneksi);
				while($isiadmin = mysql_fetch_array($ambiladmin)){?>
                    <tr class="odd gradeX">
                    <td><?php echo $isiadmin["id_admin"];?></td>
                    <td><?php echo  $isiadmin["username"];?></td>
                    <td><?php echo  $isiadmin["nama_admin"];?></td>
                    <!-- <td width="130px">
                    <div style="float:left; padding-right:10px"> -->
                       <!--  <form method="post" action="?page=admin_edit">
                            <input type="hidden" value="<?php echo $isiadmin["id_admin"];?>" name="id_admin">
                            <button type="submit" name="edit" class="btn btn-warning">Edit</button>
                        </form>
                    </div>
                    <div style="float:left">
                        <button class="btn btn-danger" onClick="hapus_admin(<?php echo $isiadmin["id_admin"];?>)">Hapus</button>
                    </div> -->
                    <!-- </td>
                    </tr> -->
                <?php } ?>
                </tbody>
            </table>