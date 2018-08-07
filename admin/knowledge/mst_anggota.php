<?php 
	include "config/koneksi.php";
	include "fungsi/fungsi.php";

	$aksi=$_GET['aksi'];
	$kategori = ($kategori=$_POST['kategori'])?$kategori : $_GET['kategori'];
	$cari = ($cari = $_POST['input_cari'])? $cari: $_GET['input_cari'];
?>

<head>
<script language="javascript" type="text/javascript" src="js/niceforms.js"></script>
<script language="JavaScript">
	$(document).ready(function(){
		$(function() {
			$( '#tanggal' ).datepicker({
				dateFormat:'yy-mm-dd',
				changeMonth: true,
				changeYear: true
			});
			$( '#tgl_masuk' ).datepicker({
				dateFormat:'yy-mm-dd',
				changeMonth: true,
				changeYear: true
			});
		});
	});
</script>
<link rel="stylesheet" type="text/css" href="css/theme1.css" />
</head>

<?php
	if(empty($aksi)){
?>
<body>  
         	            
<div id="box">
<h3>Data Knowledge</h3>

<form action="<?php $_SERVER['PHP_SELF']?>" method="post">
    <select name="kategori">
        <option value="" selected="selected" disabled="disabled">Pilih Kategori</option>
        <option value="id_tanaman">ID</option>
    </select> 
    <input type="text" name="input_cari" value="<?php echo $cari;?>"><input type="submit" value="Cari">
</form>             
<div class="tambah"><a href=?pilih=1.2&aksi=tambah><input type="submit" value="Tambah"></a></div>
<table width="100%">
    <thead>
		<tr>
             <th><a href="#">No</a></th>
             <th><a href="#">ID</a></th>
			 <th><a href="#">Suhu Atas</a></th>
			 <th><a href="#">Suhu Bawah</a></th>
             <th><a href="#">EC Atas</a></th>
			 <th><a href="#">EC Bawah</a></th>
			 <th><a href="#">PH Atas</a></th>
			 <th><a href="#">PH Bawah</a></th>
             <th colspan="3"><a>Aksi</a></th>
       	</tr>	
    </thead>
<?php

		// PAGING
		$batas=10;
		$halaman=$_GET['halaman'];
		if(empty($halaman)){
			$posisi=0;
			$halaman=1;
		}else{
			$posisi=($halaman-1)*$batas;
		}
		if($kategori!=""){
			$query = mysql_query("SELECT * 
								FROM tb_knowledge
								WHERE $kategori LIKE '%$cari%'
								ORDER BY id_tanaman ASC 
								LIMIT $posisi, $batas");
		}else{
			$query=mysql_query("SELECT * FROM tb_knowledge 
								ORDER BY id_tanaman ASC 
								LIMIT $posisi, $batas");								
		}
		$no=$posisi+1;
		
	while($data=mysql_fetch_array($query)){
?>
    <tbody>
    	<tr>
			<td><?php echo $no++;?></td>
            <td><?php echo $data['id_tanaman'];?></td>
            <td><?php echo $data['Suhu_Atas'];?></td>
			<td><?php echo $data['Suhu_Bawah'];?></td>
            <td><?php echo $data['EC_Atas'];?></td>
			<td><?php echo $data['EC_Bawah'];?></td>
			<td><?php echo $data['PH_Atas'];?></td>
			<td><?php echo $data['PH_Bawah'];?></td>
            <td align="center">
	<a href=index.php?pilih=1.2&aksi=ubah&id_tanaman=<?php echo $data['id_tanaman'];?>><img src="img/user_edit.png" title="Edit user" width="16" height="16" /></a>
    <a href=index.php?pilih=1.2&aksi=hapus&id_tanaman=<?php echo $data['id_tanaman'];?>><img src="img/user_delete.png" title="Delete user" width="16" height="16" /></a>
			</td>
        </tr> 
	</tbody>   
<?php
	} //tutup while
?>
	<tr class="paging">
            <td colspan="12">
         <?php
            // PAGING
           if($kategori!=""){
				$query2 = mysql_query("SELECT * 
									FROM tb_knowledge
									WHERE $kategori LIKE '%$cari%'
									ORDER BY id_tanaman ASC");
			}else{
				$query2 = mysql_query("SELECT * FROM tb_knowledge");
			}
            $jmldata=mysql_num_rows($query2);
            $jmlhalaman=ceil($jmldata/$batas);
			
                // previous link
				if($halaman == 1){ 
					echo '<span class="prn">&lt; Previous</span>&nbsp;';
                }else{
					$i = $halaman-1;
					echo '<a href="?pilih=1.2&halaman='.$i.'" class="prn" rel="nofollow" title="go to page '.$i.'">&lt; Previous</a>&nbsp;';
					echo '<span class="prn">...</span>&nbsp;';
				}	
                for($i = 1; $i <= $jmlhalaman && $i <= $jmlhalaman; $i++){ 
                    if(($halaman) == $i){ 
                        echo '<span>'.$i.'</span>&nbsp;'; 
                    }else{ 
                        echo '<a href=?pilih=1.2&halaman='.$i.'>'.$i.'</a>';
                    } 
                } 
				
                // next link 
                if($halaman < $jmlhalaman){ 
                    $next = ($halaman + 1); 
					echo '<span class="prn">...</span>&nbsp;';
                    echo '<a href=?pilih=1.2&halaman='.$next.' class="prn" rel="nofollow" title="go to page '.$next.'">Next &gt;</a>&nbsp;'; 
                }else {
					echo '<span class="prn">Next &gt;</span>&nbsp;';
				}
				
				 if ($jmldata != 0){
					echo '<p id="total_count">(total '.$jmldata.' data)</p></div>';
				}
	
            ?>
            </td>
        </tr>
	</table>
	</div>
    
<?php
	}elseif($aksi=='tambah'){
		//$query=mysql_query("SELECT * FROM t_jenis_simpan WHERE kode_jenis_simpan='S0001'");
		//$data=mysql_fetch_array($query);
		//echo $query;
?>

<div id="box">
<h3 id="adduser">Tambah Data Anggota</h3>
<form action="knowledge/proses_anggota.php?pros=tambah" method="post" id="form" enctype="multipart/form-data">
<h4 id="adduser">Data Pribadi</h4>
<fieldset>
	<dl>
	<dt><label for="suhu">Nama Tanaman :</label></dt>
	<td>
	<select name="id_tanaman" id="id_tanaman" onChange="show(this.value)" class="required" title="Jenis Tanaman">
       <option value="id_tanaman" selected="selected"> Jenis Tanaman </option>
            <?php
            $q=mysql_query("SELECT * FROM tb_tanaman");
            while($a=mysql_fetch_array($q)){			
            ?>
            <option value="<?php echo $a['id_tanaman'];?>" <?php echo $disabled;?>><?php echo $a['nama_tanaman'];?></option>
            <?php
            }
            ?>
            </select>
	</td>		
    </dl>
	<br>
	<dl>
		<dt><label for="suhuatas">Suhu Atas :</label></dt>
        <dd><input type="text" name="Suhu_Atas" size="30" id="suhuatas" class="required" title="Suhu harus diisi"></dd>
    </dl>
	<dl>
		<dt><label for="suhubawah">Suhu Bawah :</label></dt>
        <dd><input type="text" name="Suhu_Bawah" size="30" id="suhubawah" class="required" title="Suhu harus diisi"></dd>
    </dl>
    <dl>
        <dt><label for="ecatas">EC Atas:</label></dt>
        <dd><input type="text" name="EC_Atas" size="30" class="required" title="ec harus diisi"/></dd>
    </dl>
	<dl>
        <dt><label for="ecbawah">EC Bawah:</label></dt>
        <dd><input type="text" name="EC_Bawah" size="30" class="required" title="ec harus diisi"/></dd>
    </dl>
	<dl>
        <dt><label for="phatas">PH Atas :</label></dt>
        <dd><input type="text" name="PH_Atas" size="30" id="phatas" class="required" title="ph harus diisi"/></dd>
    </dl>
	<dl>
        <dt><label for="phbawah">PH Bawah:</label></dt>
        <dd><input type="text" name="PH_Bawah" size="30" id="phbawah" class="required" title="ph harus diisi"/></dd>
    </dl>
</fieldset>
   <div align="center">
    	<input type="submit" name="daftar" id="button1" value="Daftar"/>
		<input type="button" name="back" id="button1" value="Back" onClick="self.history.back()"/>
	</div>
</form>
</div>

<?php
	}elseif($aksi=='ubah'){
		$kode=$_GET['id_tanaman'];
		$qubah=mysql_query("SELECT * FROM tb_knowledge WHERE id_tanaman='$kode'");
		$data2=mysql_fetch_array($qubah);
?>

<div id="box">
<h3 id="adduser">Ubah Data Knowledge</h3>
<form action="knowledge/proses_anggota.php?pros=ubah" method="post" id="form" enctype="multipart/form-data">
<h4 id="adduser">Data Pribadi</h4>
<fieldset>
	<!--<?php// if($data2['photo']){?><img src="<?php// echo $data2['photo'];?>" /><?php// }else{?> <img src="img/who.gif" /> <?php// }?>-->
	<dl>
		<dt><label for="id_tanaman">Id Tanaman :</label></dt>
        <dd><input type="text" name="id_tanaman" size="54" value="<?php echo $data2['id_tanaman'];?>"/></dd>
    </dl>
	<dl>
		<dt><label for="suhuatas">Suhu Atas:</label></dt>
        <dd><input type="text" name="Suhu_Atas" size="54" id="suhuatas" value="<?php echo $data2['Suhu_Atas'];?>"></dd>
    </dl>
	<dl>
		<dt><label for="suhubawah">Suhu Bawah:</label></dt>
        <dd><input type="text" name="Suhu_Bawah" size="54" id="suhubawah" value="<?php echo $data2['Suhu_Bawah'];?>"></dd>
    </dl>
	<dl>
        <dt><label for="ecatas">EC Atas:</label></dt>
        <dd><input type="text" name="EC_Atas" size="54" value="<?php echo $data2['EC_Atas'];?>"/></dd>
    </dl>
	<dl>
        <dt><label for="ecbawah">EC Bawah:</label></dt>
        <dd><input type="text" name="EC_Bawah" size="54" value="<?php echo $data2['EC_Bawah'];?>"/></dd>
    </dl>
	<dl>
        <dt><label for="phatas">PH Atas:</label></dt>
        <dd><input type="text" name="PH_Atas" size="54" id="phatas" value="<?php echo $data2['PH_Atas'];?>"/></dd>
    </dl>
	<dl>
        <dt><label for="phbawah">PH Bawah:</label></dt>
        <dd><input type="text" name="PH_Bawah" size="54" id="phbawah" value="<?php echo $data2['PH_Bawah'];?>"/></dd>
    </dl>
</fieldset>
   <div align="center">
    	<input type="submit" name="ubah" id="button1" value="Ubah" />
		<input type="button" name="back" id="button1" value="Back" onClick="self.history.back()"/>
	</div>
</form>
</div>

<?php
	}elseif($aksi=='hapus'){
		$kode=$_GET['id_tanaman'];
		$qhapus=mysql_query("SELECT * FROM tb_knowledge WHERE id_tanaman='$kode'");
		$data3=mysql_fetch_array($qhapus);
?>

<div id="box">
<h3 id="adduser">Hapus Data Knowledge</h3>
<form action="knowledge/proses_anggota.php?pros=hapus" method="post" id="form">
<h4 id="adduser">Data Knowledge</h4>
<fieldset>
	<dl>
		<dt><label for="id_tanaman">Id Tanaman :</label></dt>
        <dd><input type="text" name="id_tanaman" size="54" value="<?php echo $data3['id_tanaman'];?>" readonly=""/></dd>
    </dl>
	<dl>
		<dt><label for="suhuatas">Suhu Atas:</label></dt>
        <dd><input type="text" name="Suhu_Atas" size="54" id="suhuatas" value="<?php echo $data3['Suhu_Atas'];?>" readonly=""></dd>
    </dl>
	<dl>
		<dt><label for="suhubawah">Suhu Bawah:</label></dt>
        <dd><input type="text" name="Suhu_Bawah" size="54" id="suhubawah" value="<?php echo $data3['Suhu_Bawah'];?>" readonly=""></dd>
    </dl>
	<dl>
        <dt><label for="ecatas">EC Atas:</label></dt>
        <dd><input type="text" name="EC_Atas" size="54" value="<?php echo $data3['EC_Atas'];?>" readonly=""/></dd>
    </dl>
	<dl>
        <dt><label for="ecbawah">EC Bawah:</label></dt>
        <dd><input type="text" name="EC_Bawah" size="54" value="<?php echo $data3['EC_Bawah'];?>" readonly=""/></dd>
    </dl>
	<dl>
        <dt><label for="phatas">PH Atas:</label></dt>
        <dd><input type="text" name="PH_Atas" size="54" id="phatas" value="<?php echo $data3['PH_Atas'];?>" readonly=""/></dd>
    </dl>
	<dl>
        <dt><label for="phbawah">PH Bawah:</label></dt>
        <dd><input type="text" name="PH_Bawah" size="54" id="phbawah" value="<?php echo $data3['PH_Bawah'];?>" readonly=""/></dd>
    </dl>
</fieldset>
   <div align="center">
    	<input type="submit" name="hapus" id="button1" value="Hapus" />
		<input type="button" name="back" id="button1" value="Back" onClick="self.history.back()"/>
	</div>
</form>
</div>
<?php
	}
?>