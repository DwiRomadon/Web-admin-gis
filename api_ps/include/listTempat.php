<?php   
   include "koneksi.php";
	 sleep(2);
	 $offset = isset($_get['offset']) && $_get['offset'] != '' ? $_get['offset'] : 0;
	 $all = mysql_query("select * from data_studio order by id_st asc");
	 $count_all = mysql_num_rows($all);
	 $query = mysql_query("select * from data_studio order by id_st asc limit $offset,100");
	 $count = mysql_num_rows($query);
	 $json_kosong = 0;
	 if($count<100){
	 	if($count==0){
	 		$json_kosong = 1;
	 	}else{
	 		$query = mysql_query("select * from data_studio order by id_st asc limit $offset,$count");
	 		$count = mysql_num_rows($query);
	 		if(empty($count)){
	 			$query = mysql_query("select * from data_studio order by id_st asc limit 0,100");
	 			$num = 0;
	 		}else{
	 			$num = $offset;
	 		}
	 	}
	 } else{
	 	$num = $offset;
	 }
	 $json = '[';
	 while ($row = mysql_fetch_array($query)){
	 	$num++;
	 	$char ='"';
	 	//$tgl	= date("d m y", strtotime($row['date']));
	 	//$string = substr(strip_tags($row['value']), 0, 200);
	 	$json .= '{
	 		"no": '.$num.',
	 		"id": "'.str_replace($char,'`',strip_tags($row['id_st'])).'", 
	 		"nama": "'.str_replace($char,'`',strip_tags($row['nama_st'])).'",
	 		"alamat": "'.str_replace($char,'`',strip_tags($row['alamat_st'])).'",
	 		"gambar": "'.str_replace($char,'`',strip_tags($row['gmb_1'])).'"},';
	 }
	 $json = substr($json,0,strlen($json)-1);
	 if($json_kosong==1){
	 	$json = '[{ "no": "", "id": "", "nama": "", "alamat": "", "gambar": ""}]';
	 }else{
	 	$json .= ']';
	 }
	echo $json;
	mysql_close($connect);
	
?>