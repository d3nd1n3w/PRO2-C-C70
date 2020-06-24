<?php
$host    = "localhost"; 
$uname   = "root"; 
$pass    = ""; 
$db      = "ecommerce";

$koneksi = mysql_connect($host,$uname,$pass);
mysql_select_db($db,$koneksi);
?>