			<?php
			//cek post an dari list
			$id_user = $_POST["id_user"];
			$data=mysql_query("select * from user where id_user='$id_user'", $koneksi);

			$id_user = mysql_result($data,0,"id_user");
			$username = mysql_result($data,0,"username");
			$password = mysql_result($data,0,"password");
			$email = mysql_result($data,0,"email");
			$nama_lengkap = mysql_result($data,0,"nama_lengkap");
			$lokasi = mysql_result($data,0,"lokasi");
			$belajar_sejak = mysql_result($data,0,"belajar_sejak");
			$gambar = mysql_result($data,0,"gambar");
			$blokir = mysql_result($data,0,"blokir");
			
			?>
            
		
<div id="page-wrapper">
    <div class="row">
	    <div class="col-lg-12">
	        <h1>Halaman <small>Edit Data User</small></h1>
				
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Edit Data User</div>
					<div class="panel-body">
						<div class="col-md-12">
							<form role="form" method="post" action="?page=user_aksi" enctype="multipart/form-data">							
								<div class="form-group">
									<label>Username</label>
									<input class="form-control" value="<?php echo $username;?>" placeholder="Masukan Username" name="username" required>
								</div>
							
								<div class="form-group">
									<label>Password</label>
									<input class="form-control" value="" placeholder="Masukan Password" name="password">
									note : Password Kosongkan jika tidak di edit
								</div>

								<div class="form-group">
									<label>Konfirmasi Password</label>
									<input class="form-control" value="" placeholder="Masukan Ulang Password" name="password_konfirmasi" >
								</div>

								<div class="form-group">
									<label>Email</label>
									<input class="form-control" value="<?php echo $email;?>" placeholder="Masukan Email" name="email" type="email" required>
								</div>
                                
						 		<div class="form-group">
									<label>Nama Lengkap</label>
									<input class="form-control" value="<?php echo $nama_lengkap;?>" placeholder="Masukan nama lengkap" name="nama_lengkap" required>
								</div>
                                
                                <div class="form-group">
									<label>Lokasi</label>
									<input class="form-control" value="<?php echo $lokasi;?>" placeholder="Masukan lokasi" name="lokasi" required>
								</div>

								<div class="form-group">
									<label>Belajar Sejak</label>
									<input class="form-control" value="<?php echo $belajar_sejak;?>" placeholder="Masukan belajar" name="belajar_sejak" required>
									note : yyyy-mm-dd
								</div>

								<div class="form-group">
                                <img src="foto_user/<?php echo $gambar;?>"width="50">
									<label>Gambar</label>
									<input type="file" name="gambar" placeholder="Upload Gambar">
                         		</div>
                                

								<div class="form-group">
									<label>Blokir</label>
								<select name="blokir">    
								<?php
								if ($blokir === "Y"){
									?>
									<option value="Y">Y</option>    
									<option value="N">N</option>    
									<?php
								}else{
									?>
									<option value="N">N</option>    
									<option value="Y">Y</option>    
									<?php
								}
								?>
								</select>   	
								</div>

								<button type="submit" class="btn btn-warning" name="update">Update</button>
								<button type="reset" class="btn btn-danger">Batal</button>
								<input type="hidden" name="id_user" value="<?php echo $id_user;?>">
                                </form>
							</div>
						</form>
					</div>
				</div>
			</div><!-- /.col-->
		</div><!-- /.row -->
		
	</div><!--/.main-->
