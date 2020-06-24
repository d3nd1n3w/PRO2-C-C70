<?php
include_once "inc/koneksi.php";
include_once "inc/library.php";

# JIKA PENYIMPANAN SUKSES
if(isset($_GET['Aksi']) and $_GET['Aksi']=="Sukses"){
	echo "<br><br><center> <b>SELAMAT, PENAFTARAN ANDA SUDAH KAMI TERIMA </b><br> Sekarang, Anda dapat login untuk melakukan pemesanan </center>";
	echo "<meta http-equiv='refresh' content='2; url='?open=Barang'>";

	exit;
}

# TOMBOL DAFTAR DIKLIK
if(isset($_POST['btnDaftar'])){
	// Baca Variabel Form
	$txtNama	= $_POST['txtNama'];
	$txtNama 	= str_replace("'","&acute;",$txtNama);
	
	$cmbKelamin	= $_POST['cmbKelamin'];
	$txtEmail	= $_POST['txtEmail'];
	$txtNoTelepon	= $_POST['txtNoTelepon'];
	
	$txtUsername	= $_POST['txtUsername'];
	$Alamat     	= $_POST['alamat'];
	$Kota   	    = $_POST['nm_kota'];
	$txtPassword_1	= $_POST['txtPassword_1'];
	$txtPassword_2	= $_POST['txtPassword_2'];

	// Validasi, jika data kosong kirimkan pesan error
	$pesanError = array();
	if (trim($txtNama) =="") {
		$pesanError[] = "Data <b>Nama Pelanggan</b> masih kosong";
	}
	if (trim($cmbKelamin) =="KOSONG") {
		$pesanError[] = "Data <b>Jenis Kelamin</b> belum dipilih";
	}
	if (trim($txtEmail) =="") {
		$pesanError[] = "Data <b>Alamat Email</b> masih kosong";
	}
	if (trim($txtNoTelepon) =="") {
		$pesanError[] = "Data <b>No. Telepon</b> masih kosong";
	}
	if (trim($txtUsername) =="") {
		$pesanError[] = "Data <b>Username</b> masih kosong";
	}
	if (trim($Alamat) =="") {
		$pesanError[] = "Data <b>Alamat</b> masih kosong";
	}
	if (trim($Kota) =="") {
		$pesanError[] = "Data <b>Kota</b> masih kosong";
	}
	if (trim($txtPassword_1) =="") {
		$pesanError[] = "Data <b>Password</b> masih kosong";
	}
	if (trim($txtPassword_1) != trim($txtPassword_2)) {
		$pesanError[] = "Data <b>Password Ke 2</b> tidak sama dengan sebelumnya";
	}
	
	// Valiasii Username, tidak boleh ada yang kembar
	$sqlCek = "SELECT * FROM pelanggan WHERE username='$txtUsername'";
	$qryCek = mysql_query($sqlCek, $koneksi) or die ("Gagal Cek");
	$adaCek = mysql_num_rows($qryCek);
	if($adaCek >= 1) {	
			$pesanError[] = "Errrrrrooorrrr...!!, User <b> $txtUsername </b> sudah ada yang menggunakan.";
	}	
	
	# JIKA ADA PESAN ERROR DARI VALIDASI
	if (count($pesanError)>=1 ){
		echo "<div class='pesanError' align='left'>";
		echo "<img src='images/attention.png'> <br><hr>";
			$noPesan=0;
			foreach ($pesanError as $indeks=>$pesan_tampil) { 
			$noPesan++;
				echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";	
			} 
		echo "<br>"; 
	}
	else {
		# SIMPAN DATA KE DATABASE. Jika tidak menemukan pesan error, simpan data ke database
		$kodeBaru	= buatKode("pelanggan","P");
		$tanggal	= date('Y-m-d');
		$mySql	= "INSERT INTO pelanggan ( kd_pelanggan, username, password, nama_pelanggan, jk, email, telp, alamat,nm_kota) 
					VALUES ('$kodeBaru','$txtUsername',md5('$txtPassword_1'),'$txtNama', '$cmbKelamin', '$txtEmail', '$txtNoTelepon','$Alamat','$Kota')";
		$myQry	= mysql_query($mySql, $koneksi) or die ("Gagal query".mysql_error());
		if($myQry){
		echo "<script language='javascript'> alert('Silahkan Login');
			document.location='./';
			</script>";
		}
		exit;
	}	
} // End if($_POST) 

# BACA VARIABEL FORM
$dataNama		= isset($_POST['txtNama']) ? $_POST['txtNama'] : '';
$dataKelamin	= isset($_POST['cmbKelamin']) ? $_POST['cmbKelamin'] : 'Laki-laki';
$dataEmail		= isset($_POST['txtEmail']) ? $_POST['txtEmail'] : '';
$dataNoTelepon 	= isset($_POST['txtNoTelepon']) ? $_POST['txtNoTelepon'] : '';
$dataUsername	= isset($_POST['txtUsername']) ? $_POST['txtUsername'] : '';
$Alamat	        = isset($_POST['alamat']) ? $_POST['alamat'] : '';
$Kota           = isset($_POST['nm_kota']) ? $_POST['nm_kota'] : '';
?>
<div class="konten">
<div class="jr"></div>
<form name="form1" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" target="_self">
  <table width="100%" border="0" cellpadding="4" cellspacing="0">
    <tr align="center"> 
      <td height="22" colspan="3" bgcolor="#81c7b9" class="HEAD" style="color:white;"> <b>PENDAFTARAN PELANGGAN</b> </td>
    </tr>
    
    <tr> 
      <td width="25%"><b>Nama Pelanggan </b></td>
      <td width="1%"><b>:</b></td>
      <td width="74%"><input name="txtNama" type="text" size="50" maxlength="50" value="<?php echo $dataNama; ?>" placeholder="Silahkan isi nama pelanggan"></td>
    </tr>
    <tr> 
      <td><b> Kelamin</b></td>
      <td><b>:</b></td>
      <td><b>
        <select name="cmbKelamin">
          <option value="KOSONG">....</option>
          <?php
		$pilihan = array("Laki-laki", "Perempuan");
		foreach ($pilihan as $nilai) {
			if ($nilai == $dataKelamin) {
				$cek=" selected";
			} else { $cek = ""; }
			echo "<option value='$nilai' $cek>$nilai</option>";
		}
		?>
        </select>
      </b></td>
    </tr>
    <tr>
      <td><b>E-Mail</b></td>
      <td><b>:</b></td>
      <td><input name="txtEmail" type="email" size="50" maxlength="50" value="<?php echo $dataEmail; ?>" placeholder="Silahkan isi E-mail" />      </td>
    </tr>
    <tr>
      <td><b>No. Telepon</b></td>
      <td><b>:</b></td>
      <td><input name="txtNoTelepon" type="number" size="30" maxlength="20" value="<?php echo $dataNoTelepon; ?>" placeholder="Silahkan isi No Telepon"/></td>
    </tr>
    <tr>
      <td><b>Alamat</b></td>
      <td><b>:</b></td>
      <td><textarea name="alamat" cols="30" rows="5" placeholder="Silakan Masukan Alamat"></textarea><?php echo $Alamat;?></td>
    </tr>
    <tr>
      <td><b>Kota Anda</b></td>
      <td><b>:</b></td>
      <td><input name="nm_kota" type="text" size="30" placeholder="Silakan Masukan Kota" maxlength="20" value="<?php echo $Kota;?>"/ ></td>
    </tr>
    <tr align="center"> 
      <td height="20" colspan="3" bgcolor="#81c7b9"><strong style="color:white;">DATA LOGIN </strong></td>
    </tr>
    <tr> 
      <td><b>Username</b></td>
      <td><b>:</b></td>
      <td><input name="txtUsername" type="text" size="30" maxlength="20" value="<?php echo $dataUsername; ?>" placeholder="Silahkan isi Username"></td>
    </tr>
    <tr> 
      <td><b>Password</b></td>
      <td><b>:</b></td>
      <td><input name="txtPassword_1" type="password" size="30" maxlength="20" placeholder="Silahkan isi Password"></td>
    </tr>
    <tr>
      <td><b>Password (Lagi) </b></td>
      <td><b>:</b></td>
      <td><input name="txtPassword_2" type="password" size="30" maxlength="20" placeholder="Silahkan isi Password Lagi"/></td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td> 
        <input type="submit" name="btnDaftar" value=" Daftar "></td>
    </tr>
  </table>
</form>
</div>