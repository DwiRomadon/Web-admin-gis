<?php 

	include_once "cn.php";

	$nama = $_POST['keyword'];

	$query = mysqli_query($con, "SELECT * FROM data_studio WHERE nama_st LIKE '%".$nama."%'");

	$num_rows = mysqli_num_rows($query);

	if ($num_rows > 0){
		$json = '{"value":1, "results": [';

		while ($row = mysqli_fetch_array($query)){
			$char ='"';

			$json .= '{
				"id": "'.str_replace($char,'`',strip_tags($row['id_st'])).'", 
				"nama": "'.str_replace($char,'`',strip_tags($row['nama_st'])).'",
				"alamat": "'.str_replace($char,'`',strip_tags($row['alamat_st'])).'",
				"gambar": "'.str_replace($char,'`',strip_tags($row['gmb_1'])).'"
			},';
		}

		$json = substr($json,0,strlen($json)-1);
		
		$json .= ']}';

	} else {
		$json = '{"value":0, "message": "Data tidak ditemukan."}';
	}

	echo $json;

	mysqli_close($con);
?>