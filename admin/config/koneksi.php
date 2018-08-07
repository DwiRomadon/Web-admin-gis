<?php
	ini_set('display_errors',FALSE);
	$host	= "localhost";
	$user	= "root";
	$pass	= "";
	$db		= "gis";
	
	
	$koneksi=mysql_connect($host,$user,$pass);
	$db=mysql_select_db($db);
	
	if ($koneksi&&$db){
		//echo "berhasil : )";
	}else{
?>
	<script language="javascript">alert("Gagal Koneksi Database MySql !!")</script>
<?php

	}

?>