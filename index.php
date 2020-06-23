<?php
ob_start();
session_start();
include "inc/koneksi.php";
include "inc/library.php"
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>C70-PROGATE</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">

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
  </head>
  <body class="goto-here">
<?php include 'inc/header.php'; ?>
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
	      <a class="navbar-brand" href="index.php">C70-PROGATE</a>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>

	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
	          <li class="nav-item"><a href="index.php" class="nav-link">Beranda</a></li>
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
                <a class="dropdown-item" href="inc/carapembelian.php">Pembelian</a>
                <a class="dropdown-item" href="inc/pengiriman.php">Pengiriman</a>
                <a class="dropdown-item" href="inc/konfirmasi.php">Konfirmasi Pembayaran</a>
                <a class="dropdown-item" href="inc/act_retur.php">Retur Barang</a>
              </div>

            </li>
	          <li class="nav-item"><a href="inc/tentangkami.php" class="nav-link">Tentang Kami</a></li>
	          <li class="nav-item"><a href="inc/contact.php" class="nav-link">Kontak Kami</a></li>
            <?php
            @session_start();
            include "inc/koneksi.php";
            if(@$_SESSION['user']){
                $user_terlogin = @$_SESSION['user'];
                $sql_user = mysql_query("select * from pelanggan where kd_pelanggan = '$user_terlogin'") or die(mysql_error());
                $data_user = mysql_fetch_array($sql_user);

                $sql_kategori = mysql_query("SELECT * FROM kategori ORDER BY nm_kategori") or die(mysql_error());
                $data_kategori = mysql_fetch_array($sql_user);
            ?>   
            <li class="nav-item"><a href="inc/transaksi_tampil.php" class="nav-link"><?php echo $data_user['nama_pelanggan'];?></a></li>
            <li class="nav-item"><a href="inc/logout.php" class="nav-link">Logout</a></li>
            
            <?php } else { ?>
                
                <li class="nav-item"><a href="inc/login.php" class="nav-link">LOGIN</a></li>
                <li class="nav-item"><a href="inc/signup.php" class="nav-link">DAFTAR</a></li>

            <?php } ?>


	          <li class="nav-item cta cta-colored"><a href="inc/keranjang_belanja.php" class="nav-link"><span class="icon-shopping_cart"></span>[0]</a></li>

	        </ul>
	      </div>
	    </div>
	  </nav>
 </body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>

    <section id="home-section" class="hero">
		  <div class="home-slider owl-carousel">
	      <div class="slider-item js-fullheight">
	      	<div class="overlay"></div>
	        <div class="container-fluid p-0">
	          <div class="row d-md-flex no-gutters slider-text align-items-center justify-content-end" data-scrollax-parent="true">
	          	<img class="one-third order-md-last img-fluid" src="assets/images/logo_sperti.png" alt="">
		          <div class="one-forth d-flex align-items-center ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
		          	<div class="text">
		          		<span class="subheading">#C70-PROGATE</span>
		          		<div class="horizontal">
				            <h2 class="mb-4 mt-3">C70-PROGATE</h2>
				            <p class="mb-4">Pastikan anda membeli sesuai kebutuhan anda dan di jamin berkualitas.</p>
				            
				            <p><a href="index.php" class="btn-custom">Belanja Sekarang</a></p>
				          </div>
		            </div>
		          </div>
	        	</div>
	        </div>
	      </div>


	      <div class="slider-item js-fullheight">
	      	<div class="overlay"></div>
	        <div class="container-fluid p-0">
	          <div class="row d-flex no-gutters slider-text align-items-center justify-content-end" data-scrollax-parent="true">
	          	<img class="one-third order-md-last img-fluid" src="assets/images/logo_sper.png" alt="">
		          <div class="one-forth d-flex align-items-center ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
		          	<div class="text">
		          		<span class="subheading">#C70-PROGATE</span>
		          		<div class="horizontal">
				            <h3 class="mb-4 mt-3">C70-PROGATE</h3>
				            <p class="mb-4">Banyak Terdapat Koleksi terbaru.</p>
				            
				            <p><a href="index.php" class="btn-custom">Belanja Sekarang</a></p>
				          </div>
		            </div>
		          </div>
	        	</div>
	        </div>
	      </div>
	    </div>
    </section>

    <section class="ftco-section ftco-no-pt ftco-no-pb">
			<div class="container">
				<div class="row no-gutters ftco-services">
          <div class="col-lg-4 text-center d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services p-4 py-md-5">
              <div class="icon d-flex justify-content-center align-items-center mb-4">
            		<span class="flaticon-bag"></span>
              </div>
              <div class="media-body">
                <h3 class="heading">Belanja Mudah</h3>
                <p>Banyak kemudahan yang di dapatkan dalam berbelanja dan tanpa perlu memerlukan waktu untuk datang langsung ke toko membeli yang di inginkan.</p>
              </div>
            </div>      
          </div>
          <div class="col-lg-4 text-center d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services p-4 py-md-5">
              <div class="icon d-flex justify-content-center align-items-center mb-4">
            		<span class="flaticon-customer-service"></span>
              </div>
              <div class="media-body">
                <h3 class="heading">Membantu Customer</h3>
                <p>Dapat dipastikan customer dapat terbantu dengan pelayanan yang diberikan dan pasti bisa dapat nyaman berbelanja dengan mudah.</p>
              </div>
            </div>    
          </div>
          <div class="col-lg-4 text-center d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services p-4 py-md-5">
              <div class="icon d-flex justify-content-center align-items-center mb-4">
            		<span class="flaticon-payment-security"></span>
              </div>
              <div class="media-body">
                <h3 class="heading">Pembayaran Aman</h3>
                <p>Customer akan dapat melakukan pembayaran dengan nyaman dan aman sebagai salah satu bentuk transaksi secara online yang berkualitas.</p>
              </div>
            </div>      
          </div>
        </div>
			</div>
		</section>

<div id="clear"></div>
		<?php
		if ($hal = @$_GET['hal']){
			include "inc/barang.php";
		}elseif($open = @$_GET['open']){
			if($open == "Barang-Lihat"){
				include "inc/lihat_barang.php";
			}elseif($open =="Barang-Beli"){
				include "inc/beli_barang.php";
			}elseif($open =="Barang-Beli-New"){
				include "beli_barang_proses.php";	
			}elseif($open =="Keranjang-Belanja"){
				include "keranjang_belanja.php";
			}elseif($open =="Transaksi-Proses"){
				include "transaksi_proses.php";
			}elseif($open =="Transaksi-Tampil"){
				include "transaksi_tampil.php";
			}elseif($open =="Barang-Kategori"){
				include "inc/kategori_barang.php";
				}elseif($open =="rekening"){
				include "rekening.php";
			}elseif($open =="Konfirmasi"){
				include "konfirmasi.php";
			}elseif($open =="Act_retur"){
				include "act_retur.php";
			}
		}else{

	    $page = @$_GET['page'];
	    if($page == ""){ 
	        include "home.php";      
	    }else if($page == "login"){
	        include "login.php";
	    }else if($page == "registrasi"){
	        include "daftar.php";
	    }else if($page == "tops"){
	        include "tops.php";
	    }else if($page == "bottoms"){
	        include "bottoms.php";
	    }else if($page == "jumpsuits"){
	        include "jumpsuits.php";
	    }else if($page == "bootier"){
	        include "bootier.php";
	    }else if($page == "shoes"){
	        include "shoes.php";
	    }else if($page == "carabeli"){
	        include "carapembelian.php";
	    }else if($page == "order"){
	        include "pengiriman.php";
	    }else if($page == "confirm"){
	        include "confirm.php";
	    }else if($page == "barang"){
	        include "barang.php";
	    }else if($page == "pencarian"){
	        include "inc/searching.php";
	    }else if($page == "logout"){
	        include "logout.php";
		}else if($page == "kontak"){
	        include "inc/contact.php";
		}else if($page == "pesanan_lihat"){
	        include "pesanan_lihat.php";
		}else if($page == "tentang"){
	        include "about.html";
	    }else{
	        include "404.php";
	    }
	}
	?>
	<div id="clear"></div>

    <!-- <section class="ftco-section bg-light">
    	<div class="container">
				<div class="row justify-content-center mb-3 pb-3">
          <div class="col-md-12 heading-section text-center ftco-animate">
            <h2 class="mb-4">New Shoes Arrival</h2>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p>
          </div>
        </div>   		
    	</div>
    	<div class="container">
    		<div class="row">
    			<div class="col-sm-12 col-md-6 col-lg-3 ftco-animate d-flex">
    				<div class="product d-flex flex-column">
    					<a href="#" class="img-prod"><img class="img-fluid" src="assets/images/product-1.png" alt="Colorlib Template">
    						<div class="overlay"></div>
    					</a>
    					<div class="text py-3 pb-4 px-3">
    						<div class="d-flex">
    							<div class="cat">
		    						<span>Lifestyle</span>
		    					</div>
		    					<div class="rating">
	    							<p class="text-right mb-0">
	    								<a href="#"><span class="ion-ios-star-outline"></span></a>
	    								<a href="#"><span class="ion-ios-star-outline"></span></a>
	    								<a href="#"><span class="ion-ios-star-outline"></span></a>
	    								<a href="#"><span class="ion-ios-star-outline"></span></a>
	    								<a href="#"><span class="ion-ios-star-outline"></span></a>
	    							</p>
	    						</div>
	    					</div>
    						<h3><a href="#">Nike Free RN 2019 iD</a></h3>
    						<div class="pricing">
	    						<p class="price"><span>$120.00</span></p>
	    					</div>
	    					<p class="bottom-area d-flex px-3">
    							<a href="#" class="add-to-cart text-center py-2 mr-1"><span>Add to cart <i class="ion-ios-add ml-1"></i></span></a>
    							<a href="#" class="buy-now text-center py-2">Buy now<span><i class="ion-ios-cart ml-1"></i></span></a>
    						</p>
    					</div>
    				</div>
    			</div>
    			<div class="col-sm-12 col-md-6 col-lg-3 ftco-animate d-flex">
    				<div class="product d-flex flex-column">
    					<a href="#" class="img-prod"><img class="img-fluid" src="assets/images/product-2.png" alt="Colorlib Template">
    						<span class="status">50% Off</span>
    						<div class="overlay"></div>
    					</a>
    					<div class="text py-3 pb-4 px-3">
    						<div class="d-flex">
    							<div class="cat">
		    						<span>Lifestyle</span>
		    					</div>
		    					<div class="rating">
	    							<p class="text-right mb-0">
	    								<a href="#"><span class="ion-ios-star-outline"></span></a>
	    								<a href="#"><span class="ion-ios-star-outline"></span></a>
	    								<a href="#"><span class="ion-ios-star-outline"></span></a>
	    								<a href="#"><span class="ion-ios-star-outline"></span></a>
	    								<a href="#"><span class="ion-ios-star-outline"></span></a>
	    							</p>
	    						</div>
	    					</div>
    						<h3><a href="#">Nike Free RN 2019 iD</a></h3>
  							<div class="pricing">
	    						<p class="price"><span class="mr-2 price-dc">$120.00</span><span class="price-sale">$80.00</span></p>
	    					</div>
	    					<p class="bottom-area d-flex px-3">
    							<a href="#" class="add-to-cart text-center py-2 mr-1"><span>Add to cart <i class="ion-ios-add ml-1"></i></span></a>
    							<a href="#" class="buy-now text-center py-2">Buy now<span><i class="ion-ios-cart ml-1"></i></span></a>
    						</p>
    					</div>
    				</div>
    			</div>
    			<div class="col-sm-12 col-md-6 col-lg-3 ftco-animate d-flex">
    				<div class="product">
    					<a href="#" class="img-prod"><img class="img-fluid" src="assets/images/product-3.png" alt="Colorlib Template">
	    					<div class="overlay"></div>
	    				</a>
    					<div class="text py-3 pb-4 px-3">
    						<div class="d-flex">
    							<div class="cat">
		    						<span>Lifestyle</span>
		    					</div>
		    					<div class="rating">
	    							<p class="text-right mb-0">
	    								<a href="#"><span class="ion-ios-star-outline"></span></a>
	    								<a href="#"><span class="ion-ios-star-outline"></span></a>
	    								<a href="#"><span class="ion-ios-star-outline"></span></a>
	    								<a href="#"><span class="ion-ios-star-outline"></span></a>
	    								<a href="#"><span class="ion-ios-star-outline"></span></a>
	    							</p>
	    						</div>
	    					</div>
    						<h3><a href="#">Nike Free RN 2019 iD</a></h3>
  							<div class="pricing">
	    						<p class="price"><span>$120.00</span></p>
	    					</div>
	    					<p class="bottom-area d-flex px-3">
    							<a href="#" class="add-to-cart text-center py-2 mr-1"><span>Add to cart <i class="ion-ios-add ml-1"></i></span></a>
    							<a href="#" class="buy-now text-center py-2">Buy now<span><i class="ion-ios-cart ml-1"></i></span></a>
    						</p>
    					</div>
    				</div>
    			</div>
    			<div class="col-sm-12 col-md-6 col-lg-3 ftco-animate d-flex">
    				<div class="product">
    					<a href="#" class="img-prod"><img class="img-fluid" src="assets/images/product-4.png" alt="Colorlib Template">
    						<div class="overlay"></div>
    					</a>
    					<div class="text py-3 pb-4 px-3">
    						<div class="d-flex">
    							<div class="cat">
		    						<span>Lifestyle</span>
		    					</div>
		    					<div class="rating">
	    							<p class="text-right mb-0">
	    								<a href="#"><span class="ion-ios-star-outline"></span></a>
	    								<a href="#"><span class="ion-ios-star-outline"></span></a>
	    								<a href="#"><span class="ion-ios-star-outline"></span></a>
	    								<a href="#"><span class="ion-ios-star-outline"></span></a>
	    								<a href="#"><span class="ion-ios-star-outline"></span></a>
	    							</p>
	    						</div>
	    					</div>
    						<h3><a href="#">Nike Free RN 2019 iD</a></h3>
  							<div class="pricing">
	    						<p class="price"><span>$120.00</span></p>
	    					</div>
	    					<p class="bottom-area d-flex px-3">
    							<a href="#" class="add-to-cart text-center py-2 mr-1"><span>Add to cart <i class="ion-ios-add ml-1"></i></span></a>
    							<a href="#" class="buy-now text-center py-2">Buy now<span><i class="ion-ios-cart ml-1"></i></span></a>
    						</p>
    					</div>
    				</div>
    			</div>

    			<div class="col-sm-12 col-md-6 col-lg-3 ftco-animate d-flex">
    				<div class="product d-flex flex-column">
    					<a href="#" class="img-prod"><img class="img-fluid" src="assets/images/product-5.png" alt="Colorlib Template">
    						<div class="overlay"></div>
    					</a>
    					<div class="text py-3 pb-4 px-3">
    						<div class="d-flex">
    							<div class="cat">
		    						<span>Lifestyle</span>
		    					</div>
		    					<div class="rating">
	    							<p class="text-right mb-0">
	    								<a href="#"><span class="ion-ios-star-outline"></span></a>
	    								<a href="#"><span class="ion-ios-star-outline"></span></a>
	    								<a href="#"><span class="ion-ios-star-outline"></span></a>
	    								<a href="#"><span class="ion-ios-star-outline"></span></a>
	    								<a href="#"><span class="ion-ios-star-outline"></span></a>
	    							</p>
	    						</div>
	    					</div>
    						<h3><a href="#">Nike Free RN 2019 iD</a></h3>
    						<div class="pricing">
	    						<p class="price"><span>$120.00</span></p>
	    					</div>
	    					<p class="bottom-area d-flex px-3">
    							<a href="#" class="add-to-cart text-center py-2 mr-1"><span>Add to cart <i class="ion-ios-add ml-1"></i></span></a>
    							<a href="#" class="buy-now text-center py-2">Buy now<span><i class="ion-ios-cart ml-1"></i></span></a>
    						</p>
    					</div>
    				</div>
    			</div>
    			<div class="col-sm-12 col-md-6 col-lg-3 ftco-animate d-flex">
    				<div class="product d-flex flex-column">
    					<a href="#" class="img-prod"><img class="img-fluid" src="assets/images/product-6.png" alt="Colorlib Template">
    						<span class="status">50% Off</span>
    						<div class="overlay"></div>
    					</a>
    					<div class="text py-3 pb-4 px-3">
    						<div class="d-flex">
    							<div class="cat">
		    						<span>Lifestyle</span>
		    					</div>
		    					<div class="rating">
	    							<p class="text-right mb-0">
	    								<a href="#"><span class="ion-ios-star-outline"></span></a>
	    								<a href="#"><span class="ion-ios-star-outline"></span></a>
	    								<a href="#"><span class="ion-ios-star-outline"></span></a>
	    								<a href="#"><span class="ion-ios-star-outline"></span></a>
	    								<a href="#"><span class="ion-ios-star-outline"></span></a>
	    							</p>
	    						</div>
	    					</div>
    						<h3><a href="#">Nike Free RN 2019 iD</a></h3>
  							<div class="pricing">
	    						<p class="price"><span class="mr-2 price-dc">$120.00</span><span class="price-sale">$80.00</span></p>
	    					</div>
	    					<p class="bottom-area d-flex px-3">
    							<a href="#" class="add-to-cart text-center py-2 mr-1"><span>Add to cart <i class="ion-ios-add ml-1"></i></span></a>
    							<a href="#" class="buy-now text-center py-2">Buy now<span><i class="ion-ios-cart ml-1"></i></span></a>
    						</p>
    					</div>
    				</div>
    			</div>
    			<div class="col-sm-12 col-md-6 col-lg-3 ftco-animate d-flex">
    				<div class="product">
    					<a href="#" class="img-prod"><img class="img-fluid" src="assets/images/product-7.png" alt="Colorlib Template">
	    					<div class="overlay"></div>
	    				</a>
    					<div class="text py-3 pb-4 px-3">
    						<div class="d-flex">
    							<div class="cat">
		    						<span>Lifestyle</span>
		    					</div>
		    					<div class="rating">
	    							<p class="text-right mb-0">
	    								<a href="#"><span class="ion-ios-star-outline"></span></a>
	    								<a href="#"><span class="ion-ios-star-outline"></span></a>
	    								<a href="#"><span class="ion-ios-star-outline"></span></a>
	    								<a href="#"><span class="ion-ios-star-outline"></span></a>
	    								<a href="#"><span class="ion-ios-star-outline"></span></a>
	    							</p>
	    						</div>
	    					</div>
    						<h3><a href="#">Nike Free RN 2019 iD</a></h3>
  							<div class="pricing">
	    						<p class="price"><span>$120.00</span></p>
	    					</div>
	    					<p class="bottom-area d-flex px-3">
    							<a href="#" class="add-to-cart text-center py-2 mr-1"><span>Add to cart <i class="ion-ios-add ml-1"></i></span></a>
    							<a href="#" class="buy-now text-center py-2">Buy now<span><i class="ion-ios-cart ml-1"></i></span></a>
    						</p>
    					</div>
    				</div>
    			</div>
    			<div class="col-sm-12 col-md-6 col-lg-3 ftco-animate d-flex">
    				<div class="product">
    					<a href="#" class="img-prod"><img class="img-fluid" src="assets/images/product-8.png" alt="Colorlib Template">
    						<div class="overlay"></div>
    					</a>
    					<div class="text py-3 pb-4 px-3">
    						<div class="d-flex">
    							<div class="cat">
		    						<span>Lifestyle</span>
		    					</div>
		    					<div class="rating">
	    							<p class="text-right mb-0">
	    								<a href="#"><span class="ion-ios-star-outline"></span></a>
	    								<a href="#"><span class="ion-ios-star-outline"></span></a>
	    								<a href="#"><span class="ion-ios-star-outline"></span></a>
	    								<a href="#"><span class="ion-ios-star-outline"></span></a>
	    								<a href="#"><span class="ion-ios-star-outline"></span></a>
	    							</p>
	    						</div>
	    					</div>
    						<h3><a href="#">Nike Free RN 2019 iD</a></h3>
  							<div class="pricing">
	    						<p class="price"><span>$120.00</span></p>
	    					</div>
	    					<p class="bottom-area d-flex px-3">
    							<a href="#" class="add-to-cart text-center py-2 mr-1"><span>Add to cart <i class="ion-ios-add ml-1"></i></span></a>
    							<a href="#" class="buy-now text-center py-2">Buy now<span><i class="ion-ios-cart ml-1"></i></span></a>
    						</p>
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>
    </section>
 -->

<footer class="ftco-footer ftco-section">
      <div class="container">
      	<div class="row">
      		<div class="mouse">
						<a href="#" class="mouse-icon">
							<div class="mouse-wheel"><span class="ion-ios-arrow-up"></span></div>
						</a>
					</div>
      	</div>
        <div class="row mb-5">
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">C70-PROGATE</h2>
              <p>Belanja Mudah, Membantu Customer, Pembayaran Aman.</p>
<!--               <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li> -->
              </ul>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4 ml-md-5">
              <h2 class="ftco-heading-2">Menu</h2>
              <ul class="list-unstyled">
                <li><a href="index.php" class="py-2 d-block">Belanja</a></li>
                <li><a href="inc/tentangkami.php" class="py-2 d-block">Tentang Kami</a></li>
                <li><a href="#" class="py-2 d-block">Kontak Kami</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md-4">
             <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">Help</h2>
              <div class="d-flex">
	              <ul class="list-unstyled mr-l-5 pr-l-3 mr-4">
	                <li><a href="inc/carapembelian.php" class="py-2 d-block">Informasi Pembelian</a></li>
	                <li><a href="inc/pengiriman.php" class="py-2 d-block">Informasi Pengiriman</a></li>
<!-- 	                <li><a href="#" class="py-2 d-block">Terms &amp; Conditions</a></li>
	                <li><a href="#" class="py-2 d-block">Privacy Policy</a></li> -->
	              </ul>
	              <!-- <ul class="list-unstyled">
	                <li><a href="#" class="py-2 d-block">Tentang </a></li>
	                <li><a href="#" class="py-2 d-block">Kontak Kami</a></li>
	              </ul> -->
	            </div>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
            	<h2 class="ftco-heading-2">Apakah ada pertanyaan ?</h2>
            	<div class="block-23 mb-3">
	              <ul>
	                <li><span class="icon icon-map-marker"></span><span class="text">Kota Tangerang-Indonesia</span></li>
	                <li><a href="https://api.whatsapp.com/send?phone=6281296336400&amp;text=Halo%20gan,%20Saya%20mau%20order....."><span class="icon icon-phone"></span><span class="text">+62 882 2596 5767</span></a></li>
	                <li><a href="#"><span class="icon icon-envelope"></span><span class="text">c70@gmail.com</span></a></li>
	              </ul>
	            </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 text-center">

            <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Design by Eko Rizal
						  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						</p>
          </div>
        </div>
      </div>
    </footer>

<!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/jquery-migrate-3.0.1.min.js"></script>
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/jquery.easing.1.3.js"></script>
  <script src="assets/js/jquery.waypoints.min.js"></script>
  <script src="assets/js/jquery.stellar.min.js"></script>
  <script src="assets/js/owl.carousel.min.js"></script>
  <script src="assets/js/jquery.magnific-popup.min.js"></script>
  <script src="assets/js/aos.js"></script>
  <script src="assets/js/jquery.animateNumber.min.js"></script>
  <script src="assets/js/bootstrap-datepicker.js"></script>
  <script src="assets/js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="assets/js/google-map.js"></script>
  <script src="assets/js/main.js"></script>
    
  </body>
</html>
