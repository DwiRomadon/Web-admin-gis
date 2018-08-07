<?php
	include "../config/koneksi.php";
	
	$pros=$_GET[pros];
	
	$id_tanaman=$_POST[id_tanaman];
	$nama_tanaman=$_POST[nama_tanaman];
	$masa_panen=$_POST[masa_panen];
	$estimasi=$_POST[estimasi];
	
	
	switch ($pros){
		case "tambah" :
			if($pros=='tambah'){
				$qtambah=mysql_query("INSERT INTO tb_tanaman values('$id_tanaman','$nama_tanaman','$masa_panen','$estimasi');");
			}
			header("location:../index.php?pilih=1.1");
		break;
		
		case "ubah" :
			$qubah=mysql_query("UPDATE tb_tanaman SET id_tanaman='$id_tanaman',nama_tanaman='$nama_tanaman',masa_panen='$masa_panen',estimasi='$estimasi' WHERE id_tanaman='$id_tanaman'");
			if($qubah){
				header("location:../index.php?pilih=1.1");
			}else{
				echo "Edit Data Gagal!!!";
			}
		break;
		
		case "hapus" :
			$qdelete=mysql_query("DELETE FROM tb_tanaman WHERE id_tanaman='$id_tanaman'");
			if($qdelete){
				header("location:../index.php?pilih=1.1");
			}else{
				echo "Hapus Data Gagal!!!!";
			}
		break;
		
		default : break; 
	}
	
?>