<h2>
  <div align="center">DATA PESANAN</div></h2>
<br />
<br />
<table id="mytable" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%" border="1">
              <thead>
                    <tr>
                    <th>No pesanan</th>
                    <th>Tgl Pemesanan</th>
                    <th>Kode Pelanggan</th>
                    <th> Kode Kota </th> 
                    <th>Nama Penerima</th>
                    <th>Alamat</th>
                    <th>No Telpon</th>
                    <th> Kode Pos </th>  
                    <th>Status</th>
                    <th> Aksi </th>                    
                    </tr>
                </thead>
                <tbody>
                <?php 
				$ambilpesanan = mysql_query("select * from orderan", $koneksi);
				while($isipesanan = mysql_fetch_array($ambilpesanan)){?>
                    <tr class="odd gradeX">
					<form action="" method="post">
					<input type="hidden" name="no_pemesanan" value="<?php echo $isipesanan["id_order"];?>">
                    <td align="center"><?php echo $isipesanan["id_order"];?></td>
                    <td align="center"><?php echo $isipesanan["tgl"];?></td>
                    <td align="center"><?php echo $isipesanan["kd_pelanggan"];?></td>
                     <td align="center"><?php echo $isipesanan["nm_kota"];?></td>
                    <td align="center"><?php echo $isipesanan["nama_pelanggan"];?></td>
                     <td align="center"><?php echo $isipesanan["alamat"];?></td>
                    <td align="center"><?php echo $isipesanan["telp"];?></td>
                    <td  align="center"><?php echo $isipesanan["pos"];?></td>
                    <td align="center"><?php echo $isipesanan["status"];?></td>
                    </form>
                    <td width="130px">
                    <div style="float:left; padding-right:10px">
                    <?php if($isipesanan['status']=="PESAN") { ?>
                    
                    <a href="?page=pesanan_bayar&Aksi=LUNAS&Kode=<?php echo $isipesanan['id_order']; ?>" targer="_blank"><strong>Lunaskan</strong></a>
                    <?php } else { ?>
                    <a href="?page=pesanan_bayar&Aksi=PESAN&Kode=<?php echo $isipesanan['id_order']; ?>" targer="_blank"><strong>Batalkan</strong></a>
                     <?php }  ?> 
                      <form method="post" action="?page=pesanan_aksi">
                            <input type="hidden" value="<?php echo $isipesanan["id_order"];?>" name="id_order">
                            <button type="submit" name="hapus" class="btn btn-danger">Hapus</button>
                        </form>
						
                    </div>
                    </td>
                    </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table><!--Akhir isi-->