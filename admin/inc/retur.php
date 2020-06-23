<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h2>
  <div align="center"> DATA RETUR BARANG</div></h2>
<br />
<br />
            <table id="mytable" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%" border="1">
                <thead>
                    <tr>
                    <th>Id Konfirmasi</th>
                    <th>Id Pesanan</th>
                    <th>Nama Barang</th>
                    <th>Keterangan </th>
                    <th>Tanggal Retur </th>
                    <th>Gambar</th>
                    <th>Aksi</th>                  
                    </tr>
                </thead>
                <tbody>
                <?php 
				$ambilkonfirmasi = mysql_query("select * from retur", $koneksi);
				while($isikonfirmasi = mysql_fetch_array($ambilkonfirmasi)){?>
                    <tr class="odd gradeX">
                    <form action="" method="post">
                    <td align="center"><?php echo $isikonfirmasi["id_retur"];?></td>
                    <td align="center"><?php echo $isikonfirmasi["id_order"];?></td>
                    <td align="center"><?php echo $isikonfirmasi["nm_barang"];?></td>
                    <td align="center"><?php echo $isikonfirmasi["ket"];?></td>
                    <td align="center"><?php echo $isikonfirmasi["tgl"];?></td>
                    <td align="center"><img width="100px" height="100px" src="../gambar/<?php echo $isikonfirmasi["gambar"];?>"/></td>
                    <!-- <td width="130px"> -->
                    </form>
                    <td width="130px">  
                    <div style="float:left; padding-right:20px">
                    <button class="btn btn-danger" onClick="hapus_konfirm(<?php echo $isikonfirmasi["id_retur"];?>)">Hapus</button>
                    </div>
                   
                    </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table><!--Akhir isi-->
        </div>
    </div>
</div>