<?php
error_reporting(0);
session_start();
$id_admin=$_SESSION['username'];?>
<?php
session_start(); //skrip memulai sesi
//exit($_SESSION['id_user']);
//jika belum login atau session id user tidak ditemukan, maka munculkan pesan, lalu lempar ke luar
if(!isset($_SESSION['username'])){
	?>
    <script>
	alert("Anda tidak berhak masuk\nKemungkinan anda belum login");
	document.location = "login.php";
	</script>
    <?php
	//header("location:login.php");
	echo "<h2>Anda tidak berhak masuk, Kemungkinan anda belum login<h2><a href='login.php'>Klik</a> untuk kembali";
	exit();
}
?>
<ul class="nav navbar-nav navbar-right navbar-user">
                    <li class="dropdown user-dropdown">
                    	

                       <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>  <?php echo $_SESSION['username']; ?><b class="caret"></b></a>
                       <ul class="dropdown-menu">
                           <li><a href="logout.php"><i class="fa fa-power-off"></i> Log Out</a></li>
                       </ul>
                   </li>
                </ul>