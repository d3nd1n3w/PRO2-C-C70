<?php
include_once "koneksi.php";
include_once "library.php";

$filterSql  = "";
// Membaca variabel form
$KeyWord  = isset($_GET['KeyWord']) ? $_GET['KeyWord'] : '';
$txtKeyword = isset($_POST['txtKeyword']) ? $_POST['txtKeyword'] : $KeyWord;

// Jika tombol Cari diklik
if(isset($_POST['btnCari'])){
  if($_POST) {
         // Skrip pencarian
    $filterSql = "WHERE nm_barang LIKE '%$txtKeyword%' OR nm_barang LIKE '$txtKeyword%'";
  }
}
else {
  if($KeyWord){
         // Skrip pencarian
    $filterSql = "WHERE nm_barang LIKE '%$txtKeyword%' OR nm_barang LIKE '$txtKeyword%'";
  }
  else {
    $filterSql = "";
  }
} 

# Nomor Halaman (Paging)
$baris  = 6;
$hal  = isset($_GET['hal']) ? $_GET['hal'] : 1;
$pageSql= "SELECT * FROM barang $filterSql ORDER BY kd_barang DESC";
$pageQry= mysql_query($pageSql, $koneksi) or die ("error paging: ".mysql_error());
$jml  = mysql_num_rows($pageQry);
$maks = ceil($jml/$baris);
$mulai  = $baris * ($hal-1);
?>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="author" content="colorlib.com">
    <link href="assets/search/https:/fonts.googleapis.com/css?family=Poppins" rel="stylesheet" />
    <link href="assets/search/css/main.css" rel="stylesheet" />


</head>
<body>

<section class="ftco-section bg-light">
    
        <div class="row justify-content-center mb-3 pb-3">
          <div class="col-md-12 heading-section text-center ftco-animate">
            <h2 class="mb-4">MUDAH DAN TERLENGKAP</h2>
            <p>Original Tanpa Batas</p>
          </div>
        </div>      
      </div>

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


    <strong>HASIL PENCARIAN </strong> " <?php echo $txtKeyword; ?> "</td>
   <div class="row"> 
<?php
// Menampilkan daftar barang
$barang2Sql = "SELECT barang.*,  kategori.nm_kategori FROM barang 
      LEFT JOIN kategori ON barang.kd_kategori=kategori.kd_kategori 
      $filterSql 
      ORDER BY barang.kd_barang ASC LIMIT $mulai, $baris";
$barang2Qry = mysql_query($barang2Sql, $koneksi) or die ("Gagal Query".mysql_error()); 
$nomor = 0;

while ($barang2Data = mysql_fetch_array($barang2Qry)) {
  $nomor++;
  $KodeBarang = $barang2Data['kd_barang'];
  $KodeKategori = $barang2Data['kd_kategori'];
  
  // Menampilkan gambar utama
  if ($barang2Data['gambar']=="") {
    $fileGambar = "noimage.jpg";
  }
  else {
    $fileGambar = $barang2Data['gambar'];
  }
  
?>

          <div class="col-sm-12 col-md-6 col-lg-3 ftco-animate d-flex">
            <div class="product d-flex flex-column">
              <a href="?open=Barang-Lihat&Kode=<?php echo $KodeBarang; ?>" class="img-prod"><img class="img-fluid" src="gambar/<?php echo $fileGambar; ?>" alt="Colorlib Template">
                <div class="overlay"></div>
              </a>
              <div class="text py-3 pb-4 px-3">
      <h3><a href="?open=Barang-Lihat&Kode=<?php echo $KodeBarang; ?>"><?php echo $barang2Data['nm_barang']; ?></a></h3>
                <div class="pricing">
                  <p class="price"><span>Rp. <?php echo format_angka($barang2Data['harga']); ?></span></p>
                </div>
                <div class="jrk"></div>
 <?php
    if($barang2Data['stok'] == 0){
    ?>
      <div class="tombol_habis">
        <a href="#"><strong><font size="+1">Stok Habis</font></strong></a>
      </div>  
  <?php
    }else{
    }
    ?>
                <p class="bottom-area d-flex px-3">
                  <a href="#" class="add-to-cart text-center py-2 mr-1"><span>Add to cart <i class="ion-ios-add ml-1"></i></span></a>
                <a href="?open=Barang-Beli&Kode" class="buy-now text-center py-2">Beli<span><i class="ion-ios-cart ml-1"></i></span></a>
                </p>
              </div>
            </div>
          </div>
    </section>
<?php } ?>

<div id="clear"></div>

<div id="halaman">
  <b>Halaman:
    <?php
    for ($h = 1; $h <= $maks; $h++) {
      echo "[  <a href='?open=Barang-Pencarian&KeyWord=$txtKeyword&hal=$h'>$h</a> ]";
    }
  ?>
    </b>
</div>

</div>
</div>
</div>
</body>
</html>