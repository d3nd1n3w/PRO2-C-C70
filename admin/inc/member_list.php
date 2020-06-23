<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1>Data <small>User</small></h1>
            <table id="myTable" class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr>
                    <th>ID User</th>
                    <th>Username</th>
                    <th>Nama Lengkap</th>
                    <th>Belajar Sejak</th>
                    <th>Foto</th>
                    <th>Blokir</th>
                    <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
				$ambilmember = mysql_query("select * from user", $koneksi);
				while($isimember = mysql_fetch_array($ambilmember)){?>
                    <tr class="odd gradeX">
                    <td><?php echo $isimember["id_user"];?></td>
                    <td><?php echo $isimember["username"];?></td>
                    <td><?php echo $isimember["nama_lengkap"];?></td>
                    <td><?php echo $isimember["belajar_sejak"];?></td>
                    <td><?php echo "<img src='foto_user/".$isimember['gambar']."' width='100px' height='100px'/>";?></td>
                    <td><?php echo $isimember["blokir"];?></td>
                    <td width="130px">
                    <div style="float:left; padding-right:10px">
                        <form method="post" action="?page=user_edit">
                            <input type="hidden" value="<?php echo $isimember["id_user"];?>" name="id_user">
                            <button type="submit" name="edit" class="btn btn-warning">Edit</button>
                        </form>
                    </div>
                    <div style="float:left">
                        <button class="btn btn-danger" onClick="hapus_member(<?php echo $isimember["id_user"];?>)">Hapus</button>
                    </div>
                    </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table><!--Akhir isi-->
        </div>
    </div>
</div>