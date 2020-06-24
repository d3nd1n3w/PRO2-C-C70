<div id="header">
			
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
<?php } ?>
		<div class="py-1 bg-black">
    	<div class="container">
    		<div class="row no-gutters d-flex align-items-start align-items-center px-md-0">
	    		<div class="col-lg-12 d-block">
		    		<div class="row d-flex">
		    			<div class="col-md pr-4 d-flex topper align-items-center">
					    	<div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-phone2"></span></div>
						    <span class="text">088225965767</span>
					    </div>
					    <div class="col-md pr-4 d-flex topper align-items-center">
					    	<div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-paper-plane"></span></div>
						    <span class="text">c70progate@gmail.com</span>
					    </div>
					    <div class="col-md-5 pr-4 d-flex topper align-items-center text-lg-right">
						    <!-- <span class="text">3-5 Business days delivery &amp; Free Returns</span> -->
					    </div>
				    </div>
			    </div>
		    </div>
		  </div>
    </div>