<?php
include_once "inc/koneksi.php";
include_once "inc/library.php";

# Nomor Halaman (Paging)
$baris = 12;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 1;
$pageSql = "SELECT * FROM barang";
$pageQry = mysql_query($pageSql, $koneksi) or die ("error paging: ".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$maks	 = ceil($jml/$baris);
$mulai	= $baris * ($hal-1); 
?>
<html>
<head>
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">


    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="author" content="colorlib.com">
    <link href="assets/search/https:/fonts.googleapis.com/css?family=Poppins" rel="stylesheet" />
    <link href="assets/search/css/main.css" rel="stylesheet" />



    <link rel="stylesheet" href="assets/css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">

    <link rel="stylesheet" href="assets/css/aos.css">

    <link rel="stylesheet" href="assets/css/ionicons.min.css">

    <link rel="stylesheet" href="assets/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="assets/css/jquery.timepicker.css">

    
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <link rel="stylesheet" href="assets/css/icomoon.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="../style/style_barang.css" rel="stylesheet" type="text/css">
</head>
<body>
  <div class="container-login100" style="background-image: url('../assets/login/images/bg-01.jpg');">
	 <section class="ftco-section bg-light">
				<div class="row justify-content-center mb-3 pb-3">
          <div class="col-md-12 heading-section text-center ftco-animate">
            <h2 class="mb-4">MUDAH DAN TERLENGKAP</h2>
            <p>Original Tanpa Batas</p>
          </div>
        </div>   		
    	</div>
    </section>

<!-- 
<form action="?page=pencarian" method="post" id="search-form" novalidate="novalidate">
              <input name="txtKeyword" type="text"  placeholder="Search.." autocomplete="off" class="selected">
              <input type="submit" name="btnCari" class="turqouise" value="Cari">
          </form> -->


<div class="container">
    <div class="s130">
      <form action="?page=pencarian" method="post" id="search" novalidate="novalidate">
        <div class="inner-form">
          <div class="input-field first-wrap">
            <div class="svg-wrapper">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path>
              </svg>
            </div>
            <input name="txtKeyword" type="text" placeholder="Cari" />
          </div>
          <div class="input-field second-wrap">
            <button  type="submit" name="btnCari" class="btn-search">SEARCH</button>
          </div>
        </div>
<!--         <span class="info">ex. Game, Music, Video, Photography</span> -->
      </form>
    </div>
    <script src="assets/search/js/extention/choices.js"></script>

    		<div class="row">
    			<?php
// Menampilkan daftar barang
$barangSql = "SELECT barang.*,  kategori.nm_kategori FROM barang 
			LEFT JOIN kategori ON barang.kd_kategori=kategori.kd_kategori 
			ORDER BY barang.kd_barang DESC LIMIT $mulai, $baris";
$barangQry = mysql_query($barangSql, $koneksi) or die ("Gagal Query".mysql_error()); 
$nomor = 0;
while ($barangData = mysql_fetch_array($barangQry)) {
	$nomor++;
	$KodeBarang = $barangData['kd_barang'];
	$KodeKategori = $barangData['kd_kategori'];
	
	// Membaca file gambar
	if ($barangData['gambar']=="") {
		$fileGambar = "noimage.jpg";
	}
	else {
		$fileGambar	= $barangData['gambar'];


	// Warna baris data
	if($nomor%2==1) { $warna=""; } else {$warna="#F5F5F5";}
	}
?>
    			<div class="col-sm-12 col-md-6 col-lg-3 ftco-animate d-flex">
    				<div class="product d-flex flex-column">
    					<a href="?open=Barang-Lihat&Kode=<?php echo $KodeBarang; ?>" class="img-prod"><img class="img-fluid" src="gambar/<?php echo $fileGambar; ?>" alt="Colorlib Template">
    						<div class="overlay"></div>
    					</a>
    					<div class="text py-3 pb-4 px-3">
    	<h3><a href="?open=Barang-Lihat&Kode=<?php echo $KodeBarang; ?>"><?php echo $barangData['nm_barang']; ?></a></h3>
    						<div class="pricing">
	    						<p class="price"><span>Rp. <?php echo format_angka($barangData['harga']); ?></span></p>
	    					</div>
	    					<p class="bottom-area d-flex px-3">
	    						<a href="?open=Barang-Beli&Kode=<?php echo $KodeBarang; ?>" class="add-to-cart text-center py-2 mr-1"><span>Add to cart <i class="ion-ios-add ml-1"></i></span></a>
                  <?php
    if($barangData['stok'] == 0){
    ?>
      <div class="tombol_habis">
        <a href="#"><strong><font size="+1">Stok Habis</font></strong></a>
      </div>  
  <?php
    }else{
    ?>
   							<a href="?open=Barang-Beli&Kode=<?php echo $KodeBarang; ?>" class="buy-now text-center py-2">Beli<span><i class="ion-ios-cart ml-1"></i></span></a>
          <div class="btn btn-primary">      
    <a href="?open=Barang-Lihat&Kode=<?php echo $KodeBarang; ?>">
      Detail
    </a>
  </div>

 
<?php } ?>
    						</p>
    					</div>
    				</div>
    			</div>
    </section>
<?php } ?>



		</div>
	</div>
</div>
<center>
<div id="halaman">
  <p>
    <b>Halaman:
        <?php
        for ($h = 1; $h <= $maks; $h++) {
          echo "[  <a href='?hal=$h'>$h</a> ]";
        }
      ?>
      </b>
    </p>
</div>
</center>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>

</body>
</html>
