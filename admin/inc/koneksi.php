<?php
$koneksi = mysql_connect("localhost","root","") or die (mysql_error());
mysql_select_db("ecommerce",$koneksi) or die (mysql_error());
?>