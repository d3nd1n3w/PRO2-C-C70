<h2>
  <div align="center"> DATA PELANGGAN</div></h2>
<br />
<br />

<table id="myTable" class="table table-striped table-bordered table-hover" id="dataTables-example" border="1">
                <thead>
                  <tr>
                    <th>Kode Pelanggan</th>
                    <th>Nama </th>
                    <th>Jenis Kelamin </th>
                    <th>Alamat</th>
                     <th>Telepon</th>
                      <th>Email</th>
                       <th>Kota</th>
                        <th>Username</th>
                    <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
				$ambilpel = mysql_query("select * from pelanggan", $koneksi);
				while($isipel = mysql_fetch_array($ambilpel)){?>
                    <tr class="odd gradeX">
                    <td><?php echo $isipel["kd_pelanggan"];?></td>
                      <td><?php echo $isipel["nama_pelanggan"];?></td> 
                      <td><?php echo $isipel["jk"];?></td>
                       <td><?php echo $isipel["alamat"];?></td>
                        <td><?php echo $isipel["telp"];?></td>
                          <td><?php echo $isipel["email"];?></td>
                            <td><?php echo $isipel["nm_kota"];?></td>
                              <td><?php echo $isipel["username"];?></td>
                    <td width="130px">
                    <div style="float:left">
                        <button class="btn btn-danger" onClick="hapus_pel(<?php echo $isipel["kd_pelanggan"];?>)">Hapus</button>
                    </div>
                    </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>