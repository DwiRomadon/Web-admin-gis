<?php
	include "../config/koneksi.php";
	
	$pros=$_GET['pros'];
	$id_st=$_POST['id_st'];
	$nama_st=$_POST['nama'];
	$alamat_st=$_POST['alamat'];
	$tlp=$_POST['tlp'];
	$website=$_POST['website'];
	$deskripsi=$_POST['deskripsi'];
	$lat=$_POST['lat'];
	$long=$_POST['long'];	
	$status=$_POST['status'];
	$file1 = $_FILES['gmb1']['tmp_name'];	
	$gambar1 = $_FILES['gmb1']['name'];	
	$gambar2 = $_FILES['gmb2']['name'];	
	$gambar3 = $_FILES['gmb3']['name'];	
	$path = "gambar/";
	$folder = $path . basename( $_FILES['gmb1']['name']);
	$folder2 = $path . basename( $_FILES['gmb2']['name']);
	$folder3 = $path . basename( $_FILES['gmb3']['name']);

	function RandomStr($jumlah_string){
 
	$string = "abcdefghijklmnopqrstuvwxyz0123456789";
	for($i=0; $i<=$jumlah_string; $i++){
	    $pos = rand(0,36);
	    $str .= $string{$pos};
	}
	return $str;
 
}
	$random3= RandomStr(7);
	$random2= RandomStr(6);
	$random = RandomStr(5);
	$ran1 = $random.$gambar1;
	$ran2 = $random2.$gambar2;
	$ran3 = $random3.$gambar3;
 


	switch ($pros){
		case "tambah" :		
			if($pros=='tambah'){
				
				$qtambah=mysql_query("insert into data_studio (nama_st,alamat_st,website,tlp,status,deskripsi,lat,longi,gmb_1,gmb_2,gmb_3)values('$nama_st','$alamat_st','$website','$tlp','$status','$deskripsi','$lat','$long','$ran1','$ran2','$ran3');");
				$exe=mysql_query($query, $conn);
				move_uploaded_file($_FILES['gmb1']['tmp_name'],"gambar1/$ran1");//memindahkan gambar ke folder foto
				move_uploaded_file($_FILES['gmb2']['tmp_name'], "gambar2/$ran2");//memindahkan gambar ke folder foto
				move_uploaded_file($_FILES['gmb3']['tmp_name'], "gambar3/$ran3");//memindahkan gambar ke folder foto				
			} 	
			
			header("location:../index.php?pilih=1.3");
		break;
		
		case "ubah" :
			$qubah=mysql_query("UPDATE data_studio SET id_st='$id_st',nama_st='$nama_st',alamat_st='$alamat_st',website='$website',tlp='$tlp',status='$status',deskripsi='$deskripsi',lat='$lat',longi='$long' WHERE id_st='$id_st'");
			
			if($qubah){
				if(!file_exists($_FILES['gmb1']['tmp_name']) || !is_uploaded_file($_FILES['gmb1']['tmp_name'])) 
				{
				echo 'No upload';
				}   
				else
				mysql_query("UPDATE data_studio SET gmb_1='$ran1' Where id_st='$id_st'");
				move_uploaded_file($_FILES['gmb1']['tmp_name'],"gambar1/$ran1");//memindahkan gambar ke folder foto

			if(!file_exists($_FILES['gmb2']['tmp_name']) || !is_uploaded_file($_FILES['gmb2']['tmp_name'])) 
				{
				echo 'No upload';
				}   
				else
				mysql_query("UPDATE data_studio SET gmb_2='$ran2' Where id_st='$id_st'");		
				move_uploaded_file($_FILES['gmb2']['tmp_name'], "gambar2/$ran2");//memindahkan gambar ke folder foto
			
			if(!file_exists($_FILES['gmb3']['tmp_name']) || !is_uploaded_file($_FILES['gmb3']['tmp_name'])) 
				{
				echo 'No upload';
				}   
				else
				mysql_query("UPDATE data_studio SET gmb_3='$ran3' Where id_st='$id_st'");
				move_uploaded_file($_FILES['gmb3']['tmp_name'], "gambar3/$ran3");//memindahkan gambar ke folder foto
			
				header("location:../index.php?pilih=1.3");
			}else{
				echo "Edit Data Gagal!!!";
			}
		break;
		
		case "hapus" :
			$qdelete=mysql_query("DELETE FROM data_studio WHERE id_st='$id_st'");
			if($qdelete){
				header("location:../index.php?pilih=1.3");
			}else{
				echo "Hapus Data Gagal!!!!";
			}
		break;
		
		case "verifikasi" :
			if($pros=='verifikasi'){
				$qverifikasi=mysql_query("INSERT INTO tb_suhu values('$email','$IP');");
			}
			header("location:../index.php?pilih=1.3");
		break;
		
		
		default : break; 
	}
	
?>