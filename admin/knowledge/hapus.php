<?php 
include "../config/koneksi.php";
$id_st = $_GET['id_st'];
mysql_query("DELETE FROM data_studio WHERE id_st='$id_st'")or die(mysql_error());
 
header("location:../index.php?pilih=1.3");
?>