<?php
	 include "koneksi.php";

	 $id = $_POST['id'];
	 $query = mysql_query("SELECT * FROM data_studio WHERE id_st='".$id."'");
	 while ($row = mysql_fetch_array($query)){
	 	$char ='"';
	 	//$tgl	= date("d M Y", strtotime($row['date']));
	 	//$string = $row['value'];
	 	$json = '{
	 			"id": "'.str_replace($char,'`',strip_tags($row['id_st'])).'", 
	 			"nama": "'.str_replace($char,'`',strip_tags($row['nama_st'])).'",
				"alamat": "'.str_replace($char,'`',strip_tags($row['alamat_st'])).'",
				"no_telp": "'.str_replace($char,'`',strip_tags($row['tlp'])).'",
				"website": "'.str_replace($char,'`',strip_tags($row['website'])).'",
				"deskripsi": "'.str_replace($char,'`',strip_tags($row['deskripsi'])).'",
				"lat": "'.str_replace($char,'`',strip_tags($row['lat'])).'",
				"long": "'.str_replace($char,'`',strip_tags($row['longi'])).'",
				"status": "'.str_replace($char,'`',strip_tags($row['status'])).'",
	 			"gambar1": "'.$row['gmb_1'].'",
				"gambar2": "'.$row['gmb_2'].'",
				"gambar3": "'.$row['gmb_3'].'"}';
	 }
	 echo $json;
	 mysql_close($connect);
?>