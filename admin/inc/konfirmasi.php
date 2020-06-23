<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h2>
  <div align="center"> DATA KONFIRMASI</div></h2>
<br />
<br />
            <table id="mytable" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%" border="1">
                <thead>
                    <tr>
                    <th>Id Konfirmasi</th>
                    <th>Id Pesanan</th>
                    <th>Nama Pelanggan</th>
                    <th>Jumlah Transfer</th>
                    <th>Keterangan </th>
                    <th>Tanggal Transfer </th>
                    <th>Gambar</th>
                    <th> Aksi</th>                  
                    </tr>
                </thead>
                <tbody>
                <?php 
				$ambilkonfirmasi = mysql_query("select * from konfirmasi", $koneksi);
				while($isikonfirmasi = mysql_fetch_array($ambilkonfirmasi)){?>
                    <tr class="odd gradeX">
                    <td align="center"><?php echo $isikonfirmasi["id_konf"];?></td>
                    <td align="center"><?php echo $isikonfirmasi["id_order"];?></td>
                    <td align="center"><?php echo $isikonfirmasi["nm_pelanggan"];?></td>
                    <td align="center">Rp. <?php echo $isikonfirmasi["jml_tf"];?></td>
                    <td align="center"><?php echo $isikonfirmasi["ket"];?></td>
                    <td align="center"><?php echo $isikonfirmasi["tgl"];?></td>
                    <td align="center"><img width="100px" height="100px" src="../gambar/<?php echo $isikonfirmasi["gambar"];?>"/></td>
                    <td width="130px">
                    <div style="float:left; padding-right:10px">
                            <button class="btn btn-danger" onClick="hapus_konf(<?php echo $isikonfirmasi["id_konf"];?>)">Hapus</button>
                    </div>
                   
                    </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table><!--Akhir isi-->
        </div>
    </div>
</div>