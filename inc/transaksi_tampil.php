<?php
session_start();
include_once "session.php";
include_once "koneksi.php";
include_once "library.php";

// Baca Kode Pelanggan yang Login
$KodePelanggan	= $_SESSION['user'];
?> 

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Sparepart Sepeda Motor</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">

    <link rel="stylesheet" href="../assets/css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/animate.css">
    
    <link rel="stylesheet" href="../assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../assets/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="../assets/css/magnific-popup.css">

    <link rel="stylesheet" href="../assets/css/aos.css">

    <link rel="stylesheet" href="../assets/css/ionicons.min.css">

    <link rel="stylesheet" href="../assets/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="../assets/css/jquery.timepicker.css">

    
    <link rel="stylesheet" href="../assets/css/flaticon.css">
    <link rel="stylesheet" href="../assets/css/icomoon.css">
    <link rel="stylesheet" href="../assets/css/style.css">
  </head>

  <?php include 'header.php'; ?>
<?php include 'navbar.php'; ?>
 <?php include 'sidebar.php'; ?>
<section class="ftco-section bg-light">
            <div class="container">
                      <div class="row justify-content-center mb-3 pb-3">
              <h1 align="center"><strong>DAFTAR PEMESANAN</strong></h1>


<section class="ftco-section ftco-cart">
      <div class="container">
        <div class="row">
          <div class="col-md-12 ftco-animate">
            <div class="cart-list">
              <table class="table">
                <thead class="thead-primary">
                  <tr class="text-center">
                    <th>No</th>
                    <th>No Pesan</th>
                    <th>Tanggal</th>
                    <th>Nama Penerima</th>
                    <th>Total (Rp.)</th>
                    <th>Biaya Kirim (RP.)</th>
                    <th>Status</th>
                    <th>Total Bayar</th>
                    <th>Aksi</th>
                  </tr>
                  <?php
  // Deklrasi variabel
  $biayaKirim = 0;
  $totalBayar   = 0;
  $digitHp  = "";
  $unikTransfer = 0;
  
  // Menampilkan semua data Pesanan Lunas (yang sudah lunas)
  $mySql = "SELECT orderan.*, pelanggan.nama_pelanggan, kota_kirim.ongkir
          FROM orderan
        LEFT JOIN pelanggan ON orderan.kd_pelanggan= pelanggan.kd_pelanggan 
        LEFT JOIN kota_kirim ON orderan.nm_kota=kota_kirim.kd_kota
        WHERE orderan.kd_pelanggan='$KodePelanggan' ORDER BY id_order";
  $myQry = @mysql_query($mySql, $koneksi) or die ("Gagal query".mysql_error());
  $nomor = 0;
  while ($myData =mysql_fetch_array($myQry)) {
  $nomor++;
  $Kode = $myData['id_order'];
  
  // Deklarasi variabel data
  $diskonHarga  = 0;
  $hargaDiskon  = 0;
  $totalHarga   = 0;
  $totalBarang  = 0;
  
  // Menampilkan data di pemesanan_item
  $hitungSql  = "SELECT SUM(harga * jumlah) As total_harga,
        SUM(jumlah) As total_barang FROM detail_order WHERE id_order='$Kode'";
  $hitungQry  = mysql_query($hitungSql, $koneksi) or die ("Gagal query 2 ".mysql_error());
  $hitungData = mysql_fetch_array($hitungQry);
  
  $totalHarga   = $hitungData['total_harga'];
  $totalBarang  = $hitungData['total_barang'];
  
  // Hitung total biaya kirim (Biaya Kirim Dikali dengan jumlah barang)
  $biayaKirim = $totalBarang * $myData['ongkir'];
  
  // Hitung total yang harus dibayar
  $totalBayar = $totalHarga + $biayaKirim;
  
  // Mengambil 3 digit terakhir nomor HP
  $digitHp  = substr($myData['telp'],-3);
  
  // Membuat nominal transfer
  $unikTransfer = substr($totalBayar,0,-3).$digitHp;
  ?>
    <tr> 
    <td align="center" bgcolor="#FFFFFF"><?php echo $nomor; ?></td>
      <td bgcolor="#FFFFFF"><?php echo $myData['id_order']; ?></td>
      <td bgcolor="#FFFFFF"><?php echo IndonesiaTgl($myData['tgl']); ?></td>
      <td bgcolor="#FFFFFF"><?php echo $myData['nama_pelanggan']; ?></td>
      <td align="right" bgcolor="#FFFFFF">Rp. <?php echo format_angka($totalHarga); ?></td>
      <td align="center" bgcolor="#FFFFFF">Rp. <?php echo format_angka($biayaKirim); ?></td>
       <?php 
      $sub  = $totalHarga +$biayaKirim;
    ?>
      <td align="center" bgcolor="#FFFFCC"><?php echo $myData['status']; ?></td>
  <td bgcolor="#FFFFFF">Rp.  <?php echo format_angka ($sub); ?></td>
   <td align="center" bgcolor="#FFFFCC"><a href="pesanan_lihat.php?Kode=<?php echo $Kode; ?>" target="_blank" alt="Lihat Data">Detail</a>      </td>
    </tr>
  <?php } ?>
                </thead>
              </table>
            </div>
          </div>
        </div>
  
</table>

  <table width="748" border="0" align="left">
    <tr>
      <td width="200">&nbsp;</td>
      </tr>
  
      <td colspan="4"><div align="left"></div></td>
      
      </tr>
    <tr>
      <div class=product-name">
      <td colspan="4"><div align="left">
        <p>LANJUTKAN TRANSAKSI PEMBAYARAN ANDA. </p>
        </div></td>
      
      </tr>
    <tr>
      <td colspan="4"><div align="left">
        <div align="left">
          <p>SILAHKAN TRANSFER PEMBAYARAN ANDA PADA SALAH SATU REKENING DIBAWAH INI , </p>
        </div>
        <p>REKENING ATAS NAMA : EKO RIZAL</p>
        <p>&nbsp; </p>
      </div></td>
      </tr>
    <tr>
      <td align="center"><img src="../gambar/bca.jpg" width="200" height="80" /></td>
      <td width="538" align="center"> <img src="../gambar/bni.jpg" width="200" height="80" /></td>
      </tr>
    <tr>
      <td align="center">625 015 2829</td>
      <td align="center">021 825 2144</td>
      </tr>   <tr>
        <td>&nbsp;</td>
        </tr>
    <tr>
      <td>&nbsp;</td>
      </tr>
    <tr>
      <td align="center"><img src="../gambar/bri.jpg" width="200" height="120" /></td>
      <td align="center"><img src="../gambar/mandiri.jpg" width="200" height="120" /></td>
      </tr>
    <tr>
      <td align="center">034 111 022 734 330</td>
      <td align="center">0700 001 897 993</td>
</tr>
  </table>
</div>
    </div>
</div>
</div>
<?php include 'footer.php'; ?>
<!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="../assets/js/jquery.min.js"></script>
  <script src="../assets/js/jquery-migrate-3.0.1.min.js"></script>
  <script src="../assets/js/popper.min.js"></script>
  <script src="../assets/js/bootstrap.min.js"></script>
  <script src="../assets/js/jquery.easing.1.3.js"></script>
  <script src="../assets/js/jquery.waypoints.min.js"></script>
  <script src="../assets/js/jquery.stellar.min.js"></script>
  <script src="../assets/js/owl.carousel.min.js"></script>
  <script src="../assets/js/jquery.magnific-popup.min.js"></script>
  <script src="../assets/js/aos.js"></script>
  <script src="../assets/js/jquery.animateNumber.min.js"></script>
  <script src="../assets/js/bootstrap-datepicker.js"></script>
  <script src="../assets/js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="../assets/js/google-map.js"></script>
  <script src="../assets/js/main.js"></script>


  </body>
</html>