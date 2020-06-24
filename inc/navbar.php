<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
      <div class="container">
        <a class="navbar-brand" href="../">Sparepart Sepeda Motor</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a href="../" class="nav-link">Beranda</a></li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Kategori</a>
               <div class="dropdown-menu" aria-labelledby="dropdown04">
             <ul>
          <?php
            $mySql = "SELECT * FROM kategori ORDER BY nm_kategori";
            $myQry = mysql_query($mySql, $koneksi) or die("Gagal mengambil versi!");
            while($myData = mysql_fetch_array($myQry)) {
              $Kode = $myData['kd_kategori'];
            ?>

                <li><?php echo "<a  class='dropdown-item' href=?open=Barang-Kategori&Kode=$Kode>$myData[nm_kategori]</a>"; ?></li>
           <?php } ?>
          
          </ul>

              </div>

              <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Informasi</a>
              <div class="dropdown-menu" aria-labelledby="dropdown04">
                <a class="dropdown-item" href="carapembelian.php">Pembelian</a>
                <a class="dropdown-item" href="pengiriman.php">Pengiriman</a>
                <a class="dropdown-item" href="konfirmasi.php">Konfirmasi Pembayaran</a>
                <a class="dropdown-item" href="act_retur.php">Retur Barang</a>
              </div>

            </li>
            <li class="nav-item"><a href="tentangkami.php" class="nav-link">Tentang Kami</a></li>
            <li class="nav-item"><a href="?page=kontak" class="nav-link">Kontak Kami</a></li>
            <?php
            @session_start();
            include "koneksi.php";
            if(@$_SESSION['user']){
                $user_terlogin = @$_SESSION['user'];
                $sql_user = mysql_query("select * from pelanggan where kd_pelanggan = '$user_terlogin'") or die(mysql_error());
                $data_user = mysql_fetch_array($sql_user);

                $sql_kategori = mysql_query("SELECT * FROM kategori ORDER BY nm_kategori") or die(mysql_error());
                $data_kategori = mysql_fetch_array($sql_user);
            ?>   
            <li class="nav-item"><a href="transaksi_tampil.php" class="nav-link"><?php echo $data_user['nama_pelanggan'];?></a></li>
            <li class="nav-item"><a href="logout.php" class="nav-link">Logout</a></li>
            
            <?php } else { ?>
                
                <li class="nav-item"><a href="login.php" class="nav-link">LOGIN</a></li>
                <li class="nav-item"><a href="signup.php" class="nav-link">DAFTAR</a></li>

            <?php } ?>


            <li class="nav-item cta cta-colored"><a href="keranjang_belanja.php" class="nav-link"><span class="icon-shopping_cart"></span>[0]</a></li>

          </ul>
        </div>
      </div>
    </nav>
 </body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>
