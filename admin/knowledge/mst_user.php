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
<h3>Data Studio</h3>

<form action="<?php $_SERVER['PHP_SELF']?>" method="post">
    <select name="kategori">
        <option value="" selected="selected" disabled="disabled">Pilih Kategori</option>
        <option value="id_user">ID</option>
    </select>
    <input type="text" name="input_cari" value="<?php echo $cari;?>"><input type="submit" value="Cari">
</form>
<div class="tambah"><a href=?pilih=1.3&aksi=tambah><input type="submit" value="Tambah"></a></div>
<table width="100%">
    <thead>
		<tr>
             <th><a href="#">No</a></th>
			 <th><a href="#">Nama Studio</a></th>
             <th><a href="#">Alamat Studio</a></th>
             <th><a href="#">Website</a></th>
			 <th><a href="#">No Telp</a></th>
			 <th><a href="#">Status</a></th>
			 <th><a href="#">Deskripsi</a></th>
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
								FROM data_studio
								WHERE $kategori LIKE '%$cari%'
								ORDER BY id_st ASC
								LIMIT $posisi, $batas");
		}else{
			$query=mysql_query("SELECT * FROM data_studio
								ORDER BY id_st ASC
								LIMIT $posisi, $batas");
		}
		$no=$posisi+1;

	while($data=mysql_fetch_array($query)){
?>
    <tbody>
    	<tr>
			<td><?php echo $no++;?></td>
            <td><?php echo $data['nama_st'];?></td>
            <td><?php echo $data['alamat_st'];?></td>
            <td><?php echo $data['website'];?></td>
			<td><?php echo $data['tlp'];?></td>
			<td><?php echo $data['status'];?></td>
			<td><?php echo $data['deskripsi'];?></td>
            <td align="center">
	<a href=index.php?pilih=1.3&aksi=ubah&id_st=<?php echo $data['id_st'];?>><img src="img/edit.png" title="Edit user" width="16" height="16" /></a>
    <a href="knowledge/hapus.php?id_st=<?php echo $data['id_st']; ?>"><img src="img/delete.png" title="Delete user" width="16" height="16" onClick="return confirm('Apa Kamu Yakin?');" /></a>

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
									FROM data_studio
									WHERE $kategori LIKE '%$cari%'
									ORDER BY email ASC");
			}else{
				$query2 = mysql_query("SELECT * FROM data_studio");
			}
            $jmldata=mysql_num_rows($query2);
            $jmlhalaman=ceil($jmldata/$batas);

                // previous link
				if($halaman == 1){
					echo '<span class="prn">&lt; Previous</span>&nbsp;';
                }else{
					$i = $halaman-1;
					echo '<a href="?pilih=1.3&halaman='.$i.'" class="prn" rel="nofollow" title="go to page '.$i.'">&lt; Previous</a>&nbsp;';
					echo '<span class="prn">...</span>&nbsp;';
				}
                for($i = 1; $i <= $jmlhalaman && $i <= $jmlhalaman; $i++){
                    if(($halaman) == $i){
                        echo '<span>'.$i.'</span>&nbsp;';
                    }else{
                        echo '<a href=?pilih=1.3&halaman='.$i.'>'.$i.'</a>';
                    }
                }

                // next link
                if($halaman < $jmlhalaman){
                    $next = ($halaman + 1);
					echo '<span class="prn">...</span>&nbsp;';
                    echo '<a href=?pilih=1.3&halaman='.$next.' class="prn" rel="nofollow" title="go to page '.$next.'">Next &gt;</a>&nbsp;';
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

?>
<div id="box">
<h3 id="adduser">Tambah Data Studio</h3>
<form action="knowledge/proses_user.php?pros=tambah" method="post" id="form" enctype="multipart/form-data">
<h4 id="adduser">Data Studio</h4>
<fieldset>
	<dl>
		<dt><label for="nama">Nama Studio :</label></dt>
        <dd><input type="text" name="nama" size="40" id="nama" class="required" value="" title="belakang harus diisi"></dd>
    </dl>
    <dl>
        <dt><label for="alamat">Alamat Studio :</label></dt>
        <dd><input type="text" name="alamat" size="40" class="required" title="Alamat Harus Di Isi"/></dd>
    </dl>
	<dl>
        <dt><label for="tlp">No.telpon :</label></dt>
        <dd><input type="text" name="tlp" size="40" class="required" title="No. telpon Harus Di Isi"/></dd>
    </dl>
	<dl>
        <dt><label for="website">Website :</label></dt>
        <dd><input type="text" name="website" size="40" class="required" title="Website Harus Di Isi"/></dd>
    </dl>
	<dl>
        <dt><label for="deskripsi">Deskripsi :</label></dt>
        <dd><input type="text" name="deskripsi" size="40" class="required" title="Deskripsi Harus Di Isi"/></dd>
    </dl>
	<dl>
        <dt><label for="lat">Lattitude :</label></dt>
        <dd><input type="text" name="lat" size="40" class="required" title="Lattitude Harus Di Isi"/></dd>
    </dl>
	<dl>
        <dt><label for="long">Longtitude :</label></dt>
        <dd><input type="text" name="long" size="40" class="required" title="longtitude Harus Di Isi"/></dd>
    </dl>
	<dl>
        <dt><label for="status">Status :</label></dt>
        <dd>
			<input type="radio" name="status" value="Aktif" class="required" title="Status harus diisi"/> Aktif
			<input type="radio" name="status" value="Tidak Aktif" class="required" title="Status harus diisi"/> Tidak Aktif
		</dd>
    </dl>
	<dl>
        <dt><label for="long" name="gmb1">Gambar 1 :</label></dt>
        <dd><input type="file" name="gmb1"/>
    </dl>
	<dl>
        <dt><label for="long" name="gmb2">Gambar 2 :</label></dt>
        <dd><input type="file" name="gmb2"/>
    </dl>
	<dl>
        <dt><label for="long" name="gmb3">Gambar 3 :</label></dt>
        <dd><input type="file" name="gmb3"/>
    </dl>


</fieldset>
   <div align="center">
    	<input type="submit" name="daftar" id="button1" value="Tambah" onClick="alert('Data Berhasil Ditambah')"/>
		<input type="button" name="back" id="button1" value="Back" onClick="self.history.back()"/>
	</div>
</form>
</div>

<?php
	}elseif($aksi=='ubah'){
		$kode=$_GET['id_st'];
		$qubah=mysql_query("SELECT * FROM data_studio WHERE id_st='$kode'");
		$data2=mysql_fetch_array($qubah);
?>

<div id="box">
<h3 id="adduser">Ubah Data User</h3>
<form action="knowledge/proses_user.php?pros=ubah" method="post" id="form" enctype="multipart/form-data">
<h4 id="adduser">Data Studio</h4>
<fieldset>
	<!--<?php// if($data2['photo']){?><img src="<?php// echo $data2['photo'];?>" /><?php// }else{?> <img src="img/who.gif" /> <?php// }?>-->
    <dl>

        <dd><input type="hidden" name="id_st" size="54" value="<?php echo $data2['id_st'];?>" /></dd>
    </dl>
	<dl>
        <dt><label for="nama">Nama Studio :</label></dt>
        <dd><input type="text" name="nama" size="54" value="<?php echo $data2['nama_st'];?>"/></dd>
    </dl>
	<dl>
        <dt><label for="alamat">Alamat Studio :</label></dt>
        <dd><input type="text" name="alamat" size="54" value="<?php echo $data2['alamat_st'];?>"/></dd>
    </dl>
	<dl>
        <dt><label for="tlp">No.tlp :</label></dt>
        <dd><input type="text" name="tlp" size="54" value="<?php echo $data2['tlp'];?>"/></dd>
    </dl>
	<dl>
        <dt><label for="website">Website :</label></dt>
        <dd><input type="text" name="website" size="54" value="<?php echo $data2['website'];?>"/></dd>
    </dl>
	<dl>
        <dt><label for="deskripsi">Deskripsi :</label></dt>
        <dd><input type="text" name="deskripsi" size="40" class="required" value="<?php echo $data2['deskripsi'];?>"/></dd>
    </dl>
	<dl>
	<dl>
        <dt><label for="lat">Lattitude :</label></dt>
        <dd><input type="text" name="lat" size="40" class="required" value="<?php echo $data2['lat'];?>"/></dd>
    </dl>
	<dl>
        <dt><label for="long">Longtitude :</label></dt>
        <dd><input type="text" name="long" size="40" class="required" value="<?php echo $data2['longi'];?>"/></dd>
    </dl>
	<dl>
        <dt><label for="status">Status :</label></dt>
        <dd>
			<input type="radio" name="status" value="Aktif<?php if ($data2 == 'Aktif') echo 'checked="checked"'; ?>" /> Aktif
			<input type="radio" name="status" value="Tidak Aktif<?php if ($data2 == 'Tidak Aktif') echo 'checked="checked"'; ?>" /> Tidak Aktif
		</dd>
    </dl>
	<dl>
        <dt><label for="long" name="gmb1">Gambar 1 :</label></dt>
        <dd><input type="file" name="gmb1" />
    </dl>
	<dl>
        <dt><label for="long" name="gmb2">Gambar 2 :</label></dt>
        <dd><input type="file" name="gmb2"/>
    </dl>
	<dl>
        <dt><label for="long" name="gmb3">Gambar 3 :</label></dt>
        <dd><input type="file" name="gmb3"/>
    </dl>
</fieldset>
   <div align="center">
    	<input type="submit" name="ubah" id="button1" value="Ubah" onClick="alert('Data Berhasil Diubah')"/>
		<input type="button" name="back" id="button1" value="Back" onClick="self.history.back()"/>
	</div>
</form>
</div>



<?php
	}
?>
