<?php
	include "../config/koneksi.php";
	
	$pros=$_GET['pros'];
	
	$id_tanaman=$_POST['id_tanaman'];
	$suhuatas=$_POST['Suhu_Atas'];
	$suhubawah=$_POST['Suhu_Bawah'];
	$ecatas=$_POST['EC_Atas'];
	$ecbawah=$_POST['EC_Bawah'];
	$phatas=$_POST['PH_Atas'];
	$phbawah=$_POST['PH_Bawah'];

	switch ($pros){
		case "tambah" :
			if($pros=='tambah'){
				$qtambah=mysql_query("INSERT INTO tb_knowledge values('$id_tanaman','$suhuatas','$suhubawah','$ecatas','$ecbawah','$phatas','$phbawah');");
			}
			header("location:../index.php?pilih=1.2");
		break;
		
		case "ubah" :
			$qubah=mysql_query("UPDATE tb_knowledge SET id_tanaman='$id_tanaman',Suhu_Atas='$suhuatas',Suhu_Bawah='$suhubawah',EC_Atas='$ecatas',EC_Bawah='$ecbawah',PH_Atas='$phatas',PH_Bawah='$phbawah' WHERE id_tanaman='$id_tanaman'");
			if($qubah){
				header("location:../index.php?pilih=1.2");
			}else{
				echo "Edit Data Gagal!!!";
			}
		break;
		
		case "hapus" :
			$qdelete=mysql_query("DELETE FROM tb_knowledge WHERE id_tanaman='$id_tanaman'");
			if($qdelete){
				header("location:../index.php?pilih=1.2");
			}else{
				echo "Hapus Data Gagal!!!!";
			}
		break;
		
		default : break; 
	}
	
?>