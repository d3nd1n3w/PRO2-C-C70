			<?php
			//cek post an dari list
			$id_admin= $_POST["id_admin"];
			$data=mysql_query("select * from admin where id_admin='$id_admin'", $koneksi);

			$id_user = mysql_result($data,0,"id_admin");
			$username = mysql_result($data,0,"username");
			$password = mysql_result($data,0,"password");
			$nama_admin = mysql_result($data,0,"nama_admin");
			
			
			?>
            
		
<h2>
  <div align="center"> EDIT DATA ADMIN</div></h2>
<br />
<br />

<form role="form" method="post" action="?page=admin_aksi" enctype="multipart/form-data">							
 <table width="372" border="0">
 
 <tr>
<td width="167">Username</td>
<td width="26">:</td>
<td width="165"><input class="form-control" value="<?php echo $username;?>" placeholder="Masukan Username" name="username" required></td>
</tr>

<tr>
<td><label>Password</label></td>
<td>:</td>
									<td><input class="form-control" value="" placeholder="Masukan Password" name="password"></td>
</tr>
									
<tr>								
<td><label>Konfirmasi Password</label></td>
<td>:</td>
<td><input class="form-control" value="" placeholder="Masukan Ulang Password" name="password_konfirmasi" ></td>
</tr>

<tr>								
<td><label>Nama Lengkap</label></td>
<td>:</td>
<td><input class="form-control" value="<?php echo $nama_admin;?>" placeholder="Masukan nama lengkap" name="nama_admin" required></td>
</tr>
</table>
<br />

                              
								<button type="submit" class="btn btn-warning" name="update">Update</button>
								<button type="reset" class="btn btn-danger">Batal</button>
								<input type="hidden" name="id_admin" value="<?php echo $id_admin;?>">
</form>
							</div>
</form>