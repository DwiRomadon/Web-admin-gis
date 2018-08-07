<?php 
	include "config/koneksi.php";
	include "fungsi/fungsi.php";

	$aksi=$_GET['aksi'];
	$kategori = ($kategori=$_POST['kategori'])?$kategori : $_GET['kategori'];
	$cari = ($cari = $_POST['input_cari'])? $cari: $_GET['input_cari'];
?>

<?php
	// **STYLE FORM
?>
<script language="javascript" type="text/javascript" src="js/niceforms.js"></script>
<script language="javascript" type="text/javascript" src="js/validasi.js"></script>
<link rel="stylesheet" type="text/css" href="css/theme1.css" />

</head>

<?php
	if(empty($aksi)){
?>
<body>  
         	            
<div id="box">
<h3>Data Tanaman</h3>
<form action="<?php $_SERVER['PHP_SELF']?>" method="post">
    <select name="kategori">
        <option value="" selected="selected" disabled="disabled">Pilih Kategori</option>
        <option value="id_tanaman">ID</option>
        <option value="nama_tanaman">Nama Tanaman</option>
    </select> 
    <input type="text" name="input_cari" value="<?php echo $cari ;?>">
    <input type="submit" value="Cari">
</form>
<div class="tambah"><a href=?pilih=1.1&aksi=tambah><input type="submit" value="Tambah"></a></div>
<table width="100%">
    <thead>
		<tr>
             <th><a href="#">No</a></th>
             <th><a href="#">ID</a></th>
             <th><a href="#">Nama Tanaman</a></th>
             <th><a href="#">Masa Panen</a></th>
			 <th><a href="#">Estimasi</a></th>
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
								FROM tb_tanaman
								WHERE $kategori LIKE '%$cari%'
								ORDER BY id_tanaman ASC 
								LIMIT $posisi, $batas");
		}else{
			$query=mysql_query("SELECT * FROM tb_tanaman 
								ORDER BY id_tanaman ASC 
								LIMIT $posisi, $batas");
		}
	$no=$posisi+1;
	while($data=mysql_fetch_array($query)){
?>
    <tbody>
    	<tr>
			<td align="center"	><?php echo $no++;?></td>
            <td><?php echo $data['id_tanaman'];?></td>
            <td><?php echo $data['nama_tanaman'];?></td>
            <td><?php echo $data['masa_panen'];?></td>
            <td><?php echo $data['estimasi'];?></td>
            <td align="center">
	<a href=index.php?pilih=1.1&aksi=ubah&id_tanaman=<?php echo $data['id_tanaman'];?>><img src="img/user_edit.png" title="Edit user" width="16" height="16" /></a>
    <a href=index.php?pilih=1.1&aksi=hapus&id_tanaman=<?php echo $data['id_tanaman'];?>><img src="img/user_delete.png" title="Delete user" width="16" height="16" /></a>
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
									FROM tb_tanaman
									WHERE $kategori LIKE '%$cari%'
									ORDER BY id_tanaman ASC");
			}else{
				$query2 = mysql_query("SELECT * 
									FROM tb_tanaman
									ORDER BY id_tanaman ASC");
			}
            $jmldata=mysql_num_rows($query2);
            $jmlhalaman=ceil($jmldata/$batas);
			
                // previous link
				if($halaman == 1){ 
					echo '<span class="prn">&lt; Previous</span>&nbsp;';
                }else{
					$i = $halaman-1;
					echo '<a href="?pilih=1.1&halaman='.$i.'" class="prn" rel="nofollow" title="go to page '.$i.'">&lt; Previous</a>&nbsp;';
					echo '<span class="prn">...</span>&nbsp;';
				}	
                for($i = 1; $i <= $jmlhalaman && $i <= $jmlhalaman; $i++){ 
                    if(($halaman) == $i){ 
                        echo '<span>'.$i.'</span>&nbsp;';
                    }else{ 
                        echo '<a href=?pilih=1.1&halaman='.$i.'>'.$i.'</a>';
                    } 
                } 
				
                // next link 
                if($halaman < $jmlhalaman){ 
                    $next = ($halaman + 1); 
					echo '<span class="prn">...</span>&nbsp;';
                    echo '<a href=?pilih=1.1&halaman='.$next.' class="prn" rel="nofollow" title="go to page '.$next.'">Next &gt;</a>&nbsp;'; 
                }else{
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
?>

<div id="box">
<h3 id="adduser">Tambah Data Tanaman</h3>
<form action="tanaman/proses_tanaman.php?pros=tambah" method="post" id="form" onSubmit="return validasiPetugas();">
<fieldset>
	<dl>
		<dt><label for="id_tanaman">ID Tanaman :</label></dt>
       <dd><input type="text" name="id_tanaman" size="40" title="ID harus diisi"/></dd>
    </dl>
	<dl>
		<dt><label for="nama_tanaman">Nama Tanaman :</label></dt>
        <dd><input type="text" name="nama_tanaman" id="nama_tanaman" size="40" class="required" title="Nama tanaman"></dd>
    </dl>
    <dl>
        <dt><label for="masa_panen">Masa Panen :</label></dt>
        <dd><input name="masa_panen" id="masa_panen" size="40" class="required" title="Masa Panen"></dd>
    </dl>
	<dl>
        <dt><label for="estimasi">Estimasi :</label></dt>
        <dd><input name="estimasi" id="estimasi" size="40" class="required" title="Estimasi"></dd>
    </dl>
	<br>
    <div align="center">
    	<input type="submit" name="ubah" id="button1" value="Tambah" />
		<input type="button" name="back" id="button1" value="Kembali" onClick="self.history.back()"/>
	</div>
</fieldset>
</form>
</div>

<?php
	}elseif($aksi=='ubah'){
		$kode=$_GET['id_tanaman'];
		$qubah=mysql_query("SELECT * FROM tb_tanaman WHERE id_tanaman='$kode'");
		$data2=mysql_fetch_array($qubah);
?>

<div id="box">
<h3 id="adduser">Ubah Data Tanaman</h3>
<form action="tanaman/proses_tanaman.php?pros=ubah" method="post" id="form">
<fieldset>
    <dl>
        <dt><label for="id_tanaman">ID Tanaman:</label></dt>
        <dd><input type="text" name="id_tanaman" size="40" value="<?php echo $data2['id_tanaman'];?>"/></dd>
    </dl>
	<dl>
        <dt><label for="nama_tanaman">Nama Tanaman :</label></dt>
        <dd><input type="text" name="nama_tanaman" id="nama_tanaman" size="40" value="<?php echo $data2['nama_tanaman'];?>"/> </dd>
    </dl>
	<dl>
        <dt><label for="masa_panen">Masa Panen :</label></dt>
        <dd><input type="text" name="masa_panen" size="40" value="<?php echo $data2['masa_panen'];?>"/></dd>
    </dl>
	<dl>
        <dt><label for="estimasi">Estimasi :</label></dt>
        <dd><input type="text" name="estimasi" size="40" value="<?php echo $data2['estimasi'];?>"/></dd>
    </dl>
	<br>
    <div align="center">
    	<input type="submit" name="ubah" id="button1" value="Ubah" />
		<input type="button" name="back" id="button1" value="Kembali" onClick="self.history.back()"/>
	</div>
</fieldset>
</form>
</div>

<?php
	}elseif($aksi=='hapus'){
		$kode=$_GET['id_tanaman'];
		$qhapus=mysql_query("SELECT * FROM tb_tanaman WHERE id_tanaman='$kode'");
		$data3=mysql_fetch_array($qhapus);
?>

<div id="box">
<h3 id="adduser">Hapus Data Tanaman</h3>
<form action="tanaman/proses_tanaman.php?pros=hapus" method="post" id="form">
<fieldset>
	<dl>
		<dt><label for="id_tanaman">ID Tanaman :</label></dt>
        <dd><input type="text" name="id_tanaman" size="40" value="<?php echo $data3['id_tanaman'];?>" readonly=""/></dd>
    </dl>
        <dl>
        <dt><label for="nama_tanaman">Nama Tanaman :</label></dt>
        <dd><input type="text" name="nama_tanaman" size="40" value="<?php echo $data3['nama_tanaman'];?>" readonly=""/></dd>
    </dl>
	<dl>
        <dt><label for="masa_panen">Masa Panen :</label></dt>
        <dd><input type="text "name="masa_panen" id="masa_panen" rows="5" size="40" value="<?php echo $data3['masa_panen'];?>" readonly=""/></dd>
    </dl>
	<dl>
        <dt><label for="estimasi">Estimasi :</label></dt>
        <dd><input type="text "name="estimasi" id="estimasi" rows="5" size="40" value="<?php echo $data3['estimasi'];?>" readonly=""/></dd>
    </dl>
	<br>
    <div align="center">
    	<input type="submit" name="hapus" id="button1" value="Hapus" />
		<input type="button" name="back" id="button1" value="Kembali" onClick="self.history.back()"/>
	</div>
</fieldset>
</form>
</div>

<?php
	}
?>

