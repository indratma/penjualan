<?php
function sukses_masuk($username,$pass){
	// Apabila username dan password ditemukan
	$login=mysql_query("SELECT username,nama_lengkap,password,level,nik FROM userapp WHERE username='$username' AND password='$pass' AND blokir='N'");
	$ketemu=mysql_num_rows($login);
	$r=mysql_fetch_array($login);
	if ($ketemu > 0){
		session_start();
		include "timeout.php";
	
		$_SESSION[namauser]     = $r[username];
		$_SESSION[namalengkap]  = $r[nama_lengkap];
		$_SESSION[passuser]     = $r[password];
		$_SESSION[leveluser]    = $r[level];
		$nik					= $r[nik];
		
				
		if($r[level]="admin"){
			$_SESSION[pathavatar]   = "img/avatar6.png";
		}else{
			$_SESSION[pathavatar]   = "img/avatar5.png";
		}	
		// session timeout
		$_SESSION[login] = 1;
		timer();
			
		$ipaddress = 
		empty($_SERVER['HTTP_CLIENT_IP'])?(empty($_SERVER['HTTP_X_FORWARDED_FOR'])? $_SERVER['REMOTE_ADDR']:$_SERVER['HTTP_X_FORWARDED_FOR']):$_SERVER['HTTP_CLIENT_IP'];
		
		$sql	= "UPDATE userapp SET lastupdate=now(),lastlogin=now(),ipaddress='$ipaddress',online=1  WHERE username='$_SESSION[namauser]'";
		mysql_query($sql);
		
		header('location:../media.php?mod=home');
	}
	return false;
}

function msg(){
  echo "<link href='../css/screen.css' rel='stylesheet' type='text/css'>
	  <link href='../css/reset.css' rel='stylesheet' type='text/css'>
	  <center><br><br><br><br><br><br>Maaf, silahkan cek kembali <b>User ID</b> dan <b>Password</b> Anda<br><br>Kesalahan $_SESSION[salah]<br>
	  <div> <a href='../index.html'><img src='../img/kunci.png' height=176 width=143></a></div>
	  <input type=button class='button buttonblue mediumbtn' value='KEMBALI' onclick=location.href='../index.html'></a></center>";
  return false;
}

function salah_blokir($username){
  echo "<link href='../css/screen.css' rel='stylesheet' type='text/css'>
	  <link href='../css/reset.css' rel='stylesheet' type='text/css'>
	  <center><br><br><br><br><br><br>User ID <b>$username</b> telah <b>TERBLOKIR</b><br><br>
	  <div> <a href='../index.html'><img src='../img/kunci.png'  height=176 width=143></a></div>
	  <input type=button class='button buttonblue mediumbtn' value='KEMBALI' onclick=location.href='../index.html'></a></center>";
  return false;
}

function salah_username($username){
  echo "<link href='../css/screen.css' rel='stylesheet' type='text/css'>
	  <link href='../css/reset.css' rel='stylesheet' type='text/css'>
	  <center><br><br><br><br><br><br>User ID <b>$username</b> tidak dikenal !!<br><br>
	  <div> <a href='../index.html'><img src='../img/kunci.png'  height=176 width=143></a></div>
	  <input type=button class='button buttonblue mediumbtn' value='KEMBALI' onclick=location.href='../index.html'></a></center>";	
  return false;
}

function username_aktif($username){
  echo "<link href='../css/screen.css' rel='stylesheet' type='text/css'>
	  <link href='../css/reset.css' rel='stylesheet' type='text/css'>
	  <center><br><br><br><br><br><br>Status User ID <b>$username</b> masih aktif digunakan!
	  <div> <a href='../index.html'><img src='../img/kunci.png'  height=176 width=143></a></div>
	  <input type=button class='button buttonblue mediumbtn' value='KEMBALI' onclick=location.href='../index.html'></a></center>";	
  return false;
}

function salah_password(){
  echo "<link href='../css/screen.css' rel='stylesheet' type='text/css'>
	  <link href='../css/reset.css' rel='stylesheet' type='text/css'>
	  <center><br><br><br><br><br><br>Maaf, silahkan cek kembali <b>Password</b> Anda<br><br>Kesalahan $_SESSION[salah]
	  <div> <a href='../index.html'><img src='../img/kunci.png'  height=176 width=143></a></div>
	  <input type=button class='button buttonblue mediumbtn' value='KEMBALI' onclick=location.href='../index.html'></a></center>";
   return false;
}

function blokir($username){
	$ipaddress = empty($_SERVER['HTTP_CLIENT_IP'])?(empty($_SERVER['HTTP_X_FORWARDED_FOR'])? $_SERVER['REMOTE_ADDR']:$_SERVER['HTTP_X_FORWARDED_FOR']):$_SERVER['HTTP_CLIENT_IP'];
	$sql	= "UPDATE userapp SET lastlogin=now(),ipaddress='$ipaddress',blokir='Y' WHERE username='$username'";
	mysql_query($sql);		
	session_start();
	session_destroy();
	return false;
}

?>