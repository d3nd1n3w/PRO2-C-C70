<?php
ob_start();
@session_start();
include "inc/koneksi.php";

if(@$_SESSION['admin']){
	header("location: index.php");
}else{
?>
<html>
<head>
	<title>halaman login</title>
	<style type="text/css">
	body{
		font-family: arial;
		font-size: 14px;
		background-color: #b5b8bd;
	}

	#utama{
		width: 300px;
		margin: 0 auto;
		margin-top: 12%;
	}
	
	#judul{
		padding: 25px;
		text-align: center;
		color: black;
		font-size: 20px;
		background-color: #FFF;
		border-top-right-radius: 5px; 
		border-top-left-radius: 5px;
		border-bottom: 2px solid #76d3ea;
	}
	#logo{
	    height: 120px; width: 87px;
    	position: absolute; 
    	margin-left: -20px; 
    	margin-top: -18px;
	}
	#text{
		margin-left: 40px;
	    margin-top: 0;
	}
	#inputan{
		background-color: white;
		padding: 20px;
		border-bottom-right-radius: 5px;
		-webkit-border-bottom-right-radius: 5px;
		border-bottom-left-radius: 5px;
		-webkit-border-bottom-left-radius: 5px;
	}

	input{
		padding: 10px;
		border: 1px solid #b5b8bd;
		border-radius: 5px;
	}

	.lg{
		width: 260px;
	}

	.btn{
		background-color:#76d3ea;
		border-radius: 5px;
		color: black; 
	}

	.btn:hover{
		background-color: #62bcd3;
		cursor: pointer;
	}

	</style>
</head>
<body>
	<div id="utama">
		<div id="judul">
			<div id="logo">
				<img src="gambar/user-icon.png" width="70%" height="50%">
			</div> 
			<div id="text">
				HALAMAN ADMIN
			</div>
		</div>
		<div id="inputan">
			<form action="" method="POST">
				<div>
					<input type="text" name="user" placeholder="username" class="lg" />
				</div>
				<div style="margin-top:10px;">
					<input type="password" name="pass" placeholder="password" class="lg" />
				</div>
				<div style="margin-top:10px;">
					<input type="submit" name="login" value="Login" class="btn" />
				</div>
			</form>

			<?php
			$user = @$_POST['user'];
			$pass = @$_POST['pass'];
			$login = @$_POST['login'];

			if($login) {
				if($user == "" || $pass == "") {
					?><script type="text/javascript">alert("username / password tidak boleh kosong");</script><?php
				} else {
					$sql = mysql_query("select * from admin where username = '$user' and password =md5('$pass')") or die (mysql_error());
					$data = mysql_fetch_array($sql);
					$cek = mysql_num_rows($sql);
					if($cek >=1){
						@$_SESSION['admin']=$data['id_admin'];
						header("location: index.php");
					}else{
						echo "Login gagal";
					}
				}
			}
			?>
		</div>
	</div>
</body>
</html>

<?php
}
?>