<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Admin</title>
	<link rel="icon" href="../images/favicon.ico" />
	<link rel="stylesheet" type="text/css" href="../css/login-box.css" />
	<script language="javascript">
	//pengecekan input password
	function cekforms(frm){
		var username=frm['username'].value;
		var password=frm['password'].value;
		if(username.length==0 || password.length==0){
			alert("Username dan Password harus diisi !");
			frm['username'].focus();
			return false;
		}
	}
	<?php
		if($_REQUEST['err']==1){
			echo "setTimeout(\"alert('Logout Sukses')\",200);";
		}else if($_REQUEST['err']==2){
			echo "setTimeout(\"alert('Maaf Username atau Password Salah, silahkan ulangi lagi')\",200);";
		}else if($_REQUEST['err']==3){
			echo "setTimeout(\"alert('Anda Harus login terlebih dahulu')\",200);";
			header("location:login.php");
		}
	?>
	</script>
</head>

<body>
	<form id="login-form" action="proses_login.php" method="post" onsubmit="return cekforms(this)">
		<fieldset>
			<legend>Log in</legend>
			<label for="username">Username : </label>
			<input type="text" id="username" name="username"/>
			<div class="clear"></div>
			<label for="password">Password : </label>
			<input type="password" id="password" name="password"/>
			<div class="clear"></div>
			<div class="clear"></div>
			<br />
			<input type="submit" style="margin: -20px 0 0 287px;" class="button" name="login" value="Log in"/>	
			
		</fieldset>
	</form>
	<div class="footer">
		<a>&copy; 2017 All Rights Reserved.</a>
	</div>
</body>
</html>