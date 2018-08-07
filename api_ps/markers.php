<?php 
	$server		= "localhost"; //sesuaikan dengan nama server
	$user		= "root"; //sesuaikan username
	$password	= ""; //sesuaikan password
	$database	= "gis"; //sesuaikan target databese 
	
	$con = mysqli_connect($server, $user, $password, $database);
	if (mysqli_connect_errno()) {
		echo "Gagal terhubung MySQL: " . mysqli_connect_error();
	}

	$query = mysqli_query($con, "SELECT * FROM data_studio ORDER BY id_st ASC");
	
	$json = '{"ps": [';

	// bikin looping dech array yang di fetch
	while ($row = mysqli_fetch_array($query)){

	//tanda kutip dua (") tidak diijinkan oleh string json, maka akan kita replace dengan karakter `
	//strip_tag berfungsi untuk menghilangkan tag-tag html pada string 
		$char ='"';

		$json .= 
		'{
			"id":"'.str_replace($char,'`',strip_tags($row['id_st'])).'", 
			"nama_studio":"'.str_replace($char,'`',strip_tags($row['nama_st'])).'",
			"alamat_studio":"'.str_replace($char,'`',strip_tags($row['alamat_st'])).'",
			"lati":"'.str_replace($char,'`',strip_tags($row['lat'])).'",
			"longi":"'.str_replace($char,'`',strip_tags($row['longi'])).'"
		},';
	}

	// buat menghilangkan koma diakhir array
	$json = substr($json,0,strlen($json)-1);

	$json .= ']}';

	// print json
	echo $json;
	
	mysqli_close($con);
	
?>